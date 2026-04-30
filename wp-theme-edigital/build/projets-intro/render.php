<?php
/**
 * Render — edigital/projets-intro
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre     = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$sousTitre = isset( $attributes['sousTitre'] ) ? (string) $attributes['sousTitre'] : '';
$filtres   = isset( $attributes['filtres'] ) && is_array( $attributes['filtres'] ) ? $attributes['filtres'] : array();

// Détecte la présence d'un filtre "Tous" (slug = "*"). Sinon, on en injecte un en tête.
$has_all = false;
foreach ( $filtres as $f ) {
	if ( isset( $f['slug'] ) && '*' === $f['slug'] ) { $has_all = true; break; }
}

$wrapper = get_block_wrapper_attributes( array( 'class' => 'project-area pt-150 pb-100' ) );
?>
<section <?php echo $wrapper; ?>>
	<div class="container">
		<?php if ( $titre ) : ?>
		<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%;">
			<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; margin-top: 50px !important;"><span><?php echo wp_kses_post( $titre ); ?></span></h2>
			<?php if ( $sousTitre ) : ?>
				<p style="font-size: 1.1rem; color: #666; max-width: 800px; margin: 20px auto 30px;"><?php echo wp_kses_post( $sousTitre ); ?></p>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php if ( ! empty( $filtres ) ) : ?>
		<div class="ms-portfolio-filter-area project main-isotop">
			<div class="container">
				<div class="button-group filters-button-group filtr-btn filter-nav__list js-filter-nav__list style-2 text-center" style="margin-bottom: 40px; display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
					<?php if ( ! $has_all ) : ?>
						<button class="button is-checked" data-filter="*">Tous</button>
					<?php endif; ?>
					<?php foreach ( $filtres as $i => $f ) :
						$label = isset( $f['label'] ) ? (string) $f['label'] : '';
						$slug  = isset( $f['slug'] ) ? (string) $f['slug'] : '';
						if ( '' === $label ) { continue; }
						$is_all   = ( '*' === $slug );
						$filter   = $is_all ? '*' : '.' . ltrim( $slug, '.' );
						$is_first = ( 0 === $i );
						$active   = ( $is_all || ( ! $has_all ? false : $is_first ) ) ? ' is-checked' : '';
					?>
						<button class="button<?php echo esc_attr( $active ); ?>" data-filter="<?php echo esc_attr( $filter ); ?>"><?php echo esc_html( $label ); ?></button>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>
