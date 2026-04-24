<?php
/**
 * Template Name: Elementor Canvas
 * Template Post Type: page, post, projet
 *
 * Canvas Elementor 100% vierge — aucun header, footer ou sidebar du thème.
 * Idéal pour les landing pages, popups ou pages full-Elementor avec Theme
 * Builder. Équivalent du template Hello Elementor « Canvas ».
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/fav-icone.png' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'ms-body edigital-canvas elementor-template-canvas' ); ?>>
<?php wp_body_open(); ?>
<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		the_content();
	endwhile;
endif;
?>
<?php wp_footer(); ?>
</body>
</html>
