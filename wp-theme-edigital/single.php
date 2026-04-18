<?php
/**
 * Template des articles de blog.
 *
 * @package EDigital
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'edigital-single-post container py-5' ); ?>>
		<header class="post-header edigital-hero">
			<?php edigital_breadcrumb(); ?>
			<h1 class="post-title"><?php the_title(); ?></h1>
			<div class="post-header--meta">
				<span class="post-header--author"><?php the_author(); ?></span>
				<span class="post-header--date"><?php echo esc_html( get_the_date() ); ?></span>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-featured"><?php the_post_thumbnail( 'full' ); ?></div>
		<?php endif; ?>

		<div class="post-content edigital-gutenberg-content">
			<?php the_content(); ?>
		</div>

		<footer class="post-footer">
			<?php the_tags( '<div class="post-tags">', ', ', '</div>' ); ?>
		</footer>
	</article>

	<?php if ( comments_open() || get_comments_number() ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>
<?php endwhile; ?>

<?php get_footer();
