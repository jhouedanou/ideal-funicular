<?php
/**
 * Fallback de template principal.
 *
 * @package EDigital
 */

get_header(); ?>

<section class="ms-page-wrapper container py-5">
	<?php if ( have_posts() ) : ?>
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header class="page-header edigital-hero">
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			</header>
		<?php endif; ?>

		<div class="edigital-posts-list row">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-md-6 col-lg-4 mb-4' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" class="post-thumb"><?php the_post_thumbnail( 'large' ); ?></a>
					<?php endif; ?>
					<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="post-excerpt"><?php the_excerpt(); ?></div>
					<a href="<?php the_permalink(); ?>" class="ms-btn ms-btn--link"><?php esc_html_e( 'Lire la suite', 'edigital' ); ?></a>
				</article>
			<?php endwhile; ?>
		</div>

		<?php the_posts_pagination(); ?>

	<?php else : ?>
		<p><?php esc_html_e( 'Aucun contenu trouvé.', 'edigital' ); ?></p>
	<?php endif; ?>
</section>

<?php get_footer();
