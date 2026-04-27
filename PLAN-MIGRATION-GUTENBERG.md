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
| Pages service (×7) | 🔲 À faire | — | — |
| Page services (hub) | 🔲 À faire | — | — |
| Page contact | 🔲 À faire | — | — |
| Page nos-projets | 🔲 À faire | — | — |
| Page nos-technologies | 🔲 À faire | — | — |
| Page blog | 🔲 À faire | — | — |
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

---

## Phase 2 — Pages de service (×7) 🔲

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

---

## Phase 3 — Pages hub et contact 🔲

### page-services.php (hub)
- Structure similaire aux pages service mais avec liens vers chaque service
- Bloc à créer : `edigital/services-hub` (grille de liens vers les sous-pages)

### page-contact.php (703 lignes)
- La plus longue — formulaire + adresses + horaires + carte
- Blocs à créer : `edigital/contact-info`, `edigital/office-card`
- Le formulaire de devis (`[edigital_devis]`) reste un shortcode

**ACF à retirer :** `group_page_services`, `group_page_contact`.

---

## Phase 4 — Archives et pages secondaires 🔲

### page-nos-projets.php
- Archive filtrée par taxonomie `expertise` (Isotope)
- Peu de champs ACF (16) — principalement le titre de section
- Bloc à créer : `edigital/projets-intro` (titre + filtre)

### page-nos-technologies.php
- Grille de logos technos
- Bloc à créer : `edigital/technos-grid`

### page-blog.php
- 10 champs ACF, peu d'impact — peut passer en blocs natifs WordPress standards

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
