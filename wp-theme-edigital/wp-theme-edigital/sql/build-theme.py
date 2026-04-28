#!/usr/bin/env python3
"""
Génère les templates WordPress PHP à partir des fichiers HTML statiques,
et le fichier SQL d'import qui crée les pages WP assignées à ces templates.

Approche (Option A — fidélité maximale) :
  - Chaque HTML racine devient un template de page « templates/page-<slug>.php »
    avec en-tête "Template Name: E-Digital — <Titre>".
  - L'en-tête et le pied de page sont extraits **une fois** vers :
      * header-static.php  (tout ce qui va du <body> au début du contenu unique)
      * footer-static.php  (du début du <footer> jusqu'à </body>)
  - Les templates de pages appellent ces partials et ne contiennent QUE
    la zone "contenu unique" de la page, avec les URLs adaptées WP
    (home_url pour les liens internes, get_template_directory_uri pour les assets).
  - Le SQL crée les pages WP avec un post_content minimal (notice d'édition)
    et assigne _wp_page_template = 'templates/page-<slug>.php'.

Utilisation :
    python3 wp-theme-edigital/sql/build-theme.py
"""

from __future__ import annotations

import html
import os
import re
import sys
from pathlib import Path

from bs4 import BeautifulSoup

import acf_magic

ROOT = Path(__file__).resolve().parents[2]
THEME = ROOT / "wp-theme-edigital"
TEMPLATES_DIR = THEME / "templates"
OUT_SQL = THEME / "sql" / "edigital-pages.sql"

# ---------------------------------------------------------------------------
# Spécification des pages
# ---------------------------------------------------------------------------

PAGES = [
    {"slug": "accueil",                         "title": "Accueil",                                      "source": "index.html",                           "front": True,  "menu_order": 1},
    {"slug": "services",                        "title": "Nos Services",                                 "source": "services.html",                        "menu_order": 2},
    {"slug": "service-creation-web",            "title": "Création de Site Web",                         "source": "service-creation-web.html",            "menu_order": 3, "parent_slug": "services"},
    {"slug": "service-mobile-native",           "title": "Applications Mobiles Natives",                 "source": "service-mobile-native.html",           "menu_order": 4, "parent_slug": "services"},
    {"slug": "service-app-metier",              "title": "Applications Métier",                          "source": "service-app-metier.html",              "menu_order": 5, "parent_slug": "services"},
    {"slug": "service-branding",                "title": "Branding & Design",                            "source": "service-branding.html",                "menu_order": 6, "parent_slug": "services"},
    {"slug": "service-visibilite-seo",          "title": "Visibilité SEO & Référencement Naturel",       "source": "service-visibilite-seo.html",          "menu_order": 7, "parent_slug": "services"},
    {"slug": "service-visibilite-google-ads",   "title": "Publicité Google Ads & Meta Ads",              "source": "service-visibilite-google-ads.html",   "menu_order": 8, "parent_slug": "services"},
    {"slug": "service-maintenance",             "title": "Maintenance & Support Technique",              "source": "service-maintenance.html",             "menu_order": 9, "parent_slug": "services"},
    {"slug": "nos-technologies",                "title": "Nos Technologies",                             "source": "nos-technologies.html",                "menu_order": 10},
    {"slug": "nos-projets",                     "title": "Nos Projets",                                  "source": "nos-projets.html",                     "menu_order": 11},
    {"slug": "blog",                            "title": "Blog",                                         "source": "blog.html",                            "menu_order": 12, "blog_page": True},
    {"slug": "contact",                         "title": "Contact",                                      "source": "contact.html",                         "menu_order": 13},
    {"slug": "projet",                          "title": "Projet Single",                                "source": "projet.html",                          "menu_order": 14},
    {"slug": "blog-single",                     "title": "Blog Single",                                  "source": "blog-single.html",                     "menu_order": 15},
    {"slug": "blog-list",                       "title": "Blog List",                                    "source": "blog-list.html",                       "menu_order": 16},
]

