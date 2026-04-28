<?php
/**
 * Filtre Expertise — connecte la Homepage à l'archive des projets.
 *
 * Sur la Homepage, chaque carte Expertise pointe vers l'archive des projets
 * avec un paramètre `?expertise=<slug>`. Ici on intercepte la requête sur
 * l'archive `projet` et on injecte un `tax_query` correspondant.
 *
 * Helper de rendu : `edigital_expertise_link( 'creation-web' )` retourne
 * l'URL d'archive avec le bon paramètre.
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filtre la requête principale sur l'archive `projet`.
 */
function edigital_expertise_filter_archive( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	if ( ! $query->is_post_type_archive( 'projet' ) ) {
		return;
	}

	$slug = isset( $_GET['expertise'] ) ? sanitize_title( wp_unslash( $_GET['expertise'] ) ) : '';
	if ( ! $slug ) {
		return;
	}

	$tax_query = $query->get( 'tax_query' ) ?: array();
	$tax_query[] = array(
		'taxonomy' => 'expertise',
		'field'    => 'slug',
		'terms'    => $slug,
	);
	$query->set( 'tax_query', $tax_query );
}
add_action( 'pre_get_posts', 'edigital_expertise_filter_archive' );

/**
 * Retourne l'URL de l'archive Projets filtrée sur une expertise donnée.
 *
 * @param string $slug Slug de l'expertise.
 * @return string
 */
function edigital_expertise_link( $slug ) {
	$base = get_post_type_archive_link( 'projet' );
	if ( ! $base ) {
		return '#';
	}
	return add_query_arg( 'expertise', sanitize_title( $slug ), $base );
}

/**
 * Helper : retourne le slug de l'expertise actuellement filtrée (ou '').
 */
function edigital_current_expertise() {
	return isset( $_GET['expertise'] ) ? sanitize_title( wp_unslash( $_GET['expertise'] ) ) : '';
}
