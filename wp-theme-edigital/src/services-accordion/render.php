<?php
/**
 * Render — edigital/services-accordion
 *
 * @var array  $attributes
 * @var string $content   Markup déjà rendu des items.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre  = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$align  = isset( $attributes['alignement'] ) ? (string) $attributes['alignement'] : 'right';
$ac_cls = 'ms_accordion l-ef i--' . sanitize_html_class( $align );

$wrapper = get_block_wrapper_attributes( array( 'class' => 'accordion-area' ) );
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
			<div class="accordion-container">
				<div class="<?php echo esc_attr( $ac_cls ); ?>" data-collapse="yes">
					<?php echo $content; ?>
				</div>
			</div>
		</div>
	</div>
</section>
