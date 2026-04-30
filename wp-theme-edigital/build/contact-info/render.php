<?php
/**
 * Render — edigital/contact-info
 *
 * Reproduit la carte sombre <aside class="contact-info-col"><div class="contact-info-card">…</div></aside>
 * de contact.html (lignes 794-848).
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre        = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$tel_l        = isset( $attributes['telLabel'] ) ? (string) $attributes['telLabel'] : '';
$tel_v        = isset( $attributes['telValue'] ) ? (string) $attributes['telValue'] : '';
$mail_l       = isset( $attributes['emailLabel'] ) ? (string) $attributes['emailLabel'] : '';
$mail_v       = isset( $attributes['emailValue'] ) ? (string) $attributes['emailValue'] : '';
$adr1_l       = isset( $attributes['adresse1Label'] ) ? (string) $attributes['adresse1Label'] : '';
$adr1_v       = isset( $attributes['adresse1Value'] ) ? (string) $attributes['adresse1Value'] : '';
$adr2_l       = isset( $attributes['adresse2Label'] ) ? (string) $attributes['adresse2Label'] : '';
$adr2_v       = isset( $attributes['adresse2Value'] ) ? (string) $attributes['adresse2Value'] : '';
$h_l          = isset( $attributes['horairesLabel'] ) ? (string) $attributes['horairesLabel'] : '';
$h_v          = isset( $attributes['horairesValue'] ) ? (string) $attributes['horairesValue'] : '';
$fb           = isset( $attributes['facebookUrl'] ) ? (string) $attributes['facebookUrl'] : '';
$ln           = isset( $attributes['linkedinUrl'] ) ? (string) $attributes['linkedinUrl'] : '';

$wrapper = get_block_wrapper_attributes( array( 'class' => 'contact-info-col' ) );

$render_item = function ( $icon_class, $label, $value, $href = '' ) {
	if ( ! $label && ! $value ) { return; }
	?>
	<div class="contact-info-item">
		<div class="cii-icon"><i class="<?php echo esc_attr( $icon_class ); ?>"></i></div>
		<div class="cii-text">
			<?php if ( $label ) : ?><p><?php echo esc_html( $label ); ?></p><?php endif; ?>
			<?php if ( $value ) : ?>
				<span>
					<?php if ( $href ) : ?>
						<a href="<?php echo esc_attr( $href ); ?>" style="color:#fff;text-decoration:none;"><?php echo esc_html( $value ); ?></a>
					<?php else : ?>
						<?php echo esc_html( $value ); ?>
					<?php endif; ?>
				</span>
			<?php endif; ?>
		</div>
	</div>
	<?php
};
?>
<aside <?php echo $wrapper; ?>>
	<div class="contact-info-card">
		<?php if ( $titre ) : ?>
			<h3><?php echo esc_html( $titre ); ?></h3>
		<?php endif; ?>

		<?php
		if ( $tel_v ) {
			$tel_href = 'tel:' . preg_replace( '/[^+\d]/', '', $tel_v );
			$render_item( 'fas fa-phone-alt', $tel_l, $tel_v, $tel_href );
		}
		if ( $mail_v ) {
			$render_item( 'fas fa-envelope', $mail_l, $mail_v, 'mailto:' . $mail_v );
		}
		if ( $adr1_v ) {
			$render_item( 'fas fa-map-marker-alt', $adr1_l, $adr1_v );
		}
		if ( $adr2_v ) {
			$render_item( 'fas fa-building', $adr2_l, $adr2_v );
		}
		if ( $h_v ) {
			$render_item( 'fas fa-clock', $h_l, $h_v );
		}
		?>

		<?php if ( $fb || $ln ) : ?>
		<div class="contact-social-row">
			<?php if ( $fb ) : ?>
				<a href="<?php echo esc_url( $fb ); ?>" target="_blank" rel="noopener" class="contact-social-btn"><i class="fab fa-facebook-f"></i> Facebook</a>
			<?php endif; ?>
			<?php if ( $ln ) : ?>
				<a href="<?php echo esc_url( $ln ); ?>" target="_blank" rel="noopener" class="contact-social-btn"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</aside>
