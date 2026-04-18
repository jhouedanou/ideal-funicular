<?php
/**
 * Fonctions utilitaires de templating.
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Affiche un fil d'Ariane simple basé sur le contexte courant.
 */
function edigital_breadcrumb() {
	if ( is_front_page() ) {
		return;
	}

	echo '<nav class="edigital-breadcrumb" aria-label="' . esc_attr__( "Fil d'Ariane", 'edigital' ) . '"><ul>';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Accueil', 'edigital' ) . '</a></li>';

	if ( is_singular() ) {
		echo '<li>' . esc_html( get_the_title() ) . '</li>';
	} elseif ( is_home() ) {
		echo '<li>' . esc_html__( 'Blog', 'edigital' ) . '</li>';
	} elseif ( is_archive() ) {
		echo '<li>' . esc_html( get_the_archive_title() ) . '</li>';
	}
	echo '</ul></nav>';
}

/**
 * Fallback de menu primaire si aucun menu n'est assigné.
 */
function edigital_primary_menu_fallback() {
	echo '<ul class="ms-nav__list">';
	$items = array(
		home_url( '/' )                          => __( 'Accueil', 'edigital' ),
		home_url( '/nos-technologies/' )          => __( 'Nos Technologies', 'edigital' ),
		home_url( '/services/' )                  => __( 'Services', 'edigital' ),
		home_url( '/nos-projets/' )               => __( 'Nos Projets', 'edigital' ),
		home_url( '/blog/' )                      => __( 'Blog', 'edigital' ),
		home_url( '/contact/' )                   => __( 'Contact', 'edigital' ),
	);
	foreach ( $items as $url => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}
