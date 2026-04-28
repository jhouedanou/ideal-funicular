<?php
/**
 * Render — edigital/expertise-grid
 *
 * @var array  $attributes
 * @var string $content   Markup déjà rendu des InnerBlocks (cartes).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre       = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$texte_cta   = isset( $attributes['texteCta'] ) ? (string) $attributes['texteCta'] : '';
$libelle_cta = isset( $attributes['libelleCta'] ) ? (string) $attributes['libelleCta'] : '';
$lien_cta    = isset( $attributes['lienCta'] ) ? (string) $attributes['lienCta'] : '';

if ( $lien_cta && '/' === substr( $lien_cta, 0, 1 ) ) {
	$lien_cta = home_url( $lien_cta );
}

$arrow_url = get_template_directory_uri() . '/assets/images/portfolio/arrow-right.svg';

$wrapper = get_block_wrapper_attributes( array( 'class' => 'project-area four' ) );
?>
<section <?php echo $wrapper; ?>>
	<div class="row">
		<div class="col-lg-12">
			<div class="ms-ah-wrapper custom-style">
				<?php if ( $titre ) : ?>
				<h2 class="content__title hero-title title up-text">
					<?php echo wp_kses_post( $titre ); ?>
				</h2>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-lg-4"></div>
		<div class="col-lg-8">
			<div class="portfolio_wrap">
				<div class="portfolio-feed ms-p--d row p-0">
					<?php echo $content; ?>
					<div class="grid-sizer col-md-4"></div>
				</div>
				<?php if ( $libelle_cta && $lien_cta ) : ?>
				<div class="portfolio-button-area d-flex align-items-center justify-content-start">
					<?php if ( $texte_cta ) : ?>
					<p><?php echo esc_html( $texte_cta ); ?></p>
					<?php endif; ?>
					<img src="<?php echo esc_url( $arrow_url ); ?>" alt="" width="24" />
					<a class="ms-sl" href="<?php echo esc_url( $lien_cta ); ?>" role="button">
						<?php echo esc_html( $libelle_cta ); ?>
					</a>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
