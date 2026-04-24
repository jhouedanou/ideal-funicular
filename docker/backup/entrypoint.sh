#!/bin/sh
# Entrypoint du conteneur backup.
# Usage :
#   dump                → un dump unique, puis termine
#   restore [fichier]   → restauration, puis termine
#   list                → liste les dumps disponibles
#   schedule            → boucle infinie, dump toutes les $BACKUP_INTERVAL secondes
#   (vide)              → schedule par défaut
set -eu

CMD="${1:-schedule}"

case "$CMD" in
  dump)
    exec /usr/local/bin/backup.sh
    ;;
  restore)
    shift || true
    exec /usr/local/bin/restore.sh "${1:-}"
    ;;
  list)
    ls -lh "${BACKUP_DIR:-/backups}"/edigital-*.sql.gz 2>/dev/null || echo "(aucun dump)"
    ;;
  schedule)
    : "${BACKUP_INTERVAL:=86400}" # 24h par défaut
    echo "[backup-daemon] Intervalle : ${BACKUP_INTERVAL}s"
    while true; do
      /usr/local/bin/backup.sh || echo "[backup-daemon] Échec — nouvel essai au prochain cycle."
      sleep "$BACKUP_INTERVAL"
    done
    ;;
  *)
    echo "Commande inconnue : $CMD" >&2
    echo "Usage : dump | restore [fichier] | list | schedule" >&2
    exit 2
    ;;
esac
