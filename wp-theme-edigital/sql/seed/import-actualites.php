<?php
/**
 * Script d'import des actualités du template HTML vers le CPT « actualite ».
 *
 * Usage : wp eval-file import-actualites.php
 *
 * Importe 6 articles couvrant les besoins des deux grilles d'actualités
 * de la maquette (3+4 / 4+2 colonnes selon variante du bloc).
 *
 * Idempotent : ne crée pas de doublon si l'actualité existe déjà.
 */

defined( 'ABSPATH' ) || exit;

$articles = array(
	array(
		'title'      => "Développement d'applications mobiles à Paris et Guyancourt",
		'date'       => '2024-07-04',
		'image_file' => 'blog-mobile-dev.png',
		'category'   => 'Technologie',
		'content'    => "Découvrez notre savoir-faire en développement d'applications mobiles natives iOS & Android, au service des TPE et PME d'Île-de-France.",
	),
	array(
		'title'      => 'Agence Marketing des Médias Sociaux',
		'date'       => '2026-01-27',
		'image_file' => 'blog-smma.png',
		'category'   => 'Stratégie',
		'content'    => 'Faites des réseaux sociaux un levier de croissance : création de contenu, publicité (media buying) et community management.',
	),
	array(
		'title'      => 'Création de Site Internet à Guyancourt : Donnez Vie à Vos Idées',
		'date'       => '2026-01-07',
		'image_file' => 'blog-web-creation.png',
		'category'   => 'Design',
		'content'    => "Sites modernes, réactifs et optimisés pour le SEO — donnons vie à votre projet web avec une équipe dédiée à Guyancourt et Paris.",
	),
	array(
		'title'      => 'Création Application Spécifique',
		'date'       => '2025-03-03',
		'image_file' => 'blog-software.png',
		'category'   => 'Développement',
		'content'    => "Applications métier sur mesure pour optimiser vos processus internes : CRM, ERP, PrestaShop, et solutions ad hoc.",
	),
	array(
		'title'      => 'Solutions E-commerce & Prestashop pour TPE/PME',
		'date'       => '2025-09-15',
		'image_file' => 'blog-ecommerce.png',
		'category'   => 'E-commerce',
		'content'    => "Boutiques en ligne sur mesure : paiement sécurisé, gestion des stocks, intégration PrestaShop / WooCommerce.",
	),
	array(
		'title'      => 'Accompagnement Stratégique pour la Croissance Digitale',
		'date'       => '2025-11-10',
		'image_file' => 'blog-strategy.png',
		'category'   => 'Stratégie',
		'content'    => "Une équipe dédiée de 8 collaborateurs vous accompagne de A à Z pour transformer votre stratégie digitale en croissance mesurable.",
	),
);

// Dossier des images (relative au thème actif).
$theme_dir  = get_template_directory();
$assets_dir = $theme_dir . '/assets/images/portfolio/';

foreach ( $articles as $idx => $art ) {

	// Éviter les doublons.
	$existing = get_posts( array(
		'post_type'   => 'actualite',
		'title'       => $art['title'],
		'post_status' => 'any',
		'numberposts' => 1,
	) );
	if ( $existing ) {
		WP_CLI::log( "⏭  Actualité déjà existante : {$art['title']}" );
		continue;
	}

	$post_id = wp_insert_post( array(
		'post_type'    => 'actualite',
		'post_title'   => $art['title'],
		'post_content' => $art['content'],
		'post_status'  => 'publish',
		'post_date'    => $art['date'] . ' 09:00:00',
	) );

	if ( is_wp_error( $post_id ) ) {
		WP_CLI::warning( "Erreur création actualité : " . $post_id->get_error_message() );
		continue;
	}

	// Catégorie (taxonomie « actualite_categorie »).
	if ( ! empty( $art['category'] ) && taxonomy_exists( 'actualite_categorie' ) ) {
		wp_set_object_terms( $post_id, $art['category'], 'actualite_categorie', false );
	}

	// Image mise en avant.
	$filename   = $art['image_file'];
	$attachment = get_posts( array(
		'post_type'   => 'attachment',
		'post_status' => 'inherit',
		'meta_query'  => array( array(
			'key'     => '_wp_attached_file',
			'value'   => $filename,
			'compare' => 'LIKE',
		) ),
		'numberposts' => 1,
	) );

	if ( $attachment ) {
		$att_id = $attachment[0]->ID;
		WP_CLI::log( "  Image trouvée en médiathèque : $filename (ID $att_id)" );
	} else {
		$local_path = $assets_dir . $filename;
		if ( file_exists( $local_path ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/image.php';
			require_once ABSPATH . 'wp-admin/includes/media.php';

			$att_id = media_handle_sideload( array(
				'name'     => $filename,
				'tmp_name' => $local_path,
			), $post_id );

			if ( is_wp_error( $att_id ) ) {
				WP_CLI::warning( "  Impossible d'importer $filename : " . $att_id->get_error_message() );
				$att_id = 0;
			} else {
				WP_CLI::log( "  Image importée : $filename (ID $att_id)" );
			}
		} else {
			WP_CLI::warning( "  Fichier image introuvable : $local_path" );
			$att_id = 0;
		}
	}

	if ( $att_id ) {
		set_post_thumbnail( $post_id, $att_id );
	}

	WP_CLI::success( "✓ Actualité créée : {$art['title']} (ID $post_id)" );
}

WP_CLI::success( 'Import des actualités terminé.' );
