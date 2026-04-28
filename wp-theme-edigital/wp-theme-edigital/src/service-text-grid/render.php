<?php
/**
 * Render — edigital/service-text-grid
 *
 * @var array  $attributes
 * @var string $content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$colonnes = isset( $attributes['colonnes'] ) ? max( 1, (int) $attributes['colonnes'] ) : 3;

$wrapper = get_block_wrapper_attributes( array(
	'class' => 'service-text-grid service-text-grid--cols-' . $colonnes,
	'style' => 'grid-template-columns: repeat(' . $colonnes . ', 1fr);',
) );
?>
<div <?php echo $wrapper; ?>>
	<?php echo $content; ?>
</div>
