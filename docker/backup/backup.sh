#!/bin/sh
# Dump de la base MariaDB du projet E-Digital vers /backups/.
# Compressé (gzip), horodaté, rotation configurable.
set -eu

: "${DB_HOST:=db}"
: "${DB_NAME:=edigital}"
: "${DB_USER:=root}"
: "${DB_PASSWORD:=rootpass}"
: "${BACKUP_DIR:=/backups}"
: "${BACKUP_KEEP:=14}"

mkdir -p "$BACKUP_DIR"
STAMP=$(date -u +%Y%m%d-%H%M%S)
OUT="$BACKUP_DIR/edigital-${STAMP}.sql.gz"

echo "[backup] Dump $DB_NAME@$DB_HOST -> $OUT"

# --single-transaction : dump cohérent sans locker les tables InnoDB.
# --quick              : streaming, évite de charger la table entière en RAM.
# --routines --events  : inclut procédures stockées + events planifiés.
# --default-character-set=utf8mb4 : préserve l'encodage Gutenberg.
mariadb-dump \
  --host="$DB_HOST" \
  --user="$DB_USER" \
  --password="$DB_PASSWORD" \
  --single-transaction \
  --quick \
  --routines \
  --events \
  --triggers \
  --default-character-set=utf8mb4 \
  --databases "$DB_NAME" \
  | gzip -9 > "$OUT"

SIZE=$(wc -c < "$OUT")
echo "[backup] OK — ${SIZE} octets"

# Rotation : garde les BACKUP_KEEP dumps les plus récents, supprime le reste.
if [ "$BACKUP_KEEP" -gt 0 ]; then
  ls -1t "$BACKUP_DIR"/edigital-*.sql.gz 2>/dev/null \
    | awk -v k="$BACKUP_KEEP" 'NR>k' \
    | while IFS= read -r old; do
        echo "[backup] Rotation — suppression $old"
        rm -f "$old"
      done
fi

echo "[backup] Terminé."
