<?php
/**
 * Render — edigital/technos-grid
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$items = isset( $attributes['items'] ) && is_array( $attributes['items'] ) ? $attributes['items'] : array();
if ( empty( $items ) ) {
	return;
}

$wrapper = get_block_wrapper_attributes( array( 'class' => 'services-area-2 pt-100 pb-100' ) );
?>
<div <?php echo $wrapper; ?>>
	<div class="container">
		<div class="row">
			<?php foreach ( $items as $item ) :
				$label = isset( $item['label'] ) ? (string) $item['label'] : '';
				$desc  = isset( $item['description'] ) ? (string) $item['description'] : '';
				$icon  = isset( $item['iconUrl'] ) ? (string) $item['iconUrl'] : '';
			?>
			<div class="col-lg-4 col-md-6">
				<div class="tech-card">
					<?php if ( $icon ) : ?>
						<img alt="<?php echo esc_attr( wp_strip_all_tags( $label ) ); ?>" src="<?php echo esc_url( $icon ); ?>" />
					<?php endif; ?>
					<?php if ( $label ) : ?>
						<h3><?php echo esc_html( $label ); ?></h3>
					<?php endif; ?>
					<?php if ( $desc ) : ?>
						<p><?php echo wp_kses_post( $desc ); ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
