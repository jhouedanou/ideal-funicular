<?php
/**
 * Template de la page d'accueil (front-page).
 *
 * La page d'accueil « Accueil » est créée via le SQL d'import. Son contenu est
 * stocké en blocs Gutenberg et entièrement éditable depuis l'administration.
 *
 * @package EDigital
 */

get_header();

// Si WordPress est configuré avec une page statique comme front-page et que
// cette page existe, on affiche son contenu Gutenberg. Sinon on retombe sur la
// boucle des articles récents.
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'edigital-front-page' ); ?>>
			<div class="edigital-gutenberg-content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile;
else :
	get_template_part( 'index' );
endif;

get_footer();
