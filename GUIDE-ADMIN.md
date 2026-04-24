# Guide Administration — Thème E-Digital

## Table des matières

1. [Slider Hero (page d'accueil)](#1-slider-hero)
2. [Cartes de service (pages service)](#2-cartes-de-service)
3. [Ticker texte défilant](#3-ticker-texte-défilant)
4. [Marquee images défilantes](#4-marquee-images-défilantes)
5. [Accordéon Services (page d'accueil)](#5-accordéon-services)
6. [Vidéo popup (section À propos)](#6-vidéo-popup)
7. [Réseaux sociaux (page contact)](#7-réseaux-sociaux)
8. [Articles mis en avant (page blog)](#8-articles-mis-en-avant)
9. [Articles du blog](#9-articles-du-blog)
10. [Projets / Portfolio](#10-projets--portfolio)
11. [Ordre d'affichage des slides](#11-ordre-des-slides)

---

## 1. Slider Hero

**Où** : Menu WordPress → **Slider Hero**

Le slider de la page d'accueil est géré via un type de contenu dédié.  
Chaque slide est un élément indépendant avec ses propres champs.

### Créer une slide

1. Cliquer sur **Slider Hero → Ajouter**
2. Remplir le **Titre** (sert de label interne — apparaît dans la liste admin)
3. Remplir les champs ACF :

| Champ | Description |
|-------|-------------|
| **Titre principal** | Le grand titre affiché (h1). Utilisez `<br/>` pour forcer un saut de ligne |
| **Sous-titre / texte accroche** | Petite ligne sous le titre |
| **Type de média de fond** | Choisir entre **Image** ou **Vidéo (MP4)** |
| **Image de fond** | Visible si type = Image. Recommandé : 1920×1080px minimum |
| **Vidéo de fond (MP4)** | Visible si type = Vidéo. Format MP4 requis |
| **Luminosité du fond** | Entre 0 (noir total) et 1 (luminosité originale). Défaut : 0.4 |
| **Texte du bouton** | Libellé du bouton CTA (ex: "Nos services") |
| **Lien du bouton** | URL de destination du bouton |

4. Cliquer sur **Publier**

### Modifier l'ordre des slides

L'ordre d'affichage correspond au champ **Ordre** (colonne dans la liste).  
→ Aller dans **Slider Hero** (liste), modifier le numéro d'ordre dans chaque slide via **Attributs de la page → Ordre**.

> **Astuce** : Avec le plugin *Simple Page Ordering*, faites glisser-déposer les slides directement dans la liste.

### Masquer temporairement une slide

Passer la slide en **Brouillon** (elle n'apparaît plus sur le site sans être supprimée).

---

## 2. Cartes de service

**Où** : Page de service → section **Composants — Cartes & Ticker**

Chaque page de service (Création Web, Mobile, etc.) affiche des cartes décrivant les prestations. Elles sont éditables directement depuis la page concernée.

### Modifier les cartes

1. Aller dans **Pages** → ouvrir la page de service souhaitée
2. Faire défiler jusqu'au bloc **"Composants — Cartes & Ticker"**
3. Dans le repeater **"Cartes de service"**, cliquer sur **"Ajouter une carte"**

| Champ | Description |
|-------|-------------|
| **Classe icône FontAwesome** | Code de l'icône FA (ex: `fa-globe`, `fa-mobile-alt`, `fa-cogs`). Voir [fontawesome.com](https://fontawesome.com/icons) |
| **Titre** | Titre de la carte (obligatoire) |
| **Tag / catégorie** | Petite étiquette au-dessus du titre (ex: "Présence en ligne") |
| **Description** | Texte de la carte — éditeur WYSIWYG simplifié |

### Réordonner les cartes

Glisser-déposer les lignes du repeater via la poignée ☰ à gauche de chaque ligne.

### Supprimer une carte

Cliquer sur le bouton **×** (croix rouge) à droite de la ligne.

> **Note** : Si le repeater est vide, le site affiche les cartes d'origine codées en dur — le site ne "casse" pas.

---

## 3. Ticker texte défilant

**Où** : Page de service ou page d'accueil → section **Composants — Cartes & Ticker**

La bande de texte animée qui défile horizontalement (ex: "SITES WEB SUR MESURE • APPLICATIONS MOBILES • ...").

### Modifier les items du ticker

1. Ouvrir la page souhaitée dans l'admin
2. Dans le bloc **"Composants — Cartes & Ticker"**, section **"Ticker — texte défilant"**
3. Cliquer sur **"Ajouter un item"** et saisir le texte
4. Réordonner par glisser-déposer
5. Sauvegarder la page

> Le ticker se divise automatiquement en deux rangées animées dans des directions opposées.

---

## 4. Marquee images défilantes

**Où** : Page d'accueil → section principale ACF

La bande d'images/logos qui défile (section entre le slider et la présentation agence).

### Modifier les images

1. Ouvrir la **Page d'accueil** dans l'admin
2. Trouver le champ **"Bannière images défilantes"**
3. Cliquer sur **"Ajouter une image"**

| Champ | Description |
|-------|-------------|
| **Image** | Logo ou image à afficher (recommandé : fond transparent, 200×200px) |
| **Texte alternatif** | Description de l'image pour l'accessibilité |

> Les images sont automatiquement doublées pour créer l'effet de boucle infinie.

---

## 5. Accordéon Services

**Où** : Page d'accueil → section ACF principale

L'accordéon interactif dans la section "Services" de la page d'accueil.

### Modifier les panneaux

1. Ouvrir la **Page d'accueil** dans l'admin
2. Trouver le repeater **"Accordéon Services"**
3. Pour chaque panneau :

| Champ | Description |
|-------|-------------|
| **Titre du panneau** | Affiché en majuscules dans l'en-tête (ex: "CRÉATION WEB") |
| **Contenu** | Texte WYSIWYG — supporte le gras, les listes, les liens |

4. Cliquer sur **"Ajouter un service"** pour en créer un nouveau
5. Supprimer un panneau avec le bouton × rouge
6. Réordonner par glisser-déposer

---

## 6. Vidéo popup

**Où** : Page d'accueil → section ACF principale → champ **"URL vidéo popup"**

Le bouton lecture ▶ dans la section "À propos" ouvre une popup vidéo.

### Changer la vidéo

1. Ouvrir la **Page d'accueil**
2. Trouver le champ **"URL vidéo popup (section À propos)"**
3. Cliquer sur **"Ajouter un fichier"** → sélectionner ou uploader un fichier MP4
4. Sauvegarder

> **Format requis** : MP4 (H.264). Si le champ est vide, la vidéo par défaut du thème s'affiche.

---

## 7. Réseaux sociaux

**Où** : Page Contact → bloc **"Réseaux sociaux"** (panneau latéral)

### Modifier les liens

1. Ouvrir la page **Contact** dans l'admin
2. Dans le panneau latéral droit, trouver le bloc **"Réseaux sociaux"**
3. Renseigner les URLs complètes de chaque réseau :

| Champ | Exemple |
|-------|---------|
| **URL Facebook** | `https://www.facebook.com/edigital` |
| **URL LinkedIn** | `https://www.linkedin.com/company/edigital` |
| **URL Instagram** | `https://www.instagram.com/edigital` |
| **URL X / Twitter** | `https://x.com/edigital` |

4. Laisser vide les réseaux non utilisés (le lien ne s'affichera pas)

---

## 8. Articles mis en avant

**Où** : Page Blog → panneau latéral → **"Articles mis en avant (sidebar)"**

La section "Les plus lus" / articles vedettes affichés en tête de page blog.

### Sélectionner les articles

1. Ouvrir la page **Blog** dans l'admin
2. Dans le panneau latéral, trouver **"Articles mis en avant"**
3. Chercher et sélectionner jusqu'à **3 articles** via le champ de recherche
4. Sauvegarder

> Si aucun article n'est sélectionné, les articles statiques d'origine s'affichent.

---

## 9. Articles du blog

**Où** : Menu → **Articles**

Les articles du blog sont des posts WordPress standards. La page blog et la page de liste affichent automatiquement les derniers articles publiés.

### Créer un article

1. **Articles → Ajouter**
2. Remplir : titre, contenu, **image mise en avant** (importante pour les vignettes)
3. Assigner des **catégories** et des **tags**
4. **Publier**

> L'image mise en avant apparaît dans toutes les vignettes d'article sur le site. Recommandé : 800×600px minimum.

### Catégories et tags

Les catégories et tags apparaissent automatiquement dans les sidebars du blog (plus besoin de les hardcoder). Gérez-les via **Articles → Catégories** et **Articles → Étiquettes**.

---

## 10. Projets / Portfolio

**Où** : Menu → **Projets**

Les projets du portfolio sont un type de contenu personnalisé.

### Créer un projet

1. **Projets → Ajouter**
2. Remplir le titre et le contenu
3. Ajouter une **image mise en avant** (thumbnail du projet)
4. Remplir les champs ACF du projet (client, technologies, etc.)
5. **Publier**

> Les sections "Expertise" et "Nos Projets" se mettent à jour automatiquement.

---

## 11. Ordre des slides

Pour contrôler précisément l'ordre d'affichage :

1. Ouvrir une slide dans **Slider Hero**
2. Dans le panneau **"Attributs de la page"** (sidebar droite), modifier le champ **"Ordre"** (0, 1, 2, 3...)
3. Les slides s'affichent du plus petit au plus grand numéro

---

## Conseils généraux

- **Toujours prévisualiser** avant de publier via le bouton "Prévisualiser les modifications"
- **Ne pas supprimer** les éléments : préférer les passer en **Brouillon** pour les masquer temporairement
- Les modifications dans l'admin sont **instantanément visibles** sur le site (pas de cache à vider sauf si un plugin de cache est actif)
- En cas de doute, utiliser **Ctrl+Z** (ou Cmd+Z) dans l'éditeur pour annuler la dernière action

---

*Guide généré pour le thème E-Digital — version 1.0*