# Liens HTML statiques → URLs WordPress. Toute ancre href="X.html" sera remplacée.
PAGE_URL_MAP = {
    "index.html":                           "/",
    "services.html":                        "/services/",
    "service-creation-web.html":            "/services/service-creation-web/",
    "service-mobile-native.html":           "/services/service-mobile-native/",
    "service-app-metier.html":              "/services/service-app-metier/",
    "service-branding.html":                "/services/service-branding/",
    "service-visibilite-seo.html":          "/services/service-visibilite-seo/",
    "service-visibilite-google-ads.html":   "/services/service-visibilite-google-ads/",
    "service-maintenance.html":             "/services/service-maintenance/",
    "nos-technologies.html":                "/nos-technologies/",
    "nos-projets.html":                     "/nos-projets/",
    "blog.html":                            "/blog/",
    "contact.html":                         "/contact/",
    # Pages générées nouvellement ajoutées
    "projet.html":                          "/projet/",
    "blog-single.html":                     "/blog-single/",
    "blog-list.html":                       "/blog-list/",
}

# Marqueurs délimitant les zones dans le HTML source.
HEADER_START_RE = re.compile(r'<div[^>]*id="top"', re.IGNORECASE)
CONTENT_START_RE = re.compile(
    r'(<main\b[^>]*>)',
    re.IGNORECASE,
)
FOOTER_START_RE = re.compile(r'<footer[^>]*class="[^"]*ms-footer', re.IGNORECASE)
BACK_TO_TOP_RE = re.compile(r'<a[^>]*class="[^"]*back-to-top', re.IGNORECASE)


# ---------------------------------------------------------------------------
# Helpers
# ---------------------------------------------------------------------------

def read(path: Path) -> str:
    return path.read_text(encoding="utf-8")


def rewrite_urls(html_str: str) -> str:
    """Remplace les chemins statiques par leurs équivalents WordPress."""
    # Assets : tout chemin relatif assets/..., fonts/..., fav-icone.png, logo.
    def _asset_sub(m):
        rel = m.group(2)
        return f'{m.group(1)}<?php echo esc_url( get_template_directory_uri() ); ?>/{rel}{m.group(3)}'

    # href|src="assets/..."  ou ="fav-icone.png"  ou ="Logo  E DIGITAL copie.png"  ou ="Logo_black.png"
    html_str = re.sub(
        r'((?:href|src)=")(assets/[^"]+|fav-icone\.png|Logo[^"]*\.png)(")',
        _asset_sub,
        html_str,
    )

    # Liens internes *.html → URLs WP.
    def _link_sub(m):
        href = m.group(2)
        # Conserve les ancres / query string.
        anchor = ""
        if "#" in href:
            href, anchor = href.split("#", 1)
            anchor = "#" + anchor
        # Strip éventuel "./".
        clean_href = href.lstrip("./")
        target = PAGE_URL_MAP.get(clean_href)
        if target is None:
            # Pas dans la map → on laisse tel quel.
            return m.group(0)
        return f"{m.group(1)}<?php echo esc_url( home_url( '{target}' ) ); ?>{anchor}{m.group(3)}"

    html_str = re.sub(
        r'(href=")([A-Za-z0-9_\-]+\.html(?:#[^"]*)?)(")',
        _link_sub,
        html_str,
    )

    return html_str


def slice_between(text: str, start_match, end_match) -> tuple[str, str, str]:
    """Retourne (avant, entre, après) en utilisant les positions des regex match."""
    before = text[: start_match.start()]
    between = text[start_match.start() : end_match.start()]
    after = text[end_match.start() :]
    return before, between, after


def find_or_die(pattern: re.Pattern, text: str, name: str, source: str):
    m = pattern.search(text)
    if not m:
        print(f"[build-theme] ERREUR : marqueur {name!r} introuvable dans {source}", file=sys.stderr)
        sys.exit(1)
    return m


# ---------------------------------------------------------------------------
# Extraction header / footer (depuis index.html, considéré comme référence)
# ---------------------------------------------------------------------------

