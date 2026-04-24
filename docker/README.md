# Installation locale WordPress — E-Digital

Stack Docker pour tester et développer le thème `wp-theme-edigital` en local. WordPress est installé automatiquement au premier démarrage, le thème est activé, et le contenu Gutenberg (`sql/edigital-pages.sql`) est importé sans intervention.

## Services

| Service       | URL                      | Rôle                                       |
|---------------|--------------------------|--------------------------------------------|
| `wordpress`   | http://localhost:8080    | Site public + /wp-admin                    |
| `phpmyadmin`  | http://localhost:8081    | Interface base de données                  |
| `db`          | (interne)                | MariaDB 11                                 |
| `wp-install`  | (tâche ponctuelle)       | Installe WP, active le thème, importe SQL  |

## Identifiants par défaut

- **Admin WP** : `admin` / `admin` — à changer immédiatement pour tout usage non-local.
- **MySQL (app)** : `wpuser` / `wppass`, base `edigital`.
- **MySQL (root)** : `root` / `rootpass`.

Pour modifier ces valeurs, éditez [docker-compose.yml](../docker-compose.yml) avant le premier `up`.

## Démarrage

```bash
docker compose up -d
```

Au premier lancement :

1. `db` se construit et passe le healthcheck.
2. `wordpress` démarre, génère `wp-config.php` et sert Apache sur `:8080`.
3. `wp-install` (WP-CLI) attend la DB, exécute `wp core install`, active le thème **edigital**, importe `edigital-pages.sql`, configure les permaliens + la page d'accueil statique + le menu principal, puis se termine.
4. Un marqueur `.edigital-installed` est déposé dans le volume WP — le script est idempotent.

Suivre l'installation :

```bash
docker compose logs -f wp-install
```

Une fois terminé, le conteneur `wp-install` s'arrête (status `Exited (0)`) — c'est normal.

## Commandes utiles

```bash
# Arrêt (conserve les volumes)
docker compose down

# Reset complet (supprime DB + fichiers WP — perte de données)
docker compose down -v

# Réimport du SQL sans tout détruire
docker compose exec wordpress rm -f /var/www/html/.edigital-installed
docker compose up -d wp-install

# Accès WP-CLI ad-hoc
docker compose run --rm wp-install wp --path=/var/www/html plugin list

# Shell dans le conteneur WordPress
docker compose exec wordpress bash
```

## Développement du thème

Le dossier local [wp-theme-edigital/](../wp-theme-edigital/) est monté en bind-mount sur `/var/www/html/wp-content/themes/edigital`. Toute modification locale (PHP, CSS, JS) est reflétée immédiatement dans le conteneur — pas besoin de rebuild.

Les uploads, plugins tiers et cœur WordPress vivent dans le volume nommé `wp_data` et persistent entre `docker compose down` / `up`.

## Sauvegardes base de données

Un service `backup` dédié (image `edigital-backup`, basée sur `mariadb:11`) gère les dumps. Il est protégé par le profile Compose `backup`, donc **ne démarre pas par défaut** — on l'invoque soit en one-shot, soit en démon planifié.

Les dumps sont écrits dans [docker/backups/](backups/) (bind-mount), compressés gzip, horodatés UTC, et soumis à rotation (conservation des 14 plus récents par défaut).

### Dump ponctuel

```bash
docker compose --profile backup run --rm backup dump
```

Sortie : `docker/backups/edigital-YYYYMMDD-HHMMSS.sql.gz`.

### Lister les dumps disponibles

```bash
docker compose --profile backup run --rm backup list
```

### Restaurer

```bash
# restaure le dump le plus récent
docker compose --profile backup run --rm backup restore

# restaure un dump précis
docker compose --profile backup run --rm backup restore edigital-20260424-171953.sql.gz
```

Attention : la base `edigital` est **écrasée**. Faites un dump avant si vous avez des données locales à conserver.

### Sauvegardes automatiques planifiées

Lancer le démon qui dumpe toutes les 24h :

```bash
docker compose --profile backup up -d backup
docker compose --profile backup logs -f backup
```

Pour changer l'intervalle ou la rétention, éditez dans [docker-compose.yml](../docker-compose.yml) :

| Variable          | Défaut  | Rôle                                              |
|-------------------|---------|---------------------------------------------------|
| `BACKUP_INTERVAL` | `86400` | Secondes entre deux dumps (mode `schedule`).      |
| `BACKUP_KEEP`     | `14`    | Nombre de dumps conservés (rotation auto).        |

Arrêter le démon :

```bash
docker compose --profile backup stop backup
```

### Restauration manuelle (sans passer par le script)

```bash
gunzip -c docker/backups/edigital-XXX.sql.gz \
  | docker compose exec -T db mariadb -uroot -prootpass
```

### Que contient le dump ?

Dump logique complet de la base `edigital` : toutes les tables `wp_*`, procédures, events, triggers. Utilise `--single-transaction` donc **ne lock pas** les tables — sans impact sur un site en lecture pendant l'opération. Les uploads `/wp-content/uploads/` vivent dans le volume `wp_data` et ne sont **pas** inclus dans le dump SQL — voir ci-dessous.

### Sauvegarder aussi les uploads

Le volume `wp_data` contient les fichiers uploadés depuis l'admin. Pour les archiver :

```bash
docker run --rm -v ideal-funicular_wp_data:/data -v "$PWD/docker/backups:/backups" \
  alpine tar czf /backups/wp-uploads-$(date -u +%Y%m%d-%H%M%S).tar.gz -C /data wp-content/uploads
```

## Réimporter seulement le contenu

Si vous modifiez `wp-theme-edigital/sql/edigital-pages.sql` (ou le régénérez via `build-sql.py`) et voulez réappliquer :

```bash
docker compose exec wordpress rm -f /var/www/html/.edigital-installed
docker compose restart wp-install
```

Le SQL est idempotent (DELETE préalable des slugs E-Digital), donc pas de doublons.

## Dépannage

- **Le site tombe en erreur base de données** : attendre que `db` ait terminé son init. `docker compose logs db` doit montrer `ready for connections`.
- **`wp-install` boucle sur "Base indisponible"** : les variables `WORDPRESS_DB_*` doivent être dupliquées sur le service `wp-install` (pas seulement sur `wordpress`), sinon WP-CLI relit `wp-config.php` avec `DB_HOST=mysql` par défaut. Déjà corrigé dans le compose — si vous adaptez, ne les retirez pas.
- **`wp-install` boucle sur l'import** : vérifier que le bind-mount `./wp-theme-edigital` existe et que `sql/edigital-pages.sql` est présent.
- **Port 8080 déjà utilisé** : modifier `ports:` dans `docker-compose.yml` (ex : `"8090:80"`), puis adapter `WP_URL`.
- **Dump échoue avec "access denied"** : vérifiez que `DB_PASSWORD` dans le service `backup` correspond bien au `MARIADB_ROOT_PASSWORD` du service `db`.
