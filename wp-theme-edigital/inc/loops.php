<?php
/**
 * Boucles WP_Query réutilisables : actualités, projets liés.
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Boucle « Actualités » à afficher sur la Homepage.
 *
 * @param int $limit Nombre d'actualités à afficher.
 */
function edigital_render_actualites_loop( $limit = 3 ) {
	$query = new WP_Query( array(
		'post_type'      => 'actualite',
		'posts_per_page' => max( 1, (int) $limit ),
		'post_status'    => 'publish',
		'no_found_rows'  => true,
	) );

	if ( ! $query->have_posts() ) {
		return;
	}

	echo '<div class="edigital-actualites-grid">';
	while ( $query->have_posts() ) {
		$query->the_post();
		$thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
		?>
		<article class="edigital-actualite-card">
			<a class="edigital-actualite-card__link" href="<?php the_permalink(); ?>">
				<?php if ( $thumb ) : ?>
					<div class="edigital-actualite-card__media" style="background-image:url('<?php echo esc_url( $thumb ); ?>');"></div>
				<?php endif; ?>
				<div class="edigital-actualite-card__body">
					<time class="edigital-actualite-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
						<?php echo esc_html( get_the_date() ); ?>
					</time>
					<h3 class="edigital-actualite-card__title"><?php the_title(); ?></h3>
					<p class="edigital-actualite-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
				</div>
			</a>
		</article>
		<?php
	}
	echo '</div>';
	wp_reset_postdata();
}

/**
 * Boucle « Projets liés » pour le single Projet, par taxonomie expertise.
 *
 * @param int $current_id Post ID à exclure.
 * @param int $limit      Nombre de projets liés.
 */
function edigital_render_projets_lies( $current_id, $limit = 3 ) {
	$terms = wp_get_post_terms( $current_id, 'expertise', array( 'fields' => 'ids' ) );

	$args = array(
		'post_type'      => 'projet',
		'posts_per_page' => max( 1, (int) $limit ),
		'post__not_in'   => array( (int) $current_id ),
		'no_found_rows'  => true,
	);
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$args['tax_query'] = array( array(
			'taxonomy' => 'expertise',
			'field'    => 'term_id',
			'terms'    => $terms,
		) );
	}

	$query = new WP_Query( $args );
	if ( ! $query->have_posts() ) {
		return;
	}

	echo '<div class="edigital-projets-lies-grid">';
	while ( $query->have_posts() ) {
		$query->the_post();
		$thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
		?>
		<a class="edigital-projet-lie" href="<?php the_permalink(); ?>">
			<?php if ( $thumb ) : ?>
				<div class="edigital-projet-lie__media" style="background-image:url('<?php echo esc_url( $thumb ); ?>');"></div>
			<?php endif; ?>
			<h4 class="edigital-projet-lie__title"><?php the_title(); ?></h4>
		</a>
		<?php
	}
	echo '</div>';
	wp_reset_postdata();
}
