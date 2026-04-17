<?php
/**
 * En-tête du site.
 *
 * @package EDigital
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.png' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'ms-body' ); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Aller au contenu principal', 'edigital' ); ?></a>

<div class="ms-main">
	<header class="ms-header" role="banner">
		<div class="container-fluid">
			<div class="ms-header__inner d-flex align-items-center justify-content-between">
				<div class="ms-header__logo">
					<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ms-header__logo-link">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/Logo_black.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
						</a>
					<?php endif; ?>
				</div>

				<nav class="ms-nav" role="navigation" aria-label="<?php esc_attr_e( 'Menu principal', 'edigital' ); ?>">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'ms-nav__list',
						'fallback_cb'    => 'edigital_primary_menu_fallback',
						'depth'          => 2,
					) );
					?>
				</nav>
			</div>
		</div>
	</header>

	<main id="content" class="ms-page-content">
