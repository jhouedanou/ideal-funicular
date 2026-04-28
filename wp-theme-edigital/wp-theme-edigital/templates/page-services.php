<?php
/**
 * Template Name: E-Digital — Nos Services
 *
 * Migré vers les blocs Gutenberg (Phase 3 du plan de migration).
 * Le hero + la grille de services sont édités via les blocs `edigital/*`
 * dans WP Admin (notamment `edigital/service-hero` + `edigital/services-hub`).
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
