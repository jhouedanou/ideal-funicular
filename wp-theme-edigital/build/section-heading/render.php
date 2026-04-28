<?php
/**
 * Render — edigital/section-heading
 *
 * Reproduit le markup de la maquette : .project-area > .container > .e-con-inner.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre     = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$etiquette = isset( $attributes['etiquette'] ) ? (string) $attributes['etiquette'] : '';
$variante  = isset( $attributes['variante'] ) ? (string) $attributes['variante'] : 'default';

$class = 'project-area';
if ( 'last' === $variante ) {
	$class .= ' last';
}

$wrapper = get_block_wrapper_attributes( array( 'class' => $class ) );
?>
<div <?php echo $wrapper; ?>>
	<div class="container">
		<div class="e-con-inner">
			<?php if ( $titre ) : ?>
			<h2 class="content__title rts-has-mask-fill">
				<span><?php echo wp_kses_post( $titre ); ?></span>
			</h2>
			<?php endif; ?>
			<?php if ( $etiquette ) : ?>
			<p class="number-tag"><?php echo esc_html( $etiquette ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>
