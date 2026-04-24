<?php
/**
 * Template Name: Elementor Full Width
 * Template Post Type: page, post, projet
 *
 * Pleine largeur : header + footer du thème E-Digital conservés, zone de
 * contenu 100% gérée par Elementor (sans container ni sidebar). C'est le
 * template par défaut recommandé pour créer de nouvelles pages avec Elementor
 * tout en gardant la charte du site.
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>
<main id="content" class="ms-page-content edigital-elementor-fullwidth" role="main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
	endif;
	?>
</main>
<?php
get_footer();
