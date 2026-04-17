<?php
/**
 * Archives (catégories, étiquettes, auteurs).
 *
 * @package EDigital
 */

get_header(); ?>

<section class="ms-archive container py-5">
	<header class="page-header edigital-hero">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'col-md-6 col-lg-4 mb-4' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a>
					<?php endif; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="post-excerpt"><?php the_excerpt(); ?></div>
				</article>
			<?php endwhile; ?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Aucun article trouvé.', 'edigital' ); ?></p>
	<?php endif; ?>
</section>

<?php get_footer();
