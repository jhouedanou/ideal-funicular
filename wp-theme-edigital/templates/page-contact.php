<?php
/**
 * Template Name: E-Digital — Contact
 *
 * Migré vers les blocs Gutenberg (Phase 3 du plan de migration).
 * Le hero + les infos + adresses sont édités via les blocs `edigital/*`
 * (service-hero, contact-info, office-card). Le formulaire de devis
 * reste géré par le shortcode `[edigital_devis]` (à insérer via le bloc
 * Shortcode dans la page).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>
<main class="ms-main">
	<div class="ms-page-content">
		<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
		?>
	</div>
</main>
<?php
get_footer();
