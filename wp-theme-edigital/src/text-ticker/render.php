<?php
/**
 * Render — edigital/text-ticker
 *
 * @var array  $attributes
 * @var string $content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$ligne1 = isset( $attributes['ligne1'] ) && is_array( $attributes['ligne1'] ) ? $attributes['ligne1'] : array();
$ligne2 = isset( $attributes['ligne2'] ) && is_array( $attributes['ligne2'] ) ? $attributes['ligne2'] : array();
$sep    = isset( $attributes['separateurUrl'] ) ? (string) $attributes['separateurUrl'] : '';

if ( empty( $ligne1 ) && empty( $ligne2 ) ) {
	return;
}

$render_line = function ( $items, $sep_url, $extra_class, $scroll_class ) {
	if ( empty( $items ) ) {
		return;
	}
	?>
	<ul class="ms-tt <?php echo esc_attr( $extra_class . ' ' . $scroll_class ); ?> text-split">
		<?php foreach ( $items as $item ) :
			$avant = isset( $item['avant'] ) ? $item['avant'] : '';
			$mot   = isset( $item['mot'] ) ? $item['mot'] : '';
			$apres = isset( $item['apres'] ) ? $item['apres'] : '';
		?>
		<li class="ms-tt__text">
			<?php
			echo esc_html( $avant );
			if ( $mot ) {
				echo $avant ? ' ' : '';
				echo '<span>' . esc_html( $mot ) . '</span>';
			}
			if ( $apres ) {
				echo ' ' . esc_html( $apres );
			}
			?>
		</li>
		<?php if ( $sep_url ) : ?>
		<li class="ms-tt__text img">
			<img src="<?php echo esc_url( $sep_url ); ?>" alt="" decoding="async" />
		</li>
		<?php endif; ?>
		<?php endforeach; ?>
	</ul>
	<?php
};

$wrapper = get_block_wrapper_attributes( array( 'class' => 'ms-text-ticker' ) );
?>
<div <?php echo $wrapper; ?>>
	<div class="ms-tt-wrap s-d is-inview">
		<?php $render_line( $ligne1, $sep, '', 'scrollingText-two' ); ?>
		<?php $render_line( $ligne2, $sep, 'two', 'scrollingText-four' ); ?>
	</div>
</div>
