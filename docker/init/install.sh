#!/bin/sh
# Script d'initialisation WordPress pour le conteneur wp-install (WP-CLI).
# Idempotent : peut être relancé sans créer de doublons.
set -eu

MARKER="/var/www/html/.edigital-installed"
SQL_FILE="/var/www/html/wp-content/themes/edigital/sql/edigital-pages.sql"

echo "[edigital] Attente de la disponibilité de wp-config.php ..."
i=0
while [ ! -f /var/www/html/wp-config.php ] && [ $i -lt 60 ]; do
  sleep 2
  i=$((i + 1))
done

if [ ! -f /var/www/html/wp-config.php ]; then
  echo "[edigital] wp-config.php absent après 120s — abandon." >&2
  exit 1
fi

echo "[edigital] Attente de la disponibilité de la base ..."
i=0
until wp db check --path=/var/www/html >/dev/null 2>&1; do
  i=$((i + 1))
  if [ $i -ge 30 ]; then
    echo "[edigital] Base indisponible après 60s — abandon." >&2
    exit 1
  fi
  sleep 2
done

if ! wp core is-installed --path=/var/www/html >/dev/null 2>&1; then
  echo "[edigital] Installation de WordPress ..."
  wp core install \
    --path=/var/www/html \
    --url="${WP_URL:-http://localhost:8080}" \
    --title="${WP_TITLE:-E-Digital}" \
    --admin_user="${WP_ADMIN_USER:-admin}" \
    --admin_password="${WP_ADMIN_PASSWORD:-admin}" \
    --admin_email="${WP_ADMIN_EMAIL:-admin@edigital.local}" \
    --skip-email
else
  echo "[edigital] WordPress déjà installé — skip core install."
fi

echo "[edigital] Activation du thème E-Digital ..."
wp theme activate edigital --path=/var/www/html

# Plugins indispensables. Variable EDIGITAL_PLUGINS (CSV) personnalisable.
PLUGINS="${EDIGITAL_PLUGINS:-elementor,advanced-custom-fields}"
echo "[edigital] Installation/activation des plugins : $PLUGINS"
OLD_IFS=$IFS
IFS=','
for plug in $PLUGINS; do
  plug=$(echo "$plug" | tr -d ' ')
  [ -z "$plug" ] && continue
  if ! wp plugin is-installed "$plug" --path=/var/www/html >/dev/null 2>&1; then
    echo "[edigital]   → installation de $plug"
    wp plugin install "$plug" --activate --path=/var/www/html || echo "[edigital]   !! échec $plug (on continue)"
  else
    wp plugin activate "$plug" --path=/var/www/html || true
  fi
done
IFS=$OLD_IFS

if [ -f "$MARKER" ]; then
  echo "[edigital] Contenu déjà importé (marker présent) — skip SQL import."
else
  if [ -f "$SQL_FILE" ]; then
    echo "[edigital] Import du contenu Gutenberg depuis $SQL_FILE ..."
    wp db import "$SQL_FILE" --path=/var/www/html
    touch "$MARKER"
    echo "[edigital] Import terminé."
  else
    echo "[edigital] Fichier SQL introuvable : $SQL_FILE" >&2
    exit 1
  fi
fi

# -----------------------------------------------------------------------------
# Seed des CPT « slide » et « actualite ».
# Scripts WP-CLI idempotents (skip si l'entrée existe déjà), donc relançables
# sans danger. Les fichiers vivent dans wp-theme-edigital/sql/seed/.
# -----------------------------------------------------------------------------
SLIDES_SCRIPT="/var/www/html/wp-content/themes/edigital/sql/seed/import-slides.php"
ACTUALITES_SCRIPT="/var/www/html/wp-content/themes/edigital/sql/seed/import-actualites.php"
MIGRATE_POSTS_SCRIPT="/var/www/html/wp-content/themes/edigital/sql/seed/migrate-actualites-to-posts.php"
PROJETS_SCRIPT="/var/www/html/wp-content/themes/edigital/sql/seed/import-projets.php"

if [ -f "$SLIDES_SCRIPT" ]; then
  echo "[edigital] Seed des slides (CPT slide) ..."
  wp eval-file "$SLIDES_SCRIPT" --path=/var/www/html || echo "[edigital]   !! seed slides en erreur (on continue)"
else
  echo "[edigital] Script import-slides.php introuvable — skip."
fi

if [ -f "$ACTUALITES_SCRIPT" ]; then
  echo "[edigital] Seed des actualités (CPT actualite) ..."
  wp eval-file "$ACTUALITES_SCRIPT" --path=/var/www/html || echo "[edigital]   !! seed actualités en erreur (on continue)"
else
  echo "[edigital] Script import-actualites.php introuvable — skip."
fi

# Migration actualités → posts standards (alimente la page Blog + sidebar
# « Les plus lus »). Idempotent : se contente d'enrichir si déjà migré.
if [ -f "$MIGRATE_POSTS_SCRIPT" ]; then
  echo "[edigital] Migration actualités → posts standards ..."
  wp eval-file "$MIGRATE_POSTS_SCRIPT" --path=/var/www/html || echo "[edigital]   !! migration posts en erreur (on continue)"
else
  echo "[edigital] Script migrate-actualites-to-posts.php introuvable — skip."
fi

if [ -f "$PROJETS_SCRIPT" ]; then
  echo "[edigital] Seed des projets (CPT projet) ..."
  wp eval-file "$PROJETS_SCRIPT" --path=/var/www/html || echo "[edigital]   !! seed projets en erreur (on continue)"
else
  echo "[edigital] Script import-projets.php introuvable — skip."
fi

echo "[edigital] Application des permaliens jolis ..."
wp rewrite structure '/%postname%/' --path=/var/www/html
wp rewrite flush --path=/var/www/html

echo "[edigital] Configuration page d'accueil statique ..."
HOME_ID=$(wp post list --post_type=page --name=accueil --field=ID --path=/var/www/html | head -n1)
BLOG_ID=$(wp post list --post_type=page --name=blog --field=ID --path=/var/www/html | head -n1)
if [ -n "$HOME_ID" ]; then
  wp option update show_on_front page --path=/var/www/html
  wp option update page_on_front "$HOME_ID" --path=/var/www/html
fi
if [ -n "$BLOG_ID" ]; then
  wp option update page_for_posts "$BLOG_ID" --path=/var/www/html
fi

echo "[edigital] Assignation du menu principal ..."
MENU_ID=$(wp menu list --fields=term_id,slug --format=csv --path=/var/www/html | awk -F, '$2=="edigital-primary"{print $1}' | head -n1)
if [ -n "$MENU_ID" ]; then
  wp menu location assign "$MENU_ID" primary --path=/var/www/html || true
fi

echo "[edigital] Initialisation terminée."
echo "[edigital] → Site   : ${WP_URL:-http://localhost:8080}"
echo "[edigital] → Admin  : ${WP_URL:-http://localhost:8080}/wp-admin"
echo "[edigital] → User   : ${WP_ADMIN_USER:-admin} / ${WP_ADMIN_PASSWORD:-admin}"
