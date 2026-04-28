<?php
/**
 * Render — edigital/service-cta
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre   = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$texte   = isset( $attributes['texte'] ) ? (string) $attributes['texte'] : '';
$libelle = isset( $attributes['libelleCta'] ) ? (string) $attributes['libelleCta'] : '';
$lien    = isset( $attributes['lienCta'] ) ? (string) $attributes['lienCta'] : '';

$wrapper = get_block_wrapper_attributes( array( 'class' => 'service-cta' ) );
?>
<section <?php echo $wrapper; ?>>
	<div class="container">
		<?php if ( $titre ) : ?>
			<h2><?php echo esc_html( $titre ); ?></h2>
		<?php endif; ?>
		<?php if ( $texte ) : ?>
			<p><?php echo wp_kses_post( $texte ); ?></p>
		<?php endif; ?>
		<?php if ( $libelle ) : ?>
			<a class="btn-cta" href="<?php echo esc_url( $lien ?: '#' ); ?>"><?php echo esc_html( $libelle ); ?></a>
		<?php endif; ?>
	</div>
</section>
