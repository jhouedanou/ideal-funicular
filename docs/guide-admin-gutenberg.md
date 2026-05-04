# Guide d'administration du site E-Digital

## Mise à jour du site avec Gutenberg, édition des pages et création d'articles de blog

---

**Public visé :** administrateurs et éditeurs du site
**Pré-requis :** disposer d'un compte WordPress avec le rôle *Administrateur* ou *Éditeur*
**URL d'administration :** `https://votre-domaine.com/wp-admin`

---

## Sommaire

1. [Se connecter à l'administration](#1-se-connecter-à-ladministration)
2. [Découvrir l'éditeur Gutenberg](#2-découvrir-léditeur-gutenberg)
3. [Mettre à jour une page existante](#3-mettre-à-jour-une-page-existante)
4. [Travailler avec les blocs E-Digital](#4-travailler-avec-les-blocs-e-digital)
5. [Gérer les médias (images, vidéos, PDF)](#5-gérer-les-médias)
6. [Créer un article de blog](#6-créer-un-article-de-blog)
7. [Catégories, étiquettes et image à la une](#7-catégories-étiquettes-et-image-à-la-une)
8. [Publier, planifier ou mettre en brouillon](#8-publier-planifier-ou-mettre-en-brouillon)
9. [Bonnes pratiques SEO et accessibilité](#9-bonnes-pratiques-seo-et-accessibilité)
10. [Dépannage et questions fréquentes](#10-dépannage-et-questions-fréquentes)

---

## 1. Se connecter à l'administration

1. Ouvrir un navigateur (Chrome, Firefox, Edge, Safari).
2. Se rendre sur `https://votre-domaine.com/wp-admin`.
3. Saisir l'**identifiant** et le **mot de passe** fournis.
4. Cliquer sur **Se connecter**.

Vous arrivez sur le **Tableau de bord**. Le menu de gauche regroupe toutes les sections : Articles, Médias, Pages, Slider Hero, Actualités, Apparence, etc.

> **Conseil sécurité.** Ne partagez jamais votre mot de passe. En cas de doute, demandez à l'administrateur principal de réinitialiser vos accès.

---

## 2. Découvrir l'éditeur Gutenberg

Gutenberg est l'éditeur de contenu officiel de WordPress. Il fonctionne par **blocs** : chaque élément (titre, paragraphe, image, bouton, galerie...) est un bloc indépendant que l'on peut déplacer, dupliquer ou supprimer.

### Anatomie de l'écran

- **Barre supérieure** : boutons *Enregistrer*, *Publier*, *Aperçu*, *Annuler/Refaire*.
- **Zone centrale** : la page ou l'article en cours d'édition.
- **Panneau de droite** : réglages du document (catégories, image à la une, extrait...) ou réglages du bloc sélectionné.
- **Inserter (icône `+` en haut à gauche)** : permet d'ajouter un nouveau bloc.

### Ajouter un bloc

1. Cliquer sur le bouton **+** dans la barre d'outils ou directement dans la zone d'édition.
2. Taper le nom du bloc recherché (ex. *Paragraphe*, *Image*, *Bouton*, *Colonnes*).
3. Cliquer sur le bloc pour l'insérer.

### Déplacer, dupliquer, supprimer un bloc

Sélectionnez le bloc puis utilisez la mini-barre d'outils qui apparaît au-dessus :

- **Flèches haut/bas** : déplacer le bloc.
- **Icône ⋮ (Options)** : *Dupliquer*, *Insérer avant/après*, *Supprimer le bloc*, *Éditer en HTML*.
- **Glisser-déposer** : maintenir l'icône à six points pour déplacer le bloc à la souris.

### Sauvegarder

- **Enregistrer le brouillon** : sauvegarde sans publier.
- **Aperçu** : prévisualisation dans un nouvel onglet.
- **Publier / Mettre à jour** : rend les changements visibles en ligne.

> **Astuce.** WordPress enregistre automatiquement votre travail toutes les minutes (révisions). En cas d'erreur, ouvrez le panneau de droite → *Document* → *Révisions* pour revenir en arrière.

---

## 3. Mettre à jour une page existante

### 3.1. Ouvrir la page

1. Dans le menu de gauche, cliquer sur **Pages**.
2. La liste affiche toutes les pages du site (Accueil, Services, Contact, etc.).
3. Survoler la page à modifier puis cliquer sur **Modifier**.

### 3.2. Modifier du texte

- Cliquer dans le bloc concerné, le contenu devient éditable.
- La barre flottante au-dessus du bloc permet de mettre en **gras**, *italique*, d'ajouter un **lien** (icône chaîne), de changer l'alignement, etc.

### 3.3. Remplacer une image

1. Cliquer sur l'image concernée.
2. Dans la barre d'outils du bloc, choisir **Remplacer**.
3. Sélectionner une image existante dans la **Bibliothèque de médias** ou en téléverser une nouvelle.
4. Renseigner le **Texte alternatif** (important pour l'accessibilité et le SEO) dans le panneau de droite.

### 3.4. Ajouter un bouton ou un lien

- **Lien sur du texte** : sélectionner le texte → cliquer sur l'icône chaîne → coller l'URL → *Entrée*.
- **Nouveau bouton** : Inserter `+` → *Bouton* → saisir le libellé → définir l'URL.

### 3.5. Enregistrer les modifications

Cliquer sur **Mettre à jour** (en haut à droite). Les changements sont immédiatement publiés.

> **Bon réflexe.** Toujours utiliser **Aperçu** avant de cliquer sur *Mettre à jour* afin de vérifier le rendu sur grand écran et sur mobile (icônes en bas de l'aperçu).

---

## 4. Travailler avec les blocs E-Digital

La page d'accueil et certaines pages internes utilisent des **blocs personnalisés** spécifiques au thème, regroupés dans la catégorie **« E-Digital »** de l'inserter.

### Liste des blocs disponibles

| Bloc | Utilité |
|------|---------|
| E-Digital — Intro | Titre principal de section avec ancre |
| E-Digital — Bande défilante (images) | Marquee de logos / images |
| E-Digital — Bande défilante (texte) | Ticker mots-clés |
| E-Digital — Notre Expertise (grille) | Grille de cartes d'expertise |
| E-Digital — Carte expertise | Une carte (image + titre + catégorie) |
| E-Digital — Accordéon services | Section services dépliable |
| E-Digital — Item d'accordéon | Une entrée d'accordéon |
| E-Digital — Section Tarifs | Bloc tarifs (3 cartes) |
| E-Digital — Carte tarif | Une offre tarifaire |
| E-Digital — Hero parallaxe | Bandeau plein écran image + titre |
| E-Digital — Ils nous font confiance | Section logos clients |
| E-Digital — Logo client | Un logo ou nom client stylisé |

### Insérer un bloc E-Digital

1. Placer le curseur à l'endroit voulu.
2. Cliquer sur **+** → onglet **Blocs** → catégorie **E-Digital**.
3. Sélectionner le bloc souhaité.
4. Renseigner les champs proposés (titre, image, texte, lien...).
5. Pour les blocs « parents » (grille, accordéon, tarifs), ajouter les **sous-blocs** via le bouton **+** à l'intérieur du bloc parent.

### Réglages de bloc

Dans le panneau de droite, l'onglet **Bloc** affiche les options spécifiques : couleur, espacement, ancre HTML, classes CSS additionnelles. Modifier avec parcimonie pour préserver la cohérence graphique.

> **Important.** Les éléments dynamiques (Slider Hero, Actualités récentes, formulaire newsletter) ne sont pas des blocs. Ils se gèrent dans des menus dédiés (voir section dédiée du guide technique `GUIDE-ADMIN.md`).

---

## 5. Gérer les médias

### Bibliothèque centrale

**Médias → Bibliothèque** : toutes les images, vidéos et fichiers téléversés.

### Téléverser un nouveau fichier

1. **Médias → Ajouter**.
2. Glisser-déposer le fichier ou cliquer sur **Sélectionner des fichiers**.
3. Une fois envoyé, cliquer sur le fichier pour renseigner :
    - **Titre** : nom interne.
    - **Texte alternatif** : description courte (obligatoire pour les images de contenu).
    - **Légende** / **Description** : facultatif.

### Recommandations

| Type | Format | Poids max conseillé | Dimensions |
|------|--------|---------------------|------------|
| Photo de contenu | JPG ou WebP | 300 Ko | 1600 px de large |
| Logo / icône | SVG ou PNG transparent | 100 Ko | 400 × 400 px |
| Image Hero / bandeau | JPG ou WebP | 500 Ko | 1920 × 1080 px |
| Vidéo de fond | MP4 (H.264) | 5 Mo | 1280 × 720 px, < 15 s |

> **Optimisation.** Compressez vos images avant import (TinyPNG, Squoosh) pour préserver les performances du site.

---

## 6. Créer un article de blog

Les articles s'affichent sur la page **Blog** et alimentent les listes d'actualités.

### 6.1. Nouvel article

1. Menu **Articles → Ajouter**.
2. Saisir le **Titre** dans la zone supérieure.
3. Cliquer en dessous pour commencer à rédiger : un bloc *Paragraphe* est créé automatiquement.

### 6.2. Structurer l'article

- Utilisez les **blocs Titre** (H2, H3) pour découper l'article : meilleur pour la lecture et le référencement.
- Aérer avec des **paragraphes courts**, des **listes** et des **citations**.
- Insérer des images via le bloc **Image** ou **Galerie**.
- Pour mettre en avant une phrase, utiliser le bloc **Citation** ou **Encadré (Pullquote)**.

### 6.3. Ajouter un extrait

Dans le panneau de droite, onglet **Article → Extrait** : saisir 1 à 2 phrases qui résument l'article. Cet extrait s'affiche dans les listes (page Blog, accueil, partages sociaux).

### 6.4. Image à la une

Panneau de droite → **Image mise en avant** → **Définir l'image mise en avant**. Choisir une image au format **paysage 16:9**, minimum **1200 × 675 px**.

> Cette image apparaît dans les vignettes du blog et dans les partages sur les réseaux sociaux.

---

## 7. Catégories, étiquettes et image à la une

### Catégories

- Définissent la **rubrique principale** de l'article (ex. *Actualités*, *Tutoriels*, *Études de cas*).
- Un article peut appartenir à **plusieurs catégories**, mais privilégiez-en une principale.
- Pour créer une catégorie : panneau de droite → **Catégories** → **Ajouter une nouvelle catégorie**.

### Étiquettes (tags)

- Mots-clés transversaux (ex. *SEO*, *WordPress*, *Mobile*).
- Permettent aux lecteurs de trouver des articles connexes.
- 3 à 6 étiquettes pertinentes par article suffisent.

### Auteur

Par défaut, l'auteur est l'utilisateur connecté. Modifiable dans le panneau de droite si besoin.

---

## 8. Publier, planifier ou mettre en brouillon

En haut à droite de l'éditeur, plusieurs options :

| Action | Effet |
|--------|-------|
| **Enregistrer le brouillon** | L'article est sauvegardé mais pas en ligne |
| **Aperçu** | Ouvre une prévisualisation dans un nouvel onglet |
| **Publier** | Met l'article en ligne immédiatement |
| **Planifier** | Avant publication, cliquer sur la date dans le panneau *Article* → choisir une date future. Le bouton *Publier* devient *Planifier* |
| **Visibilité : privé** | Réservé aux utilisateurs connectés ayant les droits |
| **Mettre à la corbeille** | Archive l'article (récupérable 30 jours) |

### Modifier un article déjà publié

1. **Articles → Tous les articles**.
2. Survoler l'article → **Modifier**.
3. Apporter les changements puis cliquer sur **Mettre à jour**.

---

## 9. Bonnes pratiques SEO et accessibilité

- **Titres** : utiliser un seul **H1** (le titre de l'article ou de la page) puis hiérarchiser avec H2, H3.
- **Texte alternatif** : décrire toutes les images de contenu en une phrase claire.
- **Liens** : libellés explicites (« Voir nos services » plutôt que « cliquez ici »).
- **URL (slug)** : garder court, en minuscules, avec des tirets — modifiable dans le panneau *Article → Permalien*.
- **Méta-description** : si le plugin SEO est activé, renseigner un résumé de 150-160 caractères.
- **Mobile** : prévisualiser systématiquement en mode mobile.
- **Performances** : éviter les images > 500 Ko et les vidéos auto-hébergées trop lourdes.

---

## 10. Dépannage et questions fréquentes

**Mes modifications ne sont pas visibles sur le site.**
→ Vérifier que vous avez bien cliqué sur **Mettre à jour** / **Publier**. Vider le cache du navigateur (Ctrl+F5). Si un cache serveur est actif, demander à l'administrateur de le purger.

**Le bloc E-Digital n'apparaît plus dans l'inserter.**
→ Aller dans **Apparence → Thèmes** et vérifier que le thème *E-Digital* est bien activé. Si besoin, contacter le développeur (build à relancer).

**J'ai cassé la mise en page d'un bloc.**
→ Panneau de droite → **Révisions** → restaurer une version antérieure.

**Une image est trop lourde et le site rame.**
→ Compresser via [tinypng.com](https://tinypng.com) ou [squoosh.app](https://squoosh.app) puis remplacer le fichier.

**Mon article ne s'affiche pas dans la liste publique.**
→ Vérifier le **statut** (doit être *Publié*), la **date de publication** (pas dans le futur), la **visibilité** (*Public*) et qu'au moins une **catégorie** est cochée.

**Je n'arrive pas à modifier un élément du site (slider, footer, menu).**
→ Ces éléments ne sont pas dans Gutenberg : voir le guide technique `GUIDE-ADMIN.md` (Slider Hero, ACF, menus...) ou contacter l'équipe technique.

---

## Ressources complémentaires

- Guide technique détaillé : `GUIDE-ADMIN.md` (à la racine du projet)
- Plan de migration Gutenberg : `PLAN-MIGRATION-GUTENBERG.md`
- Documentation officielle WordPress : <https://wordpress.org/documentation/>
- Documentation Gutenberg : <https://fr.wordpress.org/support/article/wordpress-editor/>

---

*Document préparé pour les administrateurs du site E-Digital — version 1.0*
