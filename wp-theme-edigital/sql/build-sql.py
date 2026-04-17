#!/usr/bin/env python3
"""
Génère le fichier SQL d'import des pages E-Digital en contenu Gutenberg.

Entrée  : les fichiers *.html à la racine du projet.
Sortie  : wp-theme-edigital/sql/edigital-pages.sql

Le SQL est idempotent : il supprime d'abord les pages dont le post_name
correspond à nos slugs, puis réinsère les données.

Utilisation :
    python3 wp-theme-edigital/sql/build-sql.py
"""

from __future__ import annotations

import html
import json
import os
import re
from pathlib import Path

from bs4 import BeautifulSoup

ROOT = Path(__file__).resolve().parents[2]
THEME = ROOT / "wp-theme-edigital"
OUT_SQL = THEME / "sql" / "edigital-pages.sql"

# ---------------------------------------------------------------------------
# Helpers Gutenberg
# ---------------------------------------------------------------------------

def block_heading(text: str, level: int = 2) -> str:
    return (
        f'<!-- wp:heading {{"level":{level}}} -->\n'
        f'<h{level} class="wp-block-heading">{html.escape(text)}</h{level}>\n'
        f'<!-- /wp:heading -->'
    )


def block_paragraph(text: str) -> str:
    return (
        '<!-- wp:paragraph -->\n'
        f'<p>{html.escape(text)}</p>\n'
        '<!-- /wp:paragraph -->'
    )


def block_list(items: list[str], ordered: bool = False) -> str:
    tag = 'ol' if ordered else 'ul'
    attrs = ' {"ordered":true}' if ordered else ''
    items_html = "\n".join(
        f'<!-- wp:list-item -->\n<li>{html.escape(i)}</li>\n<!-- /wp:list-item -->'
        for i in items
    )
    return (
        f'<!-- wp:list{attrs} -->\n'
        f'<{tag}>\n{items_html}\n</{tag}>\n'
        f'<!-- /wp:list -->'
    )


def block_button(label: str, url: str) -> str:
    return (
        '<!-- wp:buttons -->\n'
        '<div class="wp-block-buttons">\n'
        '<!-- wp:button -->\n'
        f'<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="{html.escape(url)}">{html.escape(label)}</a></div>\n'
        '<!-- /wp:button -->\n'
        '</div>\n'
        '<!-- /wp:buttons -->'
    )


def block_image(src: str, alt: str = "") -> str:
    return (
        '<!-- wp:image {"align":"wide"} -->\n'
        f'<figure class="wp-block-image alignwide"><img src="{html.escape(src)}" alt="{html.escape(alt)}"/></figure>\n'
        '<!-- /wp:image -->'
    )


def block_shortcode(shortcode: str) -> str:
    return f'<!-- wp:shortcode -->\n{shortcode}\n<!-- /wp:shortcode -->'


def block_group(inner_blocks: list[str], class_name: str = "edigital-section") -> str:
    inner = "\n\n".join(inner_blocks)
    return (
        f'<!-- wp:group {{"className":"{class_name}"}} -->\n'
        f'<div class="wp-block-group {class_name}">\n{inner}\n</div>\n'
        f'<!-- /wp:group -->'
    )


# ---------------------------------------------------------------------------
# Extraction des contenus par page
# ---------------------------------------------------------------------------

def parse(path: Path) -> BeautifulSoup:
    return BeautifulSoup(path.read_text(encoding="utf-8"), "lxml")


def clean(text: str) -> str:
    return re.sub(r"\s+", " ", text or "").strip()


def section_text(section) -> list[str]:
    """Extrait les paragraphes et titres en gardant l'ordre."""
    blocks = []
    for el in section.find_all(["h1", "h2", "h3", "h4", "h5", "p"]):
        txt = clean(el.get_text(" ", strip=True))
        if not txt or len(txt) < 3:
            continue
        blocks.append((el.name, txt))
    return blocks


