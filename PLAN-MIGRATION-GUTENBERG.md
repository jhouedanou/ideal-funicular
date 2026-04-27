# Plan de migration ACF → Blocs Gutenberg — Thème E-Digital

## Contexte

L'architecture initiale du thème reposait sur **611 champs ACF** répartis sur 20 groupes,
couvrant 16 templates. Chaque bloc de contenu (titre, texte, image…) était un champ ACF
séparé, rendant l'édition impossible sans connaissance des noms de champs.

**Objectif :** Remplacer les champs ACF par des blocs Gutenberg natifs (`@wordpress/scripts`)
avec rendu PHP côté serveur. Zéro texte hardcodé — tout est éditable depuis l'interface WordPress.

**Principe retenu (option C — hybride) :**
- Sections dynamiques (slider CPT, actualités CPT, newsletter) → restent en PHP dans le template
- Sections éditoriales (intro, expertise, services, tarifs, clients…) → blocs Gutenberg
- CPT individuels (projet, article) → ACF conservé (c'est son cas d'usage légitime)

---

## Déploiement des blocs

### Build local (une seule fois par modification)

```bash
cd wp-content/themes/wp-theme-edigital
npm install       # uniquement la première fois
npm run build     # compile src/ → build/
```

### Déployer en production

```bash
# Commiter le dossier build/ (node_modules est exclu)
git add wp-theme-edigital/build/
git commit -m "Build blocs Gutenberg"
git push
# Sur le serveur :
git pull
# ✅ Aucun npm install nécessaire en production
```

---

## État de la migration

| Page / Template | Statut | Blocs créés | ACF retiré |
|-----------------|--------|-------------|------------|
| **Page d'accueil** (`page-accueil.php`) | ✅ Terminé | 12 blocs | ✅ `group_page_accueil` supprimé |
| **Pages service (×7)** | ✅ Terminé | 5 blocs (service-hero, service-intro, service-text-grid, service-text-card, service-cta) | ✅ 7 groupes désactivés (`'active' => false`) |
| **Page services (hub)** | ✅ Terminé | 1 bloc (`edigital/services-hub`) | ✅ `group_page_services` désactivé |
| **Page contact** | ✅ Terminé | 2 blocs (`edigital/contact-info`, `edigital/office-card`) | ✅ `group_page_contact` désactivé |
| **Page nos-projets** | ✅ Terminé | 1 bloc (`edigital/projets-intro`) + boucle CPT conservée en PHP | ✅ `group_page_nos_projets` désactivé |
| **Page nos-technologies** | ✅ Terminé | 1 bloc (`edigital/technos-grid`) | ✅ `group_page_nos_technologies` désactivé |
| **Page blog** | ✅ Terminé | Blocs natifs WP + boucle posts conservée en PHP | ✅ `group_page_blog` désactivé |
| CPT Projet (single) | ⏸ Garder ACF | — | — |
| CPT Actualité (single) | ⏸ Garder ACF | — | — |

---

## Phase 1 — Page d'accueil ✅

**Fichiers modifiés :**
- `templates/page-accueil.php` — 1260 → 315 lignes (suppression de tous les `get_field()`)
- `inc/acf-registry.php` — groupe `group_page_accueil` retiré (~910 lignes)
- `inc/blocks.php` — loader auto-enregistrant tous les blocs depuis `build/`
- `functions.php` — inclusion de `inc/blocks.php`
- `.gitignore` — `build/` retiré (le dossier compilé doit être commité)

**Blocs créés (`src/` → `build/` après `npm run build`) :**

| Bloc | Nom technique | Rôle |
|------|--------------|------|
| Intro | `edigital/intro` | Titre principal + étiquette + ancre |
| **À Propos** | `edigital/about-section` | **Numéro `-01` + grand titre + image parallax + bouton play vidéo + sous-titre + tag « Expertise ». Reproduit la section absente entre le marquee et la grille expertise.** |
| Bande images | `edigital/marquee-images` | Marquee d'images (sélection médiathèque) |
| Bande texte | `edigital/text-ticker` | Ticker mots-clés double ligne |
| Grille expertise | `edigital/expertise-grid` | Container + CTA |
| Carte expertise | `edigital/expertise-card` | Image + titre + catégorie + lien |
| Accordéon services | `edigital/services-accordion` | Container + titre |
| Item accordéon | `edigital/accordion-item` | Titre + contenu riche (InnerBlocks) |
| Section tarifs | `edigital/pricing` | Container + lignes additionnelles |
| Carte tarif | `edigital/pricing-card` | Titre, prix, points, CTA, style accent |
| Hero parallaxe | `edigital/parallax-hero` | Image fond + titre double ligne |
| Clients | `edigital/clients` | Container + image fond + titre |
| Logo client | `edigital/client-logo` | Texte stylisé avec choix de police |

