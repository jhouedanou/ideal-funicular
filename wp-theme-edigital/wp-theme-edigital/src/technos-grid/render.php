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

$wrapper = get_block_wrapper_attributes( array( 'class' => 'technos-grid section-padding' ) );
?>
<section <?php echo $wrapper; ?>>
	<div class="container">
		<div class="row">
			<?php foreach ( $items as $item ) :
				$label = isset( $item['label'] ) ? (string) $item['label'] : '';
				$desc  = isset( $item['description'] ) ? (string) $item['description'] : '';
				$icon  = isset( $item['iconUrl'] ) ? (string) $item['iconUrl'] : '';
			?>
			<div class="col-md-3 col-sm-6 mb-4">
				<article class="tech-card">
					<?php if ( $icon ) : ?>
						<figure class="tech-card-icon">
							<img alt="<?php echo esc_attr( wp_strip_all_tags( $label ) ); ?>" src="<?php echo esc_url( $icon ); ?>" />
						</figure>
					<?php endif; ?>
					<?php if ( $label ) : ?>
						<h4 class="tech-card-title"><?php echo esc_html( $label ); ?></h4>
					<?php endif; ?>
					<?php if ( $desc ) : ?>
						<p class="tech-card-desc"><?php echo wp_kses_post( $desc ); ?></p>
					<?php endif; ?>
				</article>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
