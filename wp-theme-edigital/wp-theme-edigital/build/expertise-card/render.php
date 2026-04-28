<?php
/**
 * Render — edigital/expertise-card
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre  = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$cat    = isset( $attributes['categorie'] ) ? (string) $attributes['categorie'] : '';
$img    = isset( $attributes['imageUrl'] ) ? (string) $attributes['imageUrl'] : '';
$alt    = isset( $attributes['imageAlt'] ) ? (string) $attributes['imageAlt'] : '';
$lien   = isset( $attributes['lien'] ) ? (string) $attributes['lien'] : '#';

if ( $lien && '/' === substr( $lien, 0, 1 ) ) {
	$lien = home_url( $lien );
}

if ( ! $alt ) {
	$alt = $titre;
}
?>
<div class="overlay left grid-item-p custom-ratio col-md-4 portfolios has-post-thumbnail">
	<div class="item--inner">
		<a aria-label="<?php echo esc_attr( $titre ); ?>" href="<?php echo esc_url( $lien ); ?>">
			<div class="ms-p-arrow">
				<svg class="ms-btt-arrow" viewBox="0 0 96 96" width="96" height="96"
					xmlns="http://www.w3.org/2000/svg">
					<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z" />
				</svg>
			</div>
			<?php if ( $img ) : ?>
			<figure class="ms-p-img parallax p_b cursor-none">
				<img class="is-inview" src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $alt ); ?>" />
			</figure>
			<?php endif; ?>
			<div class="ms-p-content justify-bottom cursor-none">
				<div class="ms-p-content__inner bottom align-items-start">
					<?php if ( $titre ) : ?>
					<h3><?php echo esc_html( $titre ); ?></h3>
					<?php endif; ?>
					<?php if ( $cat ) : ?>
					<span class="ms-p-cat"><?php echo esc_html( $cat ); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</a>
	</div>
</div>
