<?php
/**
 * Template Name: E-Digital — Applications Mobiles Natives
 *
 * Migré vers les blocs Gutenberg (Phase 2 du plan de migration).
 * Tout le contenu éditorial (hero, intro, grille de cartes, CTA…) est
 * maintenant édité via les blocs `edigital/service-*` dans WP Admin.
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

		<?php get_template_part( "template-parts/newsletter-section" ); ?>
	</div>
</main>
<?php
get_footer();
