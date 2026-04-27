<?php
/**
 * Plugin Name: E-Digital — Site Hardening & Performance
 * Description: Désactive les requêtes externes wp.org (mises à jour automatiques)
 *              et ajuste les options runtime pour environnement local/staging Docker.
 *              Élimine les warnings "could not establish a secure connection to WordPress.org"
 *              et "headers already sent".
 * Author: E-Digital
 * Version: 1.0.0
 *
 * Ce fichier doit être placé dans wp-content/mu-plugins/ pour être chargé automatiquement.
 * Aucun activation n'est nécessaire.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* -------------------------------------------------------------------------
 * 1. Empêcher l'affichage des warnings PHP dans la sortie HTML
 *    (cause directe du bug "Cannot modify header information - headers already sent").
 *    On garde le logging dans debug.log via WP_DEBUG_LOG.
 * ------------------------------------------------------------------------- */
@ini_set( 'display_errors', '0' );
@ini_set( 'display_startup_errors', '0' );
@ini_set( 'log_errors', '1' );

/* -------------------------------------------------------------------------
 * 2. Désactiver toutes les mises à jour automatiques + vérifications wp.org
 *    (la cause du warning "could not establish a secure connection to WordPress.org").
 *    En local / Docker, le conteneur n'a pas toujours les CA roots à jour pour TLS.
 * ------------------------------------------------------------------------- */
if ( ! defined( 'AUTOMATIC_UPDATER_DISABLED' ) ) {
	define( 'AUTOMATIC_UPDATER_DISABLED', true );
}
if ( ! defined( 'WP_AUTO_UPDATE_CORE' ) ) {
	define( 'WP_AUTO_UPDATE_CORE', false );
}
if ( ! defined( 'DISALLOW_FILE_MODS' ) ) {
	define( 'DISALLOW_FILE_MODS', true );
}

// Coupe les vérifications périodiques de version (core, plugins, thèmes, traductions).
add_filter( 'pre_site_transient_update_core',    '__return_null', 1 );
add_filter( 'pre_site_transient_update_plugins', '__return_null', 1 );
add_filter( 'pre_site_transient_update_themes',  '__return_null', 1 );
add_filter( 'auto_update_translation',           '__return_false', 1 );
add_filter( 'pre_http_request', function( $pre, $args, $url ) {
	// Bloque tout appel HTTP vers les domaines wp.org (utile en environnement isolé).
	if ( is_string( $url ) && preg_match( '#^https?://(api\.|downloads\.|translate\.)?wordpress\.org/#i', $url ) ) {
		return new WP_Error( 'edigital_blocked_external', 'Requête wp.org bloquée par le mu-plugin E-Digital (environnement local).' );
	}
	return $pre;
}, 10, 3 );

// Décharge les hooks responsables des cron updates.
remove_action( 'init',                'wp_schedule_update_checks' );
remove_action( 'admin_init',          '_maybe_update_core' );
remove_action( 'admin_init',          '_maybe_update_plugins' );
remove_action( 'admin_init',          '_maybe_update_themes' );
remove_action( 'wp_version_check',    'wp_version_check' );
remove_action( 'wp_update_plugins',   'wp_update_plugins' );
remove_action( 'wp_update_themes',    'wp_update_themes' );

/* -------------------------------------------------------------------------
 * 3. Performances : désactiver l'éditeur de fichiers admin et l'API hearbeat
 *    aggressive (réduit drastiquement les requêtes admin-ajax).
 * ------------------------------------------------------------------------- */
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

add_filter( 'heartbeat_settings', function( $settings ) {
	$settings['interval'] = 60; // par défaut 15s, on passe à 60s
	return $settings;
} );

// Désactiver heartbeat sur le frontend.
add_action( 'init', function() {
	if ( ! is_admin() ) {
		wp_deregister_script( 'heartbeat' );
	}
}, 1 );

/* -------------------------------------------------------------------------
 * 4. Object cache Redis (si l'extension PHP redis est dispo).
 *    Pas nécessaire : si le plugin "Redis Object Cache" est installé, il fera
 *    le travail. Sinon ce fichier ne fait rien.
 * ------------------------------------------------------------------------- */

/* -------------------------------------------------------------------------
 * 5. Limites mémoire (override des valeurs par défaut WP).
 * ------------------------------------------------------------------------- */
if ( ! defined( 'WP_MEMORY_LIMIT' ) ) {
	define( 'WP_MEMORY_LIMIT', '512M' );
}
if ( ! defined( 'WP_MAX_MEMORY_LIMIT' ) ) {
	define( 'WP_MAX_MEMORY_LIMIT', '512M' );
}
