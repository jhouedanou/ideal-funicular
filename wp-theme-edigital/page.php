<?php
/**
 * Template des pages statiques (éditables via Gutenberg).
 *
 * @package EDigital
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'edigital-page' ); ?>>
		<div class="edigital-gutenberg-content container py-5">
			<?php edigital_breadcrumb(); ?>
			<?php the_content(); ?>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages :', 'edigital' ),
				'after'  => '</div>',
			) );
			?>
		</div>
	</article>
	<?php
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>
<?php endwhile; ?>

<?php get_footer();
