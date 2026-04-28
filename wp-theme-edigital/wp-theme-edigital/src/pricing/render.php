<?php
/**
 * Render — edigital/pricing
 *
 * @var array  $attributes
 * @var string $content   Markup déjà rendu des cartes (pricing-card).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre  = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$ancre  = isset( $attributes['ancre'] ) ? sanitize_html_class( $attributes['ancre'] ) : '';
$extras = isset( $attributes['extras'] ) && is_array( $attributes['extras'] )
	? $attributes['extras']
	: array();

$wrapper_attrs = array(
	'class' => 'pricing-area',
	'style' => 'padding: 100px 0; background: #fff;',
);
if ( $ancre ) {
	$wrapper_attrs['id'] = $ancre;
}
$wrapper = get_block_wrapper_attributes( $wrapper_attrs );
?>
<section <?php echo $wrapper; ?>>
	<div class="row">
		<div class="col-lg-12">
			<div class="ms-ah-wrapper custom-style2">
				<?php if ( $titre ) : ?>
				<h2 class="content__title hero-title title up-text">
					<?php echo esc_html( $titre ); ?>
				</h2>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-lg-4"></div>
		<div class="col-lg-8">
			<div class="pricing-cards-wrapper"
				style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-top: 40px;">
				<?php echo $content; ?>
			</div>
			<?php if ( ! empty( $extras ) ) : ?>
			<div class="additional-prices"
				style="margin-top: 50px; padding: 30px; border-radius: 15px; border-left: 5px solid #e31414; background: #fff;">
				<div class="row">
					<?php foreach ( $extras as $row ) :
						$libelle = isset( $row['libelle'] ) ? (string) $row['libelle'] : '';
						$prix    = isset( $row['prix'] ) ? (string) $row['prix'] : '';
						if ( ! $libelle && ! $prix ) { continue; }
					?>
					<div class="col-md-6">
						<?php if ( $libelle ) : ?>
						<p style="font-size: 1.1rem; margin-bottom: 5px; font-weight: 600;">
							<?php echo esc_html( $libelle ); ?>
						</p>
						<?php endif; ?>
						<?php if ( $prix ) : ?>
						<p style="color: #e31414; font-weight: 700;">
							<?php echo esc_html( $prix ); ?>
						</p>
						<?php endif; ?>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
