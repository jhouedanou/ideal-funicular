<?php
/**
 * Script d'import des projets du template HTML vers le CPT « projet ».
 *
 * Usage : wp eval-file import-projets.php
 *
 * - Crée/met à jour 10 projets depuis nos-projets.html.
 * - Injecte le contenu détaillé de projet.html pour « Logic Design Solutions ».
 * - Injecte un contenu Lorem Ipsum pour les autres projets.
 * - Assigne image mise en avant + taxonomie « expertise » (design / developpement / portfolio).
 *
 * Idempotent : relançable sans doublons.
 */

defined( 'ABSPATH' ) || exit;

$lorem_content = <<<HTML
<!-- wp:heading {"level":3} -->
<h3>Le Contexte du Projet</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Notre Approche &amp; Solution</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<!-- /wp:paragraph -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p></blockquote>
<!-- /wp:quote -->

<!-- wp:heading {"level":3} -->
<h3>Le Résultat</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
<!-- /wp:paragraph -->
HTML;

$logic_design_content = <<<HTML
<!-- wp:heading {"level":3} -->
<h3>Le Contexte du Projet</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Logic Design Solutions, acteur majeur dans l'ingénierie des systèmes électroniques et embarqués, nous a sollicités pour réaliser une refonte complète de leur infrastructure digitale. Leur site vieillissant ne reflétait plus leur expertise de pointe ni leurs ambitions internationales.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3>Notre Approche &amp; Solution</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Nous avons opté pour une approche centrée sur la performance et l'expérience utilisateur (UX). Le défi consistait à présenter des concepts techniques ardus sous un format digeste, moderne et visuellement attrayant pour leurs potentiels clients (B2B).</p>
<!-- /wp:paragraph -->

<!-- wp:list -->
<ul>
<li><strong>Architecture :</strong> Refonte de la hiérarchie de l'information pour une navigation intuitive.</li>
<li><strong>Design UI :</strong> Utilisation de codes couleurs tech (bleu profond, blanc) avec des micro-animations discrètes.</li>
<li><strong>Performance :</strong> Optimisation drastique des temps de chargement pour un SEO de premier plan.</li>
</ul>
<!-- /wp:list -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><p>Le nouveau site a propulsé notre image de marque et nous permet d'acquérir de manière fluide des leads hautement qualifiés. L'équipe E-digital a su traduire la complexité de nos métiers en une interface claire.</p></blockquote>
<!-- /wp:quote -->

<!-- wp:heading {"level":3} -->
<h3>Le Résultat</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Une augmentation de <strong>+40% de trafic organique</strong> dès le premier trimestre suivant le lancement et un taux de rebond divisé par deux. La plateforme est devenue un atout commercial majeur pour l'équipe de LDSolutions.</p>
<!-- /wp:paragraph -->
HTML;

$projects = array(
	array(
		'title'      => 'Logic Design Solutions',
		'sous_titre' => 'Développement',
		'image_file' => 'LDSolutions.png',
		'content'    => $logic_design_content,
		'client'     => 'Logic Design Solutions',
		'categorie'  => 'Développement, UX/UI Design',
		'tech'       => 'WordPress, React, CSS3',
		'date'       => 'Janvier 2024',
		'lien_live'  => 'https://e-digital.fr/creation-site-internet/refonte-de-site-internet-pour-lingenierie-en-systemes-electroniques-et-embarques/',
	),
	array(
		'title'      => 'Quitus Immobilier',
		'sous_titre' => 'Design | Développement',
		'image_file' => 'Design-sans-titre-2-e1732180073249.jpg',
		'content'    => $lorem_content,
	),
	array(
		'title'      => 'Pouret Medical',
		'sous_titre' => 'Design | Développement',
		'image_file' => 'Design-sans-titre-3-e1732180334178.jpg',
		'content'    => $lorem_content,
	),
	array(
		'title'      => 'Ruaud Industries',
		'sous_titre' => 'Design | Développement',
		'image_file' => 'Design-sans-titre-4-e1732204171914.jpg',
		'content'    => $lorem_content,
	),
	array(
		'title'      => 'Yvanick conseil',
		'sous_titre' => 'Design | Développement',
		'image_file' => 'Design-yvanik.jpg',
		'content'    => $lorem_content,
	),
	array(
		'title'      => 'Bike service',
		'sous_titre' => 'Design | Développement',
		'image_file' => 'bike-service-developpeur-ulrich-kouame.webp',
		'content'    => $lorem_content,
	),
	array(
		'title'      => 'Dupain',
		'sous_titre' => 'Design | Développement',
		'image_file' => 'Design-dupain.jpg',
		'content'    => $lorem_content,
	),
	array(
		'title'      => 'Fer play',
		'sous_titre' => 'Design | Développement',
		'image_file' => 'Design-sans-titre-5-e1732204755993.jpg',
		'content'    => $lorem_content,
	),
	array(
		'title'      => 'Cabinet FAMCHON',
		'sous_titre' => 'Développement | Portfolio',
		'image_file' => 'cabinet-famchon-developpeur-ulrich-kouame.webp',
		'content'    => $lorem_content,
	),
	array(
		'title'      => 'Maintenance PC Paris',
		'sous_titre' => 'Développement | Portfolio',
		'image_file' => 'maintenance-pc-paris-developpeur-ulrich-kouame.webp',
		'content'    => $lorem_content,
	),
);

