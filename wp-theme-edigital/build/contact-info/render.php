<?php
/**
 * Render — edigital/contact-info
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$tel_l   = isset( $attributes['telLabel'] ) ? (string) $attributes['telLabel'] : '';
$tel_v   = isset( $attributes['telValue'] ) ? (string) $attributes['telValue'] : '';
$mail_l  = isset( $attributes['emailLabel'] ) ? (string) $attributes['emailLabel'] : '';
$mail_v  = isset( $attributes['emailValue'] ) ? (string) $attributes['emailValue'] : '';
$h_l     = isset( $attributes['horairesLabel'] ) ? (string) $attributes['horairesLabel'] : '';
$h_v     = isset( $attributes['horairesValue'] ) ? (string) $attributes['horairesValue'] : '';

$wrapper = get_block_wrapper_attributes( array( 'class' => 'edigital-contact-info' ) );
?>
<aside <?php echo $wrapper; ?>>
	<?php if ( $tel_l ) : ?>
		<h4><?php echo esc_html( $tel_l ); ?></h4>
		<?php if ( $tel_v ) : ?>
			<p class="ci-line"><a href="tel:<?php echo esc_attr( preg_replace( '/[^+\d]/', '', $tel_v ) ); ?>"><?php echo esc_html( $tel_v ); ?></a></p>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( $mail_l ) : ?>
		<h4><?php echo esc_html( $mail_l ); ?></h4>
		<?php if ( $mail_v ) : ?>
			<p class="ci-line"><a href="mailto:<?php echo esc_attr( $mail_v ); ?>"><?php echo esc_html( $mail_v ); ?></a></p>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( $h_l ) : ?>
		<h4><?php echo esc_html( $h_l ); ?></h4>
		<?php if ( $h_v ) : ?>
			<p class="ci-line"><?php echo wp_kses_post( $h_v ); ?></p>
		<?php endif; ?>
	<?php endif; ?>
</aside>
