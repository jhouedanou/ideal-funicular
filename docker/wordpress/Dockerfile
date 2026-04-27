# E-Digital — Image WordPress avec extensions de perf
# - Active OPcache (présent par défaut) + ajoute Redis pour l'object cache.

FROM wordpress:6.7-php8.2-apache

# Installer la lib redis PHP via PECL (pas de paquet apt fiable pour PHP 8.2)
RUN apt-get update \
	&& apt-get install -y --no-install-recommends \
		ca-certificates \
		libssl-dev \
	&& update-ca-certificates \
	&& pecl install redis \
	&& docker-php-ext-enable redis \
	&& apt-get clean \
	&& rm -rf /var/lib/apt/lists/*

# Activer mod_expires + mod_headers pour le cache HTTP statique
RUN a2enmod expires headers rewrite