require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$theme_dir  = get_template_directory();
$assets_dir = $theme_dir . '/assets/images/portfolio/';

/**
 * Assure l'existence d'un terme expertise et retourne son term_id.
 */
$ensure_expertise_term = static function( $name, $slug ) {
	$term = term_exists( $slug, 'expertise' );
	if ( ! $term ) {
		$term = wp_insert_term( $name, 'expertise', array( 'slug' => $slug ) );
	}
	if ( is_wp_error( $term ) ) {
		return 0;
	}
	if ( is_array( $term ) && isset( $term['term_id'] ) ) {
		return (int) $term['term_id'];
	}
	return is_numeric( $term ) ? (int) $term : 0;
};

$design_term_id        = $ensure_expertise_term( 'Design', 'design' );
$dev_term_id           = $ensure_expertise_term( 'Développement', 'developpement' );
$portfolio_term_id     = $ensure_expertise_term( 'Portfolio', 'portfolio' );

$created = 0;
$updated = 0;

foreach ( $projects as $proj ) {
	$existing = get_posts( array(
		'post_type'   => 'projet',
		'title'       => $proj['title'],
		'post_status' => 'any',
		'numberposts' => 1,
	) );

	$postarr = array(
		'post_type'    => 'projet',
		'post_title'   => $proj['title'],
		'post_content' => $proj['content'],
		'post_excerpt' => $proj['sous_titre'],
		'post_status'  => 'publish',
	);

	if ( $existing ) {
		$postarr['ID'] = (int) $existing[0]->ID;
		$post_id       = wp_update_post( $postarr, true );
		$updated++;
		WP_CLI::log( sprintf( '↻ Projet mis à jour : %s', $proj['title'] ) );
	} else {
		$post_id = wp_insert_post( $postarr, true );
		$created++;
		WP_CLI::log( sprintf( '✓ Projet créé : %s', $proj['title'] ) );
	}

	if ( is_wp_error( $post_id ) ) {
		WP_CLI::warning( '  Erreur création/màj projet : ' . $post_id->get_error_message() );
		continue;
	}

	// Meta éditables dans l'admin (ACF ou post meta fallback).
	update_post_meta( $post_id, 'sous_titre', $proj['sous_titre'] );
	update_post_meta( $post_id, 'client_nom', isset( $proj['client'] ) ? $proj['client'] : $proj['title'] );
	update_post_meta( $post_id, 'projet_categorie', isset( $proj['categorie'] ) ? $proj['categorie'] : str_replace( ' | ', ', ', $proj['sous_titre'] ) );
	update_post_meta( $post_id, 'projet_technologies', isset( $proj['tech'] ) ? $proj['tech'] : 'WordPress, CSS3, JavaScript' );
	update_post_meta( $post_id, 'projet_date', isset( $proj['date'] ) ? $proj['date'] : '2024' );
	update_post_meta( $post_id, 'projet_lien_live', isset( $proj['lien_live'] ) ? $proj['lien_live'] : '' );

	// Taxonomie expertise (sert au filtre sur /nos-projets/ + projets liés).
	$term_ids = array();
	if ( false !== stripos( $proj['sous_titre'], 'Design' ) && $design_term_id ) {
		$term_ids[] = $design_term_id;
	}
	if ( false !== stripos( $proj['sous_titre'], 'Développement' ) && $dev_term_id ) {
		$term_ids[] = $dev_term_id;
	}
	if ( false !== stripos( $proj['sous_titre'], 'Portfolio' ) && $portfolio_term_id ) {
		$term_ids[] = $portfolio_term_id;
	}
	if ( ! empty( $term_ids ) ) {
		wp_set_post_terms( $post_id, array_unique( $term_ids ), 'expertise', false );
	}

	// Image mise en avant : réutilise la médiathèque si déjà importée.
	$filename   = $proj['image_file'];
	$attachment = get_posts( array(
		'post_type'   => 'attachment',
		'post_status' => 'inherit',
		'meta_query'  => array(
			array(
				'key'     => '_wp_attached_file',
				'value'   => $filename,
				'compare' => 'LIKE',
			),
		),
		'numberposts' => 1,
	) );

	if ( $attachment ) {
		$att_id = (int) $attachment[0]->ID;
	} else {
		$local_path = $assets_dir . $filename;
		if ( file_exists( $local_path ) ) {
			$tmp_copy = wp_tempnam( $filename );
			if ( $tmp_copy && @copy( $local_path, $tmp_copy ) ) {
				$att_id = media_handle_sideload( array(
					'name'     => $filename,
					'tmp_name' => $tmp_copy,
				), $post_id );
				if ( is_wp_error( $att_id ) ) {
					@unlink( $tmp_copy );
					WP_CLI::warning( "  Image non importée pour {$proj['title']} : " . $att_id->get_error_message() );
					$att_id = 0;
				}
			} else {
				$att_id = 0;
				WP_CLI::warning( "  Impossible de préparer l'image {$filename}" );
			}
		} else {
			$att_id = 0;
			WP_CLI::warning( "  Fichier image introuvable : {$local_path}" );
		}
	}

	if ( ! empty( $att_id ) ) {
		set_post_thumbnail( $post_id, (int) $att_id );
	}
}

WP_CLI::success( sprintf( 'Import projets terminé : %d créés, %d mis à jour.', $created, $updated ) );