def to_blocks(items: list[tuple[str, str]]) -> list[str]:
    out = []
    seen = set()
    for tag, txt in items:
        if (tag, txt) in seen:
            continue
        seen.add((tag, txt))
        if tag.startswith("h"):
            out.append(block_heading(txt, int(tag[1])))
        else:
            out.append(block_paragraph(txt))
    return out


# ---------------------------------------------------------------------------
# Contenus spécifiques par page
# ---------------------------------------------------------------------------

def build_home() -> list[str]:
    return [
        block_heading("Agence Digitale Avant-gardiste", 1),
        block_paragraph(
            "Participe à la croissance des TPE et PME. "
            "E-Digital est une agence digitale spécialisée dans le développement "
            "web et mobile au service des TPE/PME depuis 2003."
        ),
        block_button("Accéder à nos services", "/services/"),
        block_heading("À Propos", 2),
        block_paragraph(
            "Nous sommes une agence digitale spécialisée dans le développement "
            "web et mobile au service des TPE/PME depuis 2003. Budget maîtrisé "
            "pour CMS, CRM, ERP, Prestashop."
        ),
        block_heading("Notre expertise", 2),
        block_list([
            "Conception Web sur Mesure — Sites Web & E-commerce",
            "Applications Mobiles — iOS & Android",
            "Logiciels Métier — CRM, ERP & Solutions",
            "Référencement SEO / SEA — Marketing Digital",
            "Création d'Identité Visuelle — Branding & Design",
            "Maintenance & Hébergement — Support Technique",
        ]),
        block_button("Voir tous les projets", "/nos-projets/"),
        block_shortcode(
            '[edigital_marquee items="SITES WEB SUR MESURE, APPLICATIONS MOBILES, '
            'LOGICIELS MÉTIER, SOLUTION SMMA, SITES E-COMMERCE, SEO & STRATÉGIE DIGITALE, '
            'DESIGN PREMIUM, ACCOMPAGNEMENT DÉDIÉ, INNOVATION TECH, EXPERTISE WEB"]'
        ),
        block_heading("Des solutions pour votre succès", 2),
        block_paragraph(
            "Conception et développement web innovant depuis 2003. "
            "Nous donnons vie à vos idées grâce à notre maîtrise des dernières "
            "technologies web et mobiles."
        ),
        block_button("En savoir plus", "/services/"),
    ]


def build_from_page(file: str, hero_title: str, hero_lede: str,
                    marquee: list[str] | None = None,
                    cta: tuple[str, str] | None = None) -> list[str]:
    """Construit les blocs d'une page à partir de son fichier HTML source."""
    soup = parse(ROOT / file)
    for t in soup(["script", "style", "noscript", "svg", "nav"]):
        t.decompose()

    blocks: list[str] = [
        block_heading(hero_title, 1),
        block_paragraph(hero_lede),
    ]

    main = soup.select_one(".ms-page-content") or soup.body
    # On saute la section hero (déjà rendue ci-dessus) et les sections
    # purement visuelles / marquee.
    sections = main.select("section")
    if len(sections) > 1:
        for sec in sections[1:]:
            classes = " ".join(sec.get("class") or [])
            if "marquee" in classes or "ms-marquee" in classes:
                continue
            items = section_text(sec)
            # Ignore les sections trop vides.
            if not items or sum(len(t) for _, t in items) < 40:
                continue
            blocks.extend(to_blocks(items))

    if marquee:
        blocks.append(
            block_shortcode('[edigital_marquee items="' + ", ".join(marquee) + '"]')
        )

    if cta:
        label, url = cta
        blocks.append(block_button(label, url))

    return blocks


# ---------------------------------------------------------------------------
# Spécification des pages
# ---------------------------------------------------------------------------

