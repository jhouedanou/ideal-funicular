<?php
/**
 * Render — edigital/service-text-card
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$famille = isset( $attributes['icoFamille'] ) ? sanitize_html_class( $attributes['icoFamille'] ) : 'fas';
$icone   = isset( $attributes['icone'] ) ? sanitize_html_class( $attributes['icone'] ) : '';
$tag     = isset( $attributes['tag'] ) ? (string) $attributes['tag'] : '';
$titre   = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$texte   = isset( $attributes['texte'] ) ? (string) $attributes['texte'] : '';

$wrapper = get_block_wrapper_attributes( array( 'class' => 'service-text-card' ) );
?>
<div <?php echo $wrapper; ?>>
	<?php if ( $icone ) : ?>
	<div class="stc-icon"><i class="<?php echo esc_attr( $famille . ' ' . $icone ); ?>"></i></div>
	<?php endif; ?>
	<?php if ( $tag ) : ?>
	<span class="stc-tag"><?php echo esc_html( $tag ); ?></span>
	<?php endif; ?>
	<?php if ( $titre ) : ?>
	<h3><?php echo esc_html( $titre ); ?></h3>
	<?php endif; ?>
	<?php if ( $texte ) : ?>
	<p><?php echo wp_kses_post( $texte ); ?></p>
	<?php endif; ?>
</div>
