<?php
/**
 * Template 404.
 *
 * @package EDigital
 */

get_header(); ?>

<section class="ms-404 container py-5 text-center edigital-hero">
	<h1>404</h1>
	<p><?php esc_html_e( "La page que vous cherchez n'existe pas ou a été déplacée.", 'edigital' ); ?></p>
	<p><a class="ms-btn ms-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( "Retour à l'accueil", 'edigital' ); ?></a></p>
</section>

<?php get_footer();