PAGES = [
    {
        "slug": "accueil",
        "title": "Accueil",
        "source": "index.html",
        "front": True,
        "menu_order": 1,
        "builder": build_home,
    },
    {
        "slug": "services",
        "title": "Nos Services",
        "source": "services.html",
        "menu_order": 2,
        "hero_title": "Nos Services",
        "hero_lede": "Des solutions sur-mesure pour donner vie à vos projets et propulser votre entreprise dans l'ère digitale.",
        "marquee": [
            "SITES WEB SUR MESURE", "APPLICATIONS MOBILES", "LOGICIELS MÉTIER",
            "SOLUTION SMMA", "SITES E-COMMERCE", "SEO & STRATÉGIE DIGITALE",
            "DESIGN PREMIUM", "ACCOMPAGNEMENT DÉDIÉ", "INNOVATION TECH",
        ],
        "cta": ("Discutons de votre projet", "/contact/"),
    },
    {
        "slug": "service-creation-web",
        "title": "Création de Site Web",
        "source": "service-creation-web.html",
        "menu_order": 3,
        "parent_slug": "services",
        "hero_title": "Création de Site Web",
        "hero_lede": "Des sites modernes, réactifs et optimisés SEO, conçus pour convertir vos visiteurs en clients.",
        "cta": ("Demander un devis gratuit", "/contact/"),
    },
    {
        "slug": "service-mobile-native",
        "title": "Applications Mobiles Natives",
        "source": "service-mobile-native.html",
        "menu_order": 4,
        "parent_slug": "services",
        "hero_title": "Applications Mobiles Natives",
        "hero_lede": "Offrez une expérience utilisateur exceptionnelle sur iOS et Android.",
        "cta": ("Parlons de votre application", "/contact/"),
    },
    {
        "slug": "service-app-metier",
        "title": "Applications Métier",
        "source": "service-app-metier.html",
        "menu_order": 5,
        "parent_slug": "services",
        "hero_title": "Applications Métier : L'outil sur-mesure pour votre performance",
        "hero_lede": "Vos processus internes sont ralentis par des fichiers Excel complexes ou des logiciels rigides ? Pour franchir un cap, votre entreprise a besoin d'outils qui s'adaptent à votre manière de travailler, et non l'inverse.",
        "cta": ("Discuter de mon projet d'application", "/contact/"),
    },
    {
        "slug": "service-branding",
        "title": "Branding & Design",
        "source": "service-branding.html",
        "menu_order": 6,
        "parent_slug": "services",
        "hero_title": "Branding & Design : Soyez mémorable, soyez leader",
        "hero_lede": "Votre identité visuelle est la première promesse que vous faites à vos clients. Le branding, c'est l'art de transformer votre expertise en une marque forte et reconnaissable.",
        "cta": ("Demander un devis", "/contact/"),
    },
    {
        "slug": "service-visibilite-seo",
        "title": "Visibilité SEO & Référencement Naturel",
        "source": "service-visibilite-seo.html",
        "menu_order": 7,
        "parent_slug": "services",
        "hero_title": "Votre site existe, mais reste invisible ?",
        "hero_lede": "Un site sans trafic est un investissement perdu. Si votre plateforme ne génère ni contacts ni ventes, ce n'est pas un problème de design, c'est un problème de visibilité.",
        "cta": ("Demander un devis gratuit", "/contact/"),
    },
    {
        "slug": "service-visibilite-google-ads",
        "title": "Publicité Google Ads & Meta Ads",
        "source": "service-visibilite-google-ads.html",
        "menu_order": 8,
        "parent_slug": "services",
        "hero_title": "Publicité Google & Meta : Dominez votre marché",
        "hero_lede": "Vous voulez des résultats immédiats ? Là où le SEO prend des mois, la publicité payante (Google Ads & Meta Ads) vous propulse en tête de liste en 24 heures.",
        "cta": ("Démarrer vos campagnes", "/contact/"),
    },
    {
        "slug": "service-maintenance",
        "title": "Maintenance & Support Technique",
        "source": "service-maintenance.html",
        "menu_order": 9,
        "parent_slug": "services",
        "hero_title": "Maintenance : Sécurisez votre actif numérique",
        "hero_lede": "Un site ou une application qui tombe, c'est une perte immédiate de chiffre d'affaires et de crédibilité. La technologie évolue chaque jour : ne laissez pas l'obsolescence ou une faille technique paralyser votre entreprise.",
        "cta": ("Demander un devis", "/contact/"),
    },
    {
        "slug": "nos-technologies",
        "title": "Nos Technologies",
        "source": "nos-technologies.html",
        "menu_order": 10,
        "hero_title": "Nos Technologies",
        "hero_lede": "Nous maîtrisons les outils les plus performants pour donner vie à vos projets les plus ambitieux.",
    },
    {
        "slug": "nos-projets",
        "title": "Nos Projets",
        "source": "nos-projets.html",
        "menu_order": 11,
        "hero_title": "Nos Projets",
        "hero_lede": "Découvrez nos dernières réalisations et laissez-vous inspirer pour votre futur projet digital.",
    },
    {
        "slug": "blog",
        "title": "Blog",
        "source": "blog.html",
        "menu_order": 12,
        "page_for_posts": True,
        "hero_title": "Notre Blog",
        "hero_lede": "Actualités, conseils et tendances du monde digital pour propulser votre activité.",
    },
    {
        "slug": "contact",
        "title": "Contact",
        "source": "contact.html",
        "menu_order": 13,
        "hero_title": "Contact",
        "hero_lede": "Parlons de votre projet. Nous revenons vers vous très rapidement.",
        "builder_extra": lambda: [
            block_heading("Parlons de votre projet", 2),
            block_paragraph("Appelez-nous : 01 84 25 16 81"),
            block_paragraph("Écrivez-nous : com1@e-digital.fr"),
            block_heading("Nos adresses", 2),
            block_paragraph("Paris — Siège social : 23 rue du départ, 75014 Paris"),
            block_paragraph("Agence Yvelines : Guyancourt (78280)"),
            block_heading("Horaires", 3),
            block_paragraph("Lun – Ven : 8H à 17H30"),
            block_heading("Formulaire de contact", 2),
            block_shortcode("[edigital_contact_form]"),
        ],
    },
]


