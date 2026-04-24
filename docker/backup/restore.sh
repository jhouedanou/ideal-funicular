#!/bin/sh
# Restauration d'un dump vers la base MariaDB.
# Usage :
#   restore.sh                      → restaure le dump le plus récent
#   restore.sh edigital-XXX.sql.gz  → restaure un dump spécifique
set -eu

: "${DB_HOST:=db}"
: "${DB_NAME:=edigital}"
: "${DB_USER:=root}"
: "${DB_PASSWORD:=rootpass}"
: "${BACKUP_DIR:=/backups}"

if [ $# -ge 1 ] && [ -n "$1" ]; then
  CANDIDATE="$1"
  case "$CANDIDATE" in
    /*) FILE="$CANDIDATE" ;;
    *)  FILE="$BACKUP_DIR/$CANDIDATE" ;;
  esac
else
  FILE=$(ls -1t "$BACKUP_DIR"/edigital-*.sql.gz 2>/dev/null | head -n1 || true)
fi

if [ -z "${FILE:-}" ] || [ ! -f "$FILE" ]; then
  echo "[restore] Aucun dump trouvé." >&2
  echo "[restore] Dumps disponibles :" >&2
  ls -1 "$BACKUP_DIR"/edigital-*.sql.gz 2>/dev/null >&2 || echo "  (aucun)" >&2
  exit 1
fi

echo "[restore] Source : $FILE"
echo "[restore] Cible  : $DB_NAME@$DB_HOST"
echo "[restore] ATTENTION : la base $DB_NAME sera écrasée."

# Décompression streaming -> mariadb. Le dump contient CREATE DATABASE + USE.
gunzip -c "$FILE" | mariadb \
  --host="$DB_HOST" \
  --user="$DB_USER" \
  --password="$DB_PASSWORD" \
  --default-character-set=utf8mb4

echo "[restore] OK — base restaurée depuis $FILE"
