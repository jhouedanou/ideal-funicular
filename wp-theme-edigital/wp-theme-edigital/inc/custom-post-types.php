<?php
/**
 * Déclaration centralisée des Custom Post Types du thème E-Digital.
 *
 * CPT enregistrés :
 *   - `slide`      : slider hero de la page d'accueil (privé, pas d'archive).
 *   - `projet`     : portfolio public, archive sur /nos-projets/.
 *   - `actualite`  : actualités / blog secondaire, archive sur /actualites/.
 *
 * Les taxonomies associées sont également déclarées ici :
 *   - `expertise`  : applique aux projets pour le filtrage Homepage → archive.
 *   - `actualite_categorie` : catégories propres aux actualités.
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CPT Slide — slider hero d'accueil.
 */
function edigital_register_cpt_slide() {
	$labels = array(
		'name'          => _x( 'Slides', 'Post Type General Name', 'edigital' ),
		'singular_name' => _x( 'Slide', 'Post Type Singular Name', 'edigital' ),
		'menu_name'     => __( 'Slider Hero', 'edigital' ),
		'all_items'     => __( 'Toutes les slides', 'edigital' ),
		'add_new_item'  => __( 'Ajouter une slide', 'edigital' ),
		'add_new'       => __( 'Ajouter', 'edigital' ),
		'edit_item'     => __( 'Modifier la slide', 'edigital' ),
		'update_item'   => __( 'Mettre à jour la slide', 'edigital' ),
	);

	register_post_type( 'slide', array(
		'label'               => __( 'Slide', 'edigital' ),
		'description'         => __( 'Slides du slider hero de la page d\'accueil', 'edigital' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'page-attributes' ),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-images-alt2',
		'has_archive'         => false,
		'publicly_queryable'  => false,
		'capability_type'     => 'post',
	) );
}
add_action( 'init', 'edigital_register_cpt_slide', 0 );

/**
 * CPT Projet — portfolio.
 */
function edigital_register_cpt_projet() {
	$labels = array(
		'name'          => _x( 'Projets', 'Post Type General Name', 'edigital' ),
		'singular_name' => _x( 'Projet', 'Post Type Singular Name', 'edigital' ),
		'menu_name'     => __( 'Projets', 'edigital' ),
		'all_items'     => __( 'Tous les projets', 'edigital' ),
		'add_new_item'  => __( 'Ajouter un projet', 'edigital' ),
		'add_new'       => __( 'Ajouter', 'edigital' ),
		'edit_item'     => __( 'Modifier le projet', 'edigital' ),
		'update_item'   => __( 'Mettre à jour le projet', 'edigital' ),
		'view_item'     => __( 'Voir le projet', 'edigital' ),
		'search_items'  => __( 'Rechercher un projet', 'edigital' ),
	);

	register_post_type( 'projet', array(
		'label'              => __( 'Projet', 'edigital' ),
		'description'        => __( 'Portfolio des projets E-Digital', 'edigital' ),
		'labels'             => $labels,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'public'             => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-portfolio',
		'has_archive'        => 'nos-projets',
		'rewrite'            => array( 'slug' => 'projet' ),
		'show_in_rest'       => true,
	) );
}
add_action( 'init', 'edigital_register_cpt_projet', 0 );

/**
 * CPT Actualité — section actualités / blog secondaire.
 */
function edigital_register_cpt_actualite() {
	$labels = array(
		'name'          => _x( 'Actualités', 'Post Type General Name', 'edigital' ),
		'singular_name' => _x( 'Actualité', 'Post Type Singular Name', 'edigital' ),
		'menu_name'     => __( 'Actualités', 'edigital' ),
		'all_items'     => __( 'Toutes les actualités', 'edigital' ),
		'add_new_item'  => __( 'Ajouter une actualité', 'edigital' ),
		'add_new'       => __( 'Ajouter', 'edigital' ),
		'edit_item'     => __( 'Modifier l\'actualité', 'edigital' ),
		'update_item'   => __( 'Mettre à jour l\'actualité', 'edigital' ),
		'view_item'     => __( 'Voir l\'actualité', 'edigital' ),
	);

	register_post_type( 'actualite', array(
		'label'         => __( 'Actualité', 'edigital' ),
		'description'   => __( 'Actualités E-Digital', 'edigital' ),
		'labels'        => $labels,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
		'public'        => true,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_position' => 7,
		'menu_icon'     => 'dashicons-megaphone',
		'has_archive'   => 'actualites',
		'rewrite'       => array( 'slug' => 'actualite' ),
		'show_in_rest'  => true,
	) );
}
add_action( 'init', 'edigital_register_cpt_actualite', 0 );

/**
 * Taxonomie « Expertise » — appliquée aux projets pour le filtrage Homepage.
 */
function edigital_register_tax_expertise() {
	register_taxonomy( 'expertise', array( 'projet' ), array(
		'label'             => __( 'Expertises', 'edigital' ),
		'labels'            => array(
			'name'          => __( 'Expertises', 'edigital' ),
			'singular_name' => __( 'Expertise', 'edigital' ),
			'all_items'     => __( 'Toutes les expertises', 'edigital' ),
			'add_new_item'  => __( 'Ajouter une expertise', 'edigital' ),
			'edit_item'     => __( 'Modifier l\'expertise', 'edigital' ),
		),
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'expertise' ),
	) );
}
add_action( 'init', 'edigital_register_tax_expertise', 0 );

/**
 * Taxonomie « Catégorie d'actualité ».
 */
function edigital_register_tax_actualite_categorie() {
	register_taxonomy( 'actualite_categorie', array( 'actualite' ), array(
		'label'             => __( 'Catégories d\'actualité', 'edigital' ),
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'categorie-actualite' ),
	) );
}
add_action( 'init', 'edigital_register_tax_actualite_categorie', 0 );
