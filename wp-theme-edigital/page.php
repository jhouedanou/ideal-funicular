<?php
/**
 * Template des pages — Option A fidélité maximale.
 *
 * Routage automatique : si la page courante a un template statique
 * `templates/page-{slug}.php`, on y délègue. Sinon, fallback Gutenberg
 * minimal (the_content()).
 *
 * NB : front-page.php et home.php sont déjà câblés explicitement (vers
 * templates/page-accueil.php et templates/page-blog.php), donc ce
 * routage couvre toutes les autres pages (services, contact, etc.).
 *
 * @package EDigital
 */

if ( have_posts() ) {
	the_post();
	rewind_posts();

	$slug = get_post_field( 'post_name', get_the_ID() );
	if ( $slug ) {
		$candidate = "templates/page-{$slug}";
		if ( locate_template( $candidate . '.php' ) ) {
			get_template_part( $candidate );
			return;
		}
	}

	// Compat : on respecte aussi un `_wp_page_template` explicite si la
	// valeur pointe sur un fichier différent de page.php (sinon récursion).
	$tpl = get_post_meta( get_the_ID(), '_wp_page_template', true );
	if ( $tpl && 'default' !== $tpl && 'page.php' !== $tpl ) {
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
