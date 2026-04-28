<?php
/**
 * Render — edigital/pricing-card
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre   = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$sub     = isset( $attributes['sousTitre'] ) ? (string) $attributes['sousTitre'] : '';
$prix    = isset( $attributes['prix'] ) ? (string) $attributes['prix'] : '';
$points  = isset( $attributes['points'] ) && is_array( $attributes['points'] ) ? $attributes['points'] : array();
$libelle = isset( $attributes['libelleCta'] ) ? (string) $attributes['libelleCta'] : '';
$lien    = isset( $attributes['lienCta'] ) ? (string) $attributes['lienCta'] : '';
$accent  = ! empty( $attributes['accent'] );

if ( $lien && '/' === substr( $lien, 0, 1 ) ) {
	$lien = home_url( $lien );
}

$card_style = $accent
	? 'border: 1px solid #eee; padding: 40px; border-radius: 20px; background: #000; color: #fff; display: flex; flex-direction: column; justify-content: space-between;'
	: 'border: 1px solid #eee; padding: 40px; border-radius: 20px; background: #f9f9f9; display: flex; flex-direction: column; justify-content: space-between;';

$cta_style = $accent
	? 'text-align: center; display: block; background: #e31414; border: none; color: #fff !important;'
	: 'text-align: center; display: block; color: #fff !important;';

$sub_style  = $accent ? 'color: #aaa; font-size: 0.9rem;' : 'color: #666; font-size: 0.9rem;';
$list_color = $accent ? '#ddd' : '#444';
?>
<div class="pricing-card" style="<?php echo esc_attr( $card_style ); ?>">
	<div class="top">
		<?php if ( $titre ) : ?>
		<h4 style="font-size: 1.5rem; margin-bottom: 10px;"><?php echo esc_html( $titre ); ?></h4>
		<?php endif; ?>
		<?php if ( $sub ) : ?>
		<p style="<?php echo esc_attr( $sub_style ); ?>"><?php echo esc_html( $sub ); ?></p>
		<?php endif; ?>
		<?php if ( $prix ) : ?>
		<div class="price" style="margin: 20px 0; font-size: 2.5rem; font-weight: 700; color: #e31414;">
			<?php echo esc_html( $prix ); ?>
		</div>
		<?php endif; ?>
	</div>
	<?php if ( ! empty( $points ) ) : ?>
	<ul style="list-style: none; padding: 0; margin-bottom: 30px; color: <?php echo esc_attr( $list_color ); ?>; font-size: 0.95rem;">
		<?php foreach ( $points as $pt ) :
			$pt = trim( (string) $pt );
			if ( '' === $pt ) { continue; }
		?>
		<li style="margin-bottom: 10px;">
			<i class="fas fa-check" style="color: #e31414; margin-right: 10px;"></i>
			<?php echo esc_html( $pt ); ?>
		</li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
	<?php if ( $libelle && $lien ) : ?>
	<a class="btn btn--sm btn--primary"
		href="<?php echo esc_url( $lien ); ?>"
		style="<?php echo esc_attr( $cta_style ); ?>">
		<?php echo esc_html( $libelle ); ?>
	</a>
	<?php endif; ?>
</div>
