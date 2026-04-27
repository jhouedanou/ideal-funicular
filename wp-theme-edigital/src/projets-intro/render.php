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

$wrapper = get_block_wrapper_attributes( array( 'class' => 'projets-intro section-padding' ) );
?>
<section <?php echo $wrapper; ?>>
	<div class="container">
		<div class="section-title text-center">
			<?php if ( $titre ) : ?>
				<h2 class="title"><?php echo wp_kses_post( $titre ); ?></h2>
			<?php endif; ?>
			<?php if ( $sousTitre ) : ?>
				<p class="subtitle"><?php echo wp_kses_post( $sousTitre ); ?></p>
			<?php endif; ?>
		</div>
		<?php if ( ! empty( $filtres ) ) : ?>
		<div class="portfolio-filter text-center mt-4" data-projets-filter>
			<ul class="filter-buttons">
				<?php foreach ( $filtres as $f ) :
					$label = isset( $f['label'] ) ? (string) $f['label'] : '';
					$slug  = isset( $f['slug'] ) ? (string) $f['slug'] : '';
					if ( '' === $label ) { continue; }
				?>
				<li class="filter-btn" data-filter="<?php echo esc_attr( $slug ); ?>">
					<?php echo esc_html( $label ); ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>
	</div>
</section>
