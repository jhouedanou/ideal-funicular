<?php
/**
 * Enregistrement des blocs Gutenberg natifs du thème E-Digital.
 *
 * Les sources vivent dans /src/{nom}/ et sont compilées par wp-scripts
 * dans /build/{nom}/ (block.json + index.js + index.asset.php + render.php copié).
 * Le rendu est piloté côté serveur via render_callback ; aucun markup HTML
 * n'est dupliqué entre l'éditeur et le front.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Catégorie dédiée pour regrouper les blocs E-Digital dans l'inserter.
 */
add_filter( 'block_categories_all', function ( $categories ) {
	$exists = false;
	foreach ( $categories as $cat ) {
		if ( isset( $cat['slug'] ) && 'edigital' === $cat['slug'] ) {
			$exists = true;
			break;
		}
	}
	if ( $exists ) {
		return $categories;
	}
	return array_merge(
		array(
			array(
				'slug'  => 'edigital',
				'title' => __( 'E-Digital', 'edigital' ),
				'icon'  => null,
			),
		),
		$categories
	);
}, 10, 1 );

/**
 * Enregistre tous les blocs présents dans /build/.
 */
add_action( 'init', function () {
	$build_dir = get_template_directory() . '/build';

	if ( ! is_dir( $build_dir ) ) {
		return;
	}

	$dirs = glob( $build_dir . '/*', GLOB_ONLYDIR );
	if ( empty( $dirs ) ) {
		return;
	}

	foreach ( $dirs as $dir ) {
		if ( file_exists( $dir . '/block.json' ) ) {
			register_block_type( $dir );
		}
	}
} );
