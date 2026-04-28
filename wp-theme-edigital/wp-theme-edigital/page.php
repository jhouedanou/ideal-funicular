<?php
/**
 * Template des pages — Option A fidélité maximale.
 *
 * WordPress applique déjà _wp_page_template via son filtre template_include
 * AVANT d'arriver ici. Ce fichier sert donc de fallback ultime (pages sans
 * template assigné). Pour les pages E-Digital qui ont un template statique
 * dans templates/, WordPress les charge directement — page.php n'est pas
 * invoqué pour elles.
 *
 * Si malgré tout ce fichier est appelé pour une page qui a un template
 * statique assigné (edge-case : cache, multisite…), on délègue explicitement.
 *
 * @package EDigital
 */

if ( have_posts() ) {
	the_post();
	$tpl = get_post_meta( get_the_ID(), '_wp_page_template', true );

	if ( $tpl && 'default' !== $tpl ) {
		$tpl_path = locate_template( $tpl );
		if ( $tpl_path ) {
			load_template( $tpl_path, false );
			return;
		}
	}
}

// Fallback : page sans template statique → rendu Gutenberg minimal.
get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'edigital-page' ); ?>>
	<div class="edigital-gutenberg-content container py-5">
		<?php edigital_breadcrumb(); ?>
		<?php the_content(); ?>
	</div>
</article>
<?php endwhile; endif; ?>

<?php get_footer();