# ---------------------------------------------------------------------------
# Génération du SQL
# ---------------------------------------------------------------------------

def sql_escape(s: str) -> str:
    return s.replace("\\", "\\\\").replace("'", "''")


SQL_HEADER = """-- -----------------------------------------------------------------------
-- E-Digital — Import des pages Gutenberg
-- Généré automatiquement par wp-theme-edigital/sql/build-sql.py
-- Prérequis : une installation WordPress avec le préfixe de tables `wp_`.
--             Adaptez le préfixe si nécessaire (rechercher/remplacer `wp_`).
-- Lancement : mysql -u USER -p DB < edigital-pages.sql
-- Idempotent : re-exécuter la requête remplace les pages dont le slug matche.
-- -----------------------------------------------------------------------

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- Nettoyage préalable des pages E-Digital déjà présentes.
DELETE pm FROM wp_postmeta pm
  INNER JOIN wp_posts p ON p.ID = pm.post_id
  WHERE (p.post_name IN ({slug_list}) OR p.post_name IN ({menu_slug_list}))
    AND p.post_type IN ('page','nav_menu_item');

DELETE FROM wp_posts
  WHERE (post_name IN ({slug_list}) OR post_name IN ({menu_slug_list}))
    AND post_type IN ('page','nav_menu_item');

-- Nettoyage du menu principal E-Digital.
DELETE tr FROM wp_term_relationships tr
  INNER JOIN wp_term_taxonomy tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
  INNER JOIN wp_terms t ON t.term_id = tt.term_id
  WHERE tt.taxonomy = 'nav_menu' AND t.slug = 'edigital-primary';

DELETE tt FROM wp_term_taxonomy tt
  INNER JOIN wp_terms t ON t.term_id = tt.term_id
  WHERE tt.taxonomy = 'nav_menu' AND t.slug = 'edigital-primary';

DELETE FROM wp_terms WHERE slug = 'edigital-primary';

"""