def extract_shared_partials() -> tuple[str, str]:
    src = read(ROOT / "index.html")

    # Header : du <div id="top"> jusqu'au début du contenu unique de la page.
    m_top = find_or_die(HEADER_START_RE, src, "header start (<div id=\"top\">)", "index.html")
    m_content = find_or_die(CONTENT_START_RE, src, "content start (.ms-page-content / banner-horizental)", "index.html")
    header_html = src[m_top.start() : m_content.start()].rstrip()

    # Footer : du <footer> jusqu'au premier <script> (exclu), afin de garder le
    # bouton back-to-top mais de laisser WP charger les scripts via wp_footer().
    m_footer = find_or_die(FOOTER_START_RE, src, "footer start", "index.html")
    m_first_script = re.search(r'<script\b', src[m_footer.start():])
    if not m_first_script:
        print("[build-theme] ERREUR : aucun <script> après le footer dans index.html", file=sys.stderr)
        sys.exit(1)
    footer_end = m_footer.start() + m_first_script.start()
    footer_html = src[m_footer.start() : footer_end].rstrip()

    return rewrite_urls(header_html), rewrite_urls(footer_html)


# ---------------------------------------------------------------------------
# Extraction du contenu unique d'une page
# ---------------------------------------------------------------------------

def extract_unique_content(source_file: str) -> str:
    src = read(ROOT / source_file)
    m_content = find_or_die(CONTENT_START_RE, src, "content start", source_file)
    m_footer = find_or_die(FOOTER_START_RE, src, "footer start", source_file)
    content = src[m_content.start() : m_footer.start()]
    return rewrite_urls(content.strip())


STYLE_RE = re.compile(r'<style[^>]*>(.*?)</style>', re.DOTALL | re.IGNORECASE)

def extract_head_styles(source_file: str) -> str:
    """Extrait le CSS contenu dans les blocs <style> du <head> de la page source."""
    src = read(ROOT / source_file)
    m_main = CONTENT_START_RE.search(src)
    head_zone = src[:m_main.start()] if m_main else src
    css_blocks = [m.group(1).strip() for m in STYLE_RE.finditer(head_zone)]
    return "\n".join(b for b in css_blocks if b)


# ---------------------------------------------------------------------------
# Génération des fichiers PHP
# ---------------------------------------------------------------------------

HEADER_PARTIAL_PHP = """<?php
/**
 * Partial — en-tête statique E-Digital.
 * Généré automatiquement par sql/build-theme.py à partir de index.html.
 * Ne pas éditer directement.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
{header_html}
"""

FOOTER_PARTIAL_PHP = """<?php
/**
 * Partial — pied de page statique E-Digital.
 * Généré automatiquement par sql/build-theme.py à partir de index.html.
 * Ne pas éditer directement.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
{footer_html}
"""

PAGE_TEMPLATE_PHP = """<?php
/**
 * Template Name: E-Digital — {title}
 *
 * Template de page fidèle au HTML d'origine ({source}).
 * Généré automatiquement par sql/build-theme.py — ne pas éditer directement.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Injection des styles du <head> de la page statique d'origine.
add_action( 'wp_enqueue_scripts', function() {
    wp_add_inline_style( 'edigital-style', '{inline_css}' );
}, 20 );

get_header();
?>
{content}
<?php
get_footer();
"""

HEADER_PHP_NEW = """<?php
/**
 * En-tête principal du thème E-Digital — fidélité au HTML statique.
 *
 * @package EDigital
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
\t<meta charset="<?php bloginfo( 'charset' ); ?>">
\t<meta http-equiv="X-UA-Compatible" content="IE=edge">
\t<meta name="viewport" content="width=device-width, initial-scale=1.0">
\t<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/fav-icone.png' ); ?>">
\t<?php wp_head(); ?>
</head>
<body <?php body_class( 'ms-body' ); ?> data-theme="light" data-menu="fixed" data-footer-effect="on" data-footer-corners="on">
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Aller au contenu principal', 'edigital' ); ?></a>
<?php get_template_part( 'header', 'static' ); ?>
"""

