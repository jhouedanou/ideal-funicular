<?php
/**
 * Render — edigital/marquee-images
 *
 * @var array  $attributes
 * @var string $content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$images = isset( $attributes['images'] ) && is_array( $attributes['images'] )
	? $attributes['images']
	: array();

if ( empty( $images ) ) {
	return;
}

// Doubler la liste pour l'effet de défilement infini.
$loop_items = array_merge( $images, $images );

$wrapper = get_block_wrapper_attributes( array( 'class' => 'marquee-area' ) );
?>
<div <?php echo $wrapper; ?>>
	<div class="marquee-inner">
		<ul class="marquee">
			<?php foreach ( $loop_items as $img ) :
				$url = isset( $img['url'] ) ? $img['url'] : '';
				$alt = isset( $img['alt'] ) ? $img['alt'] : '';
				if ( ! $url ) { continue; }
			?>
			<li>
				<img src="<?php echo esc_url( $url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" />
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