def build() -> None:
    pages_sql = []
    slug_list_sql = ", ".join(f"'{p['slug']}'" for p in PAGES)
    menu_slug_list_sql = ", ".join(f"'{p['slug']}-menu-item'" for p in PAGES)

    # On fige des IDs de post pour rendre les parents/menu traçables.
    post_ids = {p["slug"]: 10001 + i for i, p in enumerate(PAGES)}

    for p in PAGES:
        slug = p["slug"]
        post_id = post_ids[slug]
        parent_id = post_ids.get(p.get("parent_slug"), 0)

        if "builder" in p:
            blocks = p["builder"]()
        else:
            blocks = build_from_page(
                p["source"],
                p["hero_title"],
                p["hero_lede"],
                marquee=p.get("marquee"),
                cta=p.get("cta"),
            )
            extra = p.get("builder_extra")
            if extra:
                blocks.extend(extra())

        content = "\n\n".join(blocks)
        excerpt = p.get("hero_lede", "")
        title = p["title"]
        menu_order = p.get("menu_order", 0)

        pages_sql.append(
            f"-- Page : {title} ({slug})\n"
            f"INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, "
            f"post_content, post_title, post_excerpt, post_status, comment_status, "
            f"ping_status, post_password, post_name, to_ping, pinged, post_modified, "
            f"post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, "
            f"post_type, post_mime_type, comment_count) VALUES (\n"
            f"  {post_id}, 1, NOW(), UTC_TIMESTAMP(),\n"
            f"  '{sql_escape(content)}',\n"
            f"  '{sql_escape(title)}',\n"
            f"  '{sql_escape(excerpt)}',\n"
            f"  'publish', 'closed', 'closed', '',\n"
            f"  '{sql_escape(slug)}',\n"
            f"  '', '', NOW(), UTC_TIMESTAMP(), '',\n"
            f"  {parent_id},\n"
            f"  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id={post_id}'),\n"
            f"  {menu_order}, 'page', '', 0\n"
            f");"
        )

        # Template par défaut : page.php (on l'indique dans _wp_page_template
        # pour rester explicite).
        pages_sql.append(
            f"INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES "
            f"({post_id}, '_wp_page_template', 'page.php');"
        )

    # Options : front-page + page-for-posts.
    front_id = post_ids["accueil"]
    blog_id = post_ids["blog"]
    options_sql = [
        "-- Page d'accueil statique + page du blog",
        "INSERT INTO wp_options (option_name, option_value, autoload) VALUES "
        "('show_on_front','page','yes') "
        "ON DUPLICATE KEY UPDATE option_value = VALUES(option_value);",
        f"INSERT INTO wp_options (option_name, option_value, autoload) VALUES "
        f"('page_on_front','{front_id}','yes') "
        f"ON DUPLICATE KEY UPDATE option_value = VALUES(option_value);",
        f"INSERT INTO wp_options (option_name, option_value, autoload) VALUES "
        f"('page_for_posts','{blog_id}','yes') "
        f"ON DUPLICATE KEY UPDATE option_value = VALUES(option_value);",
    ]

    # Menu principal.
    menu_sql = [
        "-- Menu principal E-Digital (emplacement 'primary').",
        "INSERT INTO wp_terms (name, slug, term_group) VALUES "
        "('E-Digital Primary', 'edigital-primary', 0);",
        "SET @menu_term_id := LAST_INSERT_ID();",
        "INSERT INTO wp_term_taxonomy (term_id, taxonomy, description, parent, count) VALUES "
        "(@menu_term_id, 'nav_menu', '', 0, 0);",
        "SET @menu_tt_id := LAST_INSERT_ID();",
    ]

    # Items de menu : on ne prend que les pages de niveau racine.
    menu_items = [p for p in PAGES if not p.get("parent_slug")]
    for i, p in enumerate(menu_items, start=1):
        item_id = 11000 + i
        menu_sql.append(
            f"INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, "
            f"post_content, post_title, post_excerpt, post_status, comment_status, "
            f"ping_status, post_password, post_name, to_ping, pinged, post_modified, "
            f"post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, "
            f"post_type, post_mime_type, comment_count) VALUES (\n"
            f"  {item_id}, 1, NOW(), UTC_TIMESTAMP(), '', '{sql_escape(p['title'])}', '', "
            f"'publish', 'closed', 'closed', '', '{sql_escape(p['slug'])}-menu-item', "
            f"'', '', NOW(), UTC_TIMESTAMP(), '', 0, '', {i}, 'nav_menu_item', '', 0\n"
            f");"
        )
        menu_sql.append(
            f"INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES "
            f"({item_id}, '_menu_item_type', 'post_type'),"
            f"({item_id}, '_menu_item_menu_item_parent', '0'),"
            f"({item_id}, '_menu_item_object_id', '{post_ids[p['slug']]}'),"
            f"({item_id}, '_menu_item_object', 'page'),"
            f"({item_id}, '_menu_item_target', ''),"
            f"({item_id}, '_menu_item_classes', 'a:1:{{i:0;s:0:\"\";}}'),"
            f"({item_id}, '_menu_item_xfn', ''),"
            f"({item_id}, '_menu_item_url', '');"
        )
        menu_sql.append(
            f"INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) VALUES "
            f"({item_id}, @menu_tt_id, 0);"
        )

    # Compte réel des items dans la taxonomie.
    menu_sql.append(
        f"UPDATE wp_term_taxonomy SET count = {len(menu_items)} WHERE term_taxonomy_id = @menu_tt_id;"
    )

    # Emplacement du menu.
    menu_sql.append(
        "-- Auto-assignation de l'emplacement 'primary' : le thème applique ce"
    )
    menu_sql.append(
        "-- mod via after_switch_theme (voir functions.php). Si vous préférez"
    )
    menu_sql.append(
        "-- l'assigner en base, décommentez et adaptez la ligne ci-dessous en"
    )
    menu_sql.append(
        "-- remplaçant 'wp-theme-edigital' par le nom du dossier du thème :"
    )
    menu_sql.append(
        "-- INSERT INTO wp_options (option_name, option_value, autoload) VALUES"
    )
    menu_sql.append(
        "--   ('theme_mods_wp-theme-edigital',"
    )
    menu_sql.append(
        "--    CONCAT('a:1:{s:18:\"nav_menu_locations\";a:1:{s:7:\"primary\";i:', @menu_term_id, ';}}'),"
    )
    menu_sql.append(
        "--    'yes')"
    )
    menu_sql.append(
        "--   ON DUPLICATE KEY UPDATE option_value = VALUES(option_value);"
    )

    # Écriture finale.
    final = (
        SQL_HEADER.format(slug_list=slug_list_sql, menu_slug_list=menu_slug_list_sql)
        + "\n".join(pages_sql)
        + "\n\n"
        + "\n".join(options_sql)
        + "\n\n"
        + "\n".join(menu_sql)
        + "\n\nSET FOREIGN_KEY_CHECKS = 1;\n"
        "-- Fin de l'import E-Digital.\n"
    )

    OUT_SQL.parent.mkdir(parents=True, exist_ok=True)
    OUT_SQL.write_text(final, encoding="utf-8")
    print(f"✓ {OUT_SQL} ({len(final):,} bytes, {len(PAGES)} pages)")


if __name__ == "__main__":
    build()
