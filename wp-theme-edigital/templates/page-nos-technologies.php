<?php
/**
 * Template Name: E-Digital — Nos Technologies
 *
 * Migré vers les blocs Gutenberg (Phase 4 du plan de migration).
 * L'intégralité du contenu (hero + grille technos) est éditée via
 * les blocs `edigital/*` (`service-hero`, `technos-grid`, etc.).
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
