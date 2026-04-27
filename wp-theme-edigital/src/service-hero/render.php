<?php
/**
 * Render — edigital/service-hero
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$bg       = isset( $attributes['backgroundUrl'] ) ? (string) $attributes['backgroundUrl'] : '';
$b1_label = isset( $attributes['breadcrumb1Label'] ) ? (string) $attributes['breadcrumb1Label'] : '';
$b1_url   = isset( $attributes['breadcrumb1Url'] ) ? (string) $attributes['breadcrumb1Url'] : '';
$b2_label = isset( $attributes['breadcrumb2Label'] ) ? (string) $attributes['breadcrumb2Label'] : '';
$b2_url   = isset( $attributes['breadcrumb2Url'] ) ? (string) $attributes['breadcrumb2Url'] : '';
$current  = isset( $attributes['breadcrumbCurrent'] ) ? (string) $attributes['breadcrumbCurrent'] : '';
$titre    = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$sous     = isset( $attributes['sousTitre'] ) ? (string) $attributes['sousTitre'] : '';

$style = $bg
	? "background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('" . esc_url( $bg ) . "') no-repeat center center; background-size: cover;"
	: '';

$wrapper = get_block_wrapper_attributes( array(
	'class' => 'ms-hero-internal',
	'style' => $style,
) );
?>
<section <?php echo $wrapper; ?>>
	<div class="container">
		<div class="ms-hc">
			<div class="ms-hc--inner">
				<?php if ( $b1_label || $b2_label || $current ) : ?>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<?php if ( $b1_label ) : ?>
						<li class="breadcrumb-item"><a href="<?php echo esc_url( $b1_url ?: home_url( '/' ) ); ?>"><?php echo esc_html( $b1_label ); ?></a></li>
						<?php endif; ?>
						<?php if ( $b2_label ) : ?>
						<li class="breadcrumb-item"><a href="<?php echo esc_url( $b2_url ?: '#' ); ?>"><?php echo esc_html( $b2_label ); ?></a></li>
						<?php endif; ?>
						<?php if ( $current ) : ?>
						<li aria-current="page" class="breadcrumb-item active"><?php echo esc_html( $current ); ?></li>
						<?php endif; ?>
					</ol>
				</nav>
				<?php endif; ?>
				<?php if ( $titre ) : ?>
					<h1 class="ms-hero-title"><?php echo wp_kses_post( $titre ); ?></h1>
				<?php endif; ?>
				<?php if ( $sous ) : ?>
					<p class="ms-hero-subtitle"><?php echo wp_kses_post( $sous ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
