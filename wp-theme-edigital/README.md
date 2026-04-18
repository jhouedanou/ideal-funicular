# Thème WordPress E-Digital

Thème WordPress généré à partir du site statique E-Digital. Toutes les pages
sont importées comme contenu Gutenberg (blocs) et restent **entièrement
éditables depuis l'administration WordPress**.

## Contenu du dossier

```
wp-theme-edigital/
├── style.css            ← en-tête du thème
├── functions.php        ← enregistrement des supports, assets, shortcodes
├── header.php           ← en-tête commun (logo + menu primaire)
├── footer.php           ← pied de page commun (coordonnées + menu footer)
├── index.php            ← fallback + liste d'articles
├── page.php             ← gabarit des pages Gutenberg
├── front-page.php       ← gabarit de la page d'accueil
├── single.php           ← gabarit d'article de blog
├── archive.php          ← archives (catégories, tags, auteurs)
├── search.php           ← résultats de recherche
├── 404.php              ← page 404
├── inc/
│   └── template-tags.php  ← helpers (fil d'Ariane, fallback menu)
├── assets/              ← CSS/JS/fonts/images du site statique
├── api/                 ← endpoint de traitement du formulaire de contact
└── sql/
    ├── build-sql.py        ← script de génération
    └── edigital-pages.sql  ← import SQL des pages
```

## Installation

### 1. Installer le thème

1. Copier (ou zipper puis uploader) le dossier `wp-theme-edigital/` dans
   `wp-content/themes/` de votre installation WordPress.
2. Dans l'administration : **Apparence → Thèmes → Activer** « E-Digital ».

### 2. Importer les pages Gutenberg

Le fichier `sql/edigital-pages.sql` crée 13 pages éditables + un menu principal
et configure la page d'accueil statique et la page du blog.

```bash
mysql -u USER -p BASE < wp-theme-edigital/sql/edigital-pages.sql
```

- Le script suppose le préfixe de tables `wp_`. Pour un préfixe différent,
  faites un *search/replace* sur `wp_` avant import.
- Le script est **idempotent** : on peut le relancer sans créer de doublons.
- Après import, allez dans **Apparence → Menus** pour vérifier que le menu
  « E-Digital Primary » est bien assigné à l'emplacement « Menu principal ».

### 3. Pages créées

| Slug                              | Titre                                      | Source HTML                          |
|-----------------------------------|--------------------------------------------|--------------------------------------|
| `accueil`                         | Accueil (page d'accueil statique)          | `index.html`                         |
| `services`                        | Nos Services                               | `services.html`                      |
| `service-creation-web`            | Création de Site Web                       | `service-creation-web.html`          |
| `service-mobile-native`           | Applications Mobiles Natives               | `service-mobile-native.html`         |
| `service-app-metier`              | Applications Métier                        | `service-app-metier.html`            |
| `service-branding`                | Branding & Design                          | `service-branding.html`              |
| `service-visibilite-seo`          | Visibilité SEO & Référencement Naturel     | `service-visibilite-seo.html`        |
| `service-visibilite-google-ads`   | Publicité Google Ads & Meta Ads            | `service-visibilite-google-ads.html` |
| `service-maintenance`             | Maintenance & Support Technique            | `service-maintenance.html`           |
| `nos-technologies`                | Nos Technologies                           | `nos-technologies.html`              |
| `nos-projets`                     | Nos Projets                                | `nos-projets.html`                   |
| `blog`                            | Blog (page pour les articles)              | `blog.html`                          |
| `contact`                         | Contact                                    | `contact.html`                       |

Toutes les pages utilisent le gabarit `page.php` et des blocs standard :
`core/heading`, `core/paragraph`, `core/list`, `core/buttons`, ainsi que
quelques `core/shortcode` pour les éléments dynamiques (bandeau défilant,
formulaire de contact).

## Shortcodes fournis

| Shortcode              | Rôle                                                        |
|------------------------|-------------------------------------------------------------|
| `[edigital_marquee]`   | Bandeau défilant de mots-clés (attribut `items="a, b, c"`). |
| `[edigital_contact_form]` | Formulaire de contact utilisant `assets/api/send.php`.   |

## Régénérer le fichier SQL

Les contenus Gutenberg sont reconstruits depuis les sources HTML par le script
`sql/build-sql.py` (nécessite Python 3.9+ et `beautifulsoup4` + `lxml`) :

```bash
pip install beautifulsoup4 lxml
python3 wp-theme-edigital/sql/build-sql.py
```

Le script peut être adapté (classe `PAGES`) pour ajouter de nouvelles pages,
changer les *hero*, les CTA ou les bandeaux.

## Assets & licences

Les dossiers `assets/` et `api/` proviennent du site statique d'origine
(template Mokko personnalisé E-Digital). Ils sont réutilisés tels quels par le
thème ; seules les références ont été adaptées pour passer par les API
WordPress (`wp_enqueue_*`, `get_template_directory_uri()`).
