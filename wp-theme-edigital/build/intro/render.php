<?php
/**
 * Render — edigital/intro
 *
 * @var array    $attributes
 * @var string   $content
 * @var WP_Block $block
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre1 = isset( $attributes['titreLigne1'] ) ? (string) $attributes['titreLigne1'] : '';
$titre2 = isset( $attributes['titreLigne2'] ) ? (string) $attributes['titreLigne2'] : '';
$tag    = isset( $attributes['etiquette'] ) ? (string) $attributes['etiquette'] : '';
$ancre  = isset( $attributes['ancre'] ) ? sanitize_html_class( $attributes['ancre'] ) : '';

$wrapper_attrs = array( 'class' => 'ms-page-content portfolio-banner' );
if ( $ancre ) {
	$wrapper_attrs['id'] = $ancre;
}
$wrapper = get_block_wrapper_attributes( $wrapper_attrs );
?>
<div <?php echo $wrapper; ?>>
	<div class="container">
		<div class="ms-ah-wrapper">
			<?php if ( $titre1 || $titre2 ) : ?>
			<h1 class="content__title" data-effect5="" data-scroll="off" data-splitting="">
				<?php
				echo esc_html( $titre1 );
				if ( $titre1 && $titre2 ) {
					echo '<br />';
				}
				echo esc_html( $titre2 );
				?>
			</h1>
			<?php endif; ?>
			<?php if ( $tag ) : ?>
			<h2 class="heading-title"><?php echo esc_html( $tag ); ?></h2>
			<?php endif; ?>
		</div>
	</div>
</div>
