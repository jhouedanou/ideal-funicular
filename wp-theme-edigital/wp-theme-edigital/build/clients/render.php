<?php
/**
 * Render — edigital/clients
 *
 * @var array  $attributes
 * @var string $content   Markup déjà rendu des logos (client-logo).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre1 = isset( $attributes['titreLigne1'] ) ? (string) $attributes['titreLigne1'] : '';
$titre2 = isset( $attributes['titreLigne2'] ) ? (string) $attributes['titreLigne2'] : '';
$bg     = isset( $attributes['backgroundUrl'] ) ? (string) $attributes['backgroundUrl'] : '';

$wrapper = get_block_wrapper_attributes( array( 'class' => 'client-area' ) );
?>
<section <?php echo $wrapper; ?>>
	<div class="client-bg-area ms-parallax jarallax-img" data-speed="0.7" data-type="scroll"
		<?php if ( $bg ) : ?>style="background-image: url('<?php echo esc_url( $bg ); ?>');"<?php endif; ?>>
		<div class="container">
			<?php if ( $titre1 || $titre2 ) : ?>
			<h2 class="heading-title text-center">
				<?php
				echo esc_html( $titre1 );
				if ( $titre1 && $titre2 ) {
					echo '<br />';
				}
				echo esc_html( $titre2 );
				?>
			</h2>
			<?php endif; ?>
			<div class="client-logo-area">
				<div class="row align-items-center justify-content-center">
					<?php echo $content; ?>
				</div>
			</div>
		</div>
	</div>
</section>
