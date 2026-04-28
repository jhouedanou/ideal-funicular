<?php
/**
 * Render — edigital/parallax-hero
 *
 * @var array  $attributes
 * @var string $content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$bg     = isset( $attributes['backgroundUrl'] ) ? (string) $attributes['backgroundUrl'] : '';
$titre1 = isset( $attributes['titreLigne1'] ) ? (string) $attributes['titreLigne1'] : '';
$titre2 = isset( $attributes['titreLigne2'] ) ? (string) $attributes['titreLigne2'] : '';

$wrapper = get_block_wrapper_attributes( array( 'class' => 'ms-hero four' ) );
?>
<section <?php echo $wrapper; ?>>
	<div class="ms-parallax jarallax-img" data-speed="0.7" data-type="scroll"
		<?php if ( $bg ) : ?>style="background-image: url('<?php echo esc_url( $bg ); ?>');"<?php endif; ?>>
	</div>
	<div class="ms-hc">
		<div class="ms-hc--inner">
			<?php if ( $titre1 || $titre2 ) : ?>
			<h2 class="ms-hero-title">
				<?php
				echo esc_html( $titre1 );
				if ( $titre1 && $titre2 ) {
					echo '<br />';
				}
				echo esc_html( $titre2 );
				?>
			</h2>
			<?php endif; ?>
		</div>
	</div>
</section>