**Sections conservées en PHP (dynamiques) :**
- Hero slider → CPT `slide`
- Actualités → CPT `actualite` (4 derniers)
- Newsletter → formulaire AJAX Brevo

**Contenu initial à coller dans WP Admin :**
→ `wp-theme-edigital/sql/home-default-content.html`

### Fix post-déploiement (écarts maquette)

Différences observées entre la home rendue et la maquette d'origine, et leur résolution :

| Symptôme | Cause | Résolution |
|----------|-------|------------|
| Hero affiche « Bienvenue chez E-digital » | Aucune slide créée (CPT `slide` vide) | `wp eval-file import-slides.php` (ou via WP admin → Slider Hero → Ajouter) |
| Section « Nous sommes une agence digitale… » absente | Bloc inexistant lors du Phase 1 | ✅ Bloc `edigital/about-section` créé |
| Cartes expertise sans images | Attribut `imageUrl` non rempli dans la fixture | ✅ URLs ajoutées dans `home-default-content.html` |
| Une seule actualité (Hello world!) | Pas de seed CPT `actualite` | Créer manuellement les actualités via WP admin (4 minimum pour remplir la grille) |

**Workflow après modification de la fixture :**

```bash
# 1. Éditer wp-theme-edigital/sql/home-default-content.html
# 2. Régénérer le SQL
python3 wp-theme-edigital/sql/build-sql.py
# 3. Rebuild des blocs (si on a ajouté un nouveau bloc dans src/)
cd wp-theme-edigital && npm run build
# 4. Recharger le stack Docker (purge volume DB pour réimport)
docker compose down -v && docker compose up -d
```

---

## Phase 2 — Pages de service (×7) ✅

**Pages concernées :**
`page-service-creation-web.php`, `page-service-mobile-native.php`,
`page-service-app-metier.php`, `page-service-branding.php`,
`page-service-visibilite-seo.php`, `page-service-visibilite-google-ads.php`,
`page-service-maintenance.php`

**Constat :** Toutes partagent la même structure (231–268 lignes, 26–34 champs ACF).
→ **Un seul jeu de blocs** suffira pour les 7 pages.

**Blocs à créer :**

| Bloc | Rôle |
|------|------|
| `edigital/service-hero` | Bandeau interne (titre page + sous-titre) |
| `edigital/service-intro` | Section texte + numéro + titre masqué |
| `edigital/service-text-grid` | Grille de cartes texte (icône + titre + paragraphe) |
| `edigital/service-text-card` | Sous-bloc carte texte |
| `edigital/service-cta` | Bouton d'appel à l'action |

Les blocs `edigital/text-ticker`, `edigital/services-accordion` et `edigital/parallax-hero`
créés en Phase 1 sont **réutilisables** sur les pages service sans modification.

**ACF à retirer :** groupes `group_page_service_*` (×7) dans `acf-registry.php`.

### ✅ Réalisation

- 5 nouveaux blocs créés sous `src/` : `service-hero`, `service-intro`, `service-text-grid`, `service-text-card` (parent : `service-text-grid`), `service-cta`.
- 7 templates `page-service-*.php` réduits à un squelette de **23 lignes** (`get_header()` + `the_content()` + `get_footer()`).
- CSS commun extrait vers `inc/services-styles.php` (chargé via `wp_add_inline_style` priorité 25) — couvre `.ms-hero-internal`, `.service-text-card`, `.service-cta`, `.btn-cta`, etc.
- Inclusion ajoutée dans `functions.php` : `require_once get_template_directory() . '/inc/services-styles.php';`.
- 7 groupes ACF désactivés dans `inc/acf-registry.php` via `'active' => false` (réversible — il suffit de supprimer la ligne pour réactiver).

> **Important :** Lancer `npm run build` dans `wp-theme-edigital/` pour générer le dossier `build/` des nouveaux blocs avant de tester.

---

## Phase 3 — Pages hub et contact ✅

### page-services.php (hub)
- Structure similaire aux pages service mais avec liens vers chaque service
- Bloc créé : `edigital/services-hub` (grille de cartes — image + titre + description + lien)

