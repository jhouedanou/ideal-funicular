<?php
/**
 * Template Name: E-Digital — Nos Projets
 *
 * Migré vers les blocs Gutenberg (Phase 4 du plan de migration).
 * Le hero + intro + filtres + grille des projets sont rendus par
 * les blocs Gutenberg `edigital/service-hero`, `edigital/projets-intro`
 * (qui intègre maintenant la WP_Query grille) et `edigital/text-ticker`.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

// Sur l'archive du CPT `projet` (slug /nos-projets/), have_posts() boucle
// sur les projets — pas sur la page WP. On charge donc explicitement la
// page « nos-projets » pour exposer son contenu Gutenberg.
$nos_projets_page = get_page_by_path( 'nos-projets' );
?>
<main class="ms-main">
	<div class="ms-page-content">
		<?php if ( $nos_projets_page ) : ?>
			<?php echo apply_filters( 'the_content', $nos_projets_page->post_content ); ?>
		<?php else : ?>
			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/newsletter-section' ); ?>
	</div>
</main>
<?php
get_footer();
