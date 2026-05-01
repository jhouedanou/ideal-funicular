<?php
/**
 * Template Name: E-Digital — Contact
 *
 * Page de contact multi-étapes fidèle à contact.html.
 * Le formulaire et la sidebar sont rendus via les fonctions
 * edigital_contact_form_html() et edigital_contact_sidebar_html()
 * définies dans inc/contact-form.php.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Inline styles supplémentaires propres à cette page.
add_action( 'wp_enqueue_scripts', function () {
	wp_add_inline_style( 'edigital-style', '
		html, body { height:auto!important; overflow:visible!important; overflow-x:hidden!important; display:block!important; position:relative!important; }
		.ms-main, .ms-page-content { height:auto!important; overflow:visible!important; position:relative!important; display:block!important; }
		.main-header.ms-nb--transparent { position:absolute!important; top:0; left:0; width:100%; z-index:9999!important; background:transparent!important; pointer-events:auto!important; }
	' );
}, 20 );

get_header();
?>
<main class="ms-main">

	<?php /* ─── Hero marquee ─── */ ?>
	<div class="marquee-area contact">
		<div class="marquee-inner">
			<ul class="marquee">
				<li class="ms-tt__text"><?php esc_html_e( 'Travaillons Ensemble', 'edigital' ); ?>&nbsp;</li>
				<li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/portfolio/circle-mokko.svg' ); ?>" alt=""></li>
				<li class="ms-tt__text"><?php esc_html_e( 'Travaillons Ensemble', 'edigital' ); ?>&nbsp;</li>
				<li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/portfolio/circle-mokko.svg' ); ?>" alt=""></li>
				<li class="ms-tt__text"><?php esc_html_e( 'Travaillons Ensemble', 'edigital' ); ?>&nbsp;</li>
				<li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/portfolio/circle-mokko.svg' ); ?>" alt=""></li>
			</ul>
		</div>
	</div>

	<div class="ms-page-content">

		<?php /* ─── Formulaire contact multi-étapes ─── */ ?>
		<section class="contact-multistep-section">
			<div class="container">
				<div class="contact-layout">

					<div class="contact-form-col">
						<?php echo edigital_contact_form_html(); ?>
					</div>

					<aside class="contact-info-col">
						<?php echo edigital_contact_sidebar_html(); ?>
					</aside>

				</div>
			</div>
		</section>

		<?php get_template_part( 'template-parts/newsletter-section' ); ?>

	</div>
</main>
<?php
get_footer();