### page-contact.php
- Blocs créés : `edigital/contact-info` (téléphone + email + horaires) et `edigital/office-card` (label + adresse)
- Le formulaire de devis (`[edigital_devis]`) reste un shortcode — à insérer via le bloc Shortcode dans la page

**ACF désactivé :** `group_page_services`, `group_page_contact`.

### ✅ Réalisation

- 3 nouveaux blocs créés sous `src/` : `services-hub`, `contact-info`, `office-card`.
- Templates `page-services.php` et `page-contact.php` réduits au squelette `the_content()`.
- 2 groupes ACF désactivés (`'active' => false`).
- Réutilisation du bloc `edigital/service-hero` (Phase 2) pour le bandeau d'en-tête de ces pages.

---

## Phase 4 — Archives et pages secondaires ✅

### page-nos-projets.php
- Archive filtrée par taxonomie (Isotope)
- Bloc créé : `edigital/projets-intro` (titre + sous-titre + boutons de filtre paramétrables)
- La grille des projets reste **dynamique** (boucle `WP_Query` sur le CPT `projet` conservée dans le template)

### page-nos-technologies.php
- Bloc créé : `edigital/technos-grid` (grille items : icône + nom + description, items repeater dans l'inspecteur)

### page-blog.php
- Hero + intro éditables via blocs natifs WordPress + `edigital/service-hero`
- La grille d'articles + pagination restent **dynamiques** (boucle `WP_Query` conservée dans le template)

### ✅ Réalisation

- 2 nouveaux blocs créés sous `src/` : `projets-intro`, `technos-grid`.
- Templates `page-nos-projets.php`, `page-nos-technologies.php`, `page-blog.php` réduits au squelette `the_content()` ; les boucles dynamiques (CPT projet, posts) sont conservées en PHP après le contenu Gutenberg.
- 3 groupes ACF désactivés.

---

## Ce qu'on NE migre PAS

| Template | Raison |
|----------|--------|
| `page-projet.php` (CPT single) | ACF est le bon outil pour les méta d'un projet individuel |
| `page-blog-single.php` | Idem pour les articles |
| CPT `slide` | Géré via CPT + ACF, fonctionne bien en l'état |

---

## Règles de développement

1. **Jamais de texte hardcodé** dans les `render.php` — tout vient des `$attributes`
2. **Rendu PHP uniquement** (`save: () => null`) — pas de markup HTML en JS
3. **`parent`** déclaré dans `block.json` pour les sous-blocs (InnerBlocks)
4. **`get_block_wrapper_attributes()`** systématique dans les `render.php`
5. **`build/` commité** dans git — aucun `npm` sur le serveur de prod
6. **ACF conservé** pour les CPT individuels (projet, actualité, slide)
7. **Désactivation ACF réversible** — on utilise `'active' => false` (et non la suppression du groupe) pour pouvoir réactiver rapidement en cas de besoin.

---

## Récapitulatif des blocs E-Digital

| Phase | Bloc | Rôle |
|-------|------|------|
| 1 | `edigital/intro` | Intro accueil |
| 1 | `edigital/marquee-images` | Bande d'images |
| 1 | `edigital/text-ticker` | Bande de mots-clés |
| 1 | `edigital/expertise-grid` + `edigital/expertise-card` | Cartes expertise |
| 1 | `edigital/services-accordion` + `edigital/accordion-item` | Accordéon |
| 1 | `edigital/pricing` + `edigital/pricing-card` | Tarifs |
| 1 | `edigital/parallax-hero` | Hero parallaxe |
| 1 | `edigital/clients` + `edigital/client-logo` | Logos clients |
| 2 | `edigital/service-hero` | Bandeau interne (titre + breadcrumb) |
| 2 | `edigital/service-intro` | Titre de section masqué |
| 2 | `edigital/service-text-grid` + `edigital/service-text-card` | Grille de cartes texte |
| 2 | `edigital/service-cta` | Section CTA |
| 3 | `edigital/services-hub` | Grille de cartes services (avec liens) |
| 3 | `edigital/contact-info` | Bloc téléphone + email + horaires |
| 3 | `edigital/office-card` | Carte adresse de bureau |
| 4 | `edigital/projets-intro` | Titre + boutons de filtre projets |
| 4 | `edigital/technos-grid` | Grille de technologies |

---

## Référence rapide : commandes

```bash
# Développement (watch + rebuild auto)
cd wp-theme-edigital
npm run start

# Build production
npm run build

# Vérifier la syntaxe JS
npm run lint:js
```