FOOTER_PHP_NEW = """<?php
/**
 * Pied de page principal du thème E-Digital — fidélité au HTML statique.
 *
 * @package EDigital
 */
?>
<?php get_template_part( 'footer', 'static' ); ?>
<?php wp_footer(); ?>
</body>
</html>
"""


def write(path: Path, content: str):
    path.parent.mkdir(parents=True, exist_ok=True)
    path.write_text(content, encoding="utf-8", newline="\n")
    print(f"[build-theme] OK {path.relative_to(ROOT)}")


# ---------------------------------------------------------------------------
# Génération SQL
# ---------------------------------------------------------------------------

def sql_escape(s: str) -> str:
    return s.replace("\\", "\\\\").replace("'", "\\'")


def build_sql(pages_with_ids: list[dict]) -> str:
    """pages_with_ids : liste de pages enrichies (id, parent_id, template, ...)."""
    lines: list[str] = []
    lines.append("-- -----------------------------------------------------------------------")
    lines.append("-- E-Digital — Import des pages WP (Option A : templates PHP fidèles).")
    lines.append("-- Généré automatiquement par wp-theme-edigital/sql/build-theme.py")
    lines.append("-- Chaque page pointe vers un template dans wp-content/themes/edigital/templates/.")
    lines.append("-- Idempotent : re-exécuter le fichier supprime puis recrée les pages.")
    lines.append("-- -----------------------------------------------------------------------")
    lines.append("")
    lines.append("SET NAMES utf8mb4;")
    lines.append("SET FOREIGN_KEY_CHECKS = 0;")
    lines.append("")

    slugs = [p["slug"] for p in pages_with_ids]
    menu_slugs = [f"{s}-menu-item" for s in slugs]
    all_slugs_sql = ", ".join(f"'{s}'" for s in slugs + menu_slugs)

    lines.append("-- Nettoyage préalable des pages E-Digital déjà présentes.")
    lines.append(
        f"DELETE pm FROM wp_postmeta pm INNER JOIN wp_posts p ON p.ID = pm.post_id "
        f"WHERE p.post_name IN ({all_slugs_sql}) AND p.post_type IN ('page','nav_menu_item');"
    )
    lines.append(
        f"DELETE FROM wp_posts WHERE post_name IN ({all_slugs_sql}) "
        f"AND post_type IN ('page','nav_menu_item');"
    )
    lines.append("")

    lines.append("-- Nettoyage du menu principal.")
    lines.append(
        "DELETE tr FROM wp_term_relationships tr "
        "INNER JOIN wp_term_taxonomy tt ON tt.term_taxonomy_id = tr.term_taxonomy_id "
        "INNER JOIN wp_terms t ON t.term_id = tt.term_id "
        "WHERE tt.taxonomy = 'nav_menu' AND t.slug = 'edigital-primary';"
    )
    lines.append(
        "DELETE tt FROM wp_term_taxonomy tt INNER JOIN wp_terms t ON t.term_id = tt.term_id "
        "WHERE tt.taxonomy = 'nav_menu' AND t.slug = 'edigital-primary';"
    )
    lines.append("DELETE FROM wp_terms WHERE slug = 'edigital-primary';")
    lines.append("")

    # Pages
    lines.append("-- Pages (contenu minimal + template PHP assigné).")
    for p in pages_with_ids:
        notice = (
            f"<!-- wp:paragraph --><p><em>Le rendu visuel de cette page est fourni "
            f"par le template <code>{p['template']}</code>. Modifier la structure se fait "
            f"directement dans le fichier PHP du thème.</em></p><!-- /wp:paragraph -->"
        )
        lines.append(
            "INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, "
            "post_title, post_excerpt, post_status, comment_status, ping_status, post_password, "
            "post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, "
            "post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES ("
            f"{p['id']}, 1, NOW(), UTC_TIMESTAMP(), '{sql_escape(notice)}', "
            f"'{sql_escape(p['title'])}', '', 'publish', 'closed', 'closed', '', "
            f"'{p['slug']}', '', '', NOW(), UTC_TIMESTAMP(), '', {p['parent_id']}, "
            f"'', {p['menu_order']}, 'page', '', 0);"
        )
        lines.append(
            f"INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES "
            f"({p['id']}, '_wp_page_template', '{p['template']}');"
        )
    lines.append("")

    # Options : front-page et page des articles
    front = next((p for p in pages_with_ids if p.get("front")), None)
    blog = next((p for p in pages_with_ids if p.get("blog_page")), None)
    if front:
        lines.append(
            f"INSERT INTO wp_options (option_name, option_value, autoload) VALUES "
            f"('show_on_front', 'page', 'yes') ON DUPLICATE KEY UPDATE option_value='page';"
        )
        lines.append(
            f"INSERT INTO wp_options (option_name, option_value, autoload) VALUES "
            f"('page_on_front', '{front['id']}', 'yes') "
            f"ON DUPLICATE KEY UPDATE option_value='{front['id']}';"
        )
    if blog:
        lines.append(
            f"INSERT INTO wp_options (option_name, option_value, autoload) VALUES "
            f"('page_for_posts', '{blog['id']}', 'yes') "
            f"ON DUPLICATE KEY UPDATE option_value='{blog['id']}';"
        )
    lines.append("")

    # Menu principal
    lines.append("-- Menu principal E-Digital.")
    menu_term_id = 9000
    menu_tt_id = 9000
    lines.append(
        f"INSERT INTO wp_terms (term_id, name, slug, term_group) VALUES "
        f"({menu_term_id}, 'E-Digital Primary', 'edigital-primary', 0);"
    )
    lines.append(
        f"INSERT INTO wp_term_taxonomy (term_taxonomy_id, term_id, taxonomy, description, parent, count) "
        f"VALUES ({menu_tt_id}, {menu_term_id}, 'nav_menu', '', 0, 0);"
    )

    # Menu items : seulement les pages de premier niveau (parent_id=0) et quelques sous-pages de services.
    top_level_slugs = ["accueil", "services", "nos-technologies", "nos-projets", "blog", "contact"]
    mi_id = 11000
    for slug in top_level_slugs:
        page = next((p for p in pages_with_ids if p["slug"] == slug), None)
        if not page:
            continue
        mi_id += 1
        mi_slug = f"{slug}-menu-item"
        lines.append(
            "INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, "
            "post_title, post_excerpt, post_status, comment_status, ping_status, post_password, "
            "post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, "
            "post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES ("
            f"{mi_id}, 1, NOW(), UTC_TIMESTAMP(), '', ' ', '', 'publish', 'closed', 'closed', '', "
            f"'{mi_slug}', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', {page['menu_order']}, "
            f"'nav_menu_item', '', 0);"
        )
        lines.append(
            f"INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES "
            f"({mi_id}, '_menu_item_type', 'post_type'), "
            f"({mi_id}, '_menu_item_menu_item_parent', '0'), "
            f"({mi_id}, '_menu_item_object_id', '{page['id']}'), "
            f"({mi_id}, '_menu_item_object', 'page'), "
            f"({mi_id}, '_menu_item_target', ''), "
            f"({mi_id}, '_menu_item_classes', 'a:1:{{i:0;s:0:\"\";}}'), "
            f"({mi_id}, '_menu_item_xfn', ''), "
            f"({mi_id}, '_menu_item_url', '');"
        )
        lines.append(
            f"INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) "
            f"VALUES ({mi_id}, {menu_tt_id}, 0);"
        )

    lines.append(
        f"UPDATE wp_term_taxonomy SET count = (SELECT COUNT(*) FROM wp_term_relationships "
        f"WHERE term_taxonomy_id = {menu_tt_id}) WHERE term_taxonomy_id = {menu_tt_id};"
    )
    lines.append("")

    # Permaliens jolis
    lines.append(
        "INSERT INTO wp_options (option_name, option_value, autoload) VALUES "
        "('permalink_structure', '/%postname%/', 'yes') "
        "ON DUPLICATE KEY UPDATE option_value='/%postname%/';"
    )
    lines.append("")
    lines.append("SET FOREIGN_KEY_CHECKS = 1;")
    lines.append("")

    return "\n".join(lines) + "\n"


