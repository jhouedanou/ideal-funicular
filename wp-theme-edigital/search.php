<?php
/**
 * Résultats de recherche.
 *
 * @package EDigital
 */

get_header(); ?>

<section class="ms-search container py-5">
	<header class="page-header edigital-hero">
		<h1 class="page-title">
			<?php
			/* translators: %s: search terms */
			printf( esc_html__( 'Résultats de recherche pour : %s', 'edigital' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
			?>
		</h1>
	</header>
	<?php if ( have_posts() ) : ?>
		<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'col-md-6 col-lg-4 mb-4' ); ?>>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="post-excerpt"><?php the_excerpt(); ?></div>
				</article>
			<?php endwhile; ?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Aucun résultat. Essayez avec d\'autres mots-clés.', 'edigital' ); ?></p>
		<?php get_search_form(); ?>
	<?php endif; ?>
</section>

<?php get_footer();
