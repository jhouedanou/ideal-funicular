<?php
/**
 * En-tête principal du thème E-Digital — fidélité au HTML statique.
 *
 * @package EDigital
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() . '/../fav-icone.png' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'ms-body' ); ?> data-theme="light" data-menu="fixed" data-footer-effect="on" data-footer-corners="on">
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Aller au contenu principal', 'edigital' ); ?></a>
<?php get_template_part( 'header', 'static' ); ?>