# ---------------------------------------------------------------------------
# Main
# ---------------------------------------------------------------------------

def main():
    print("[build-theme] Extraction des partials partagés depuis index.html ...")
    header_html, footer_html = extract_shared_partials()

    # Partials
    write(THEME / "header-static.php", HEADER_PARTIAL_PHP.replace("{header_html}", header_html))
    write(THEME / "footer-static.php", FOOTER_PARTIAL_PHP.replace("{footer_html}", footer_html))

    # header.php / footer.php principaux (reconstruit)
    write(THEME / "header.php", HEADER_PHP_NEW)
    write(THEME / "footer.php", FOOTER_PHP_NEW)

    # Templates de pages
    print("[build-theme] Génération des templates de page ...")
    pages_with_ids: list[dict] = []
    next_id = 10001

    # Passe 1 : attribuer les IDs, car le parent_id est une référence.
    slug_to_id = {}
    for i, spec in enumerate(PAGES):
        slug_to_id[spec["slug"]] = next_id + i

    all_acf_fields = {}

    # Modèles PHP (Standard vs Single CPT)
    PAGE_TEMPLATE_PHP = """<?php
/**
 * Template Name: E-Digital — {title}
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '{inline_css}' ); }, 20 );
get_header();
?>
{content}
<?php get_footer(); """

    SINGLE_TEMPLATE_PHP = """<?php
/**
 * Single Post Template: {title}
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '{inline_css}' ); }, 20 );
get_header();
?>
{content}
<?php get_footer(); """

    for i, spec in enumerate(PAGES):
        raw_content = extract_unique_content(spec["source"])
        content, fields = acf_magic.acfify_html(raw_content, f"page_{spec['slug']}")
        all_acf_fields[f"page-{spec['slug']}.php"] = fields
        inline_css = extract_head_styles(spec["source"])
        inline_css_escaped = inline_css.replace("\\", "\\\\").replace("'", "\\'")

        if spec["slug"] == "projet":
            php = SINGLE_TEMPLATE_PHP.replace("{title}", spec["title"]).replace("{inline_css}", inline_css_escaped).replace("{content}", content)
            write(THEME / "single-projet.php", php)
        elif spec["slug"] == "blog-single":
            php = SINGLE_TEMPLATE_PHP.replace("{title}", spec["title"]).replace("{inline_css}", inline_css_escaped).replace("{content}", content)
            write(THEME / "single.php", php)
        else:
            php = PAGE_TEMPLATE_PHP.replace("{title}", spec["title"]).replace("{inline_css}", inline_css_escaped).replace("{content}", content)
            write(TEMPLATES_DIR / f"page-{spec['slug']}.php", php)

        # Build DB records if applicable
        if spec["slug"] not in ["projet", "blog-single", "blog-list"]:
            parent_id = slug_to_id.get(spec.get("parent_slug"), 0)
            template_rel = f"templates/page-{spec['slug']}.php"
            pages_with_ids.append({
                "id": slug_to_id[spec["slug"]],
                "slug": spec["slug"],
                "title": spec["title"],
                "parent_id": parent_id,
                "template": template_rel,
                "menu_item": bool(spec.get("menu_order")),
                "menu_order": spec.get("menu_order", 0),
                "is_front": spec.get("front", False),
                "blog_page": spec.get("blog_page", False),
            })

    # SQL
    print("[build-theme] Génération du ficher ACF (inc/acf-registry.php) ...")
    write(THEME / "inc" / "acf-registry.php", acf_magic.generate_acf_php(all_acf_fields))

    print("[build-theme] Génération du SQL ...")
    write(OUT_SQL, build_sql(pages_with_ids))

    print("[build-theme] Terminé.")


if __name__ == "__main__":
    main()
