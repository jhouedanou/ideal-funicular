<?php
/**
 * Render — edigital/office-card
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$label   = isset( $attributes['label'] ) ? (string) $attributes['label'] : '';
$adresse = isset( $attributes['adresse'] ) ? (string) $attributes['adresse'] : '';

$wrapper = get_block_wrapper_attributes( array( 'class' => 'edigital-office-card' ) );
?>
<div <?php echo $wrapper; ?>>
	<?php if ( $label ) : ?>
	<h4><?php echo esc_html( $label ); ?></h4>
	<?php endif; ?>
	<?php if ( $adresse ) : ?>
	<p><?php echo wp_kses_post( $adresse ); ?></p>
	<?php endif; ?>
</div>
