<?php
/**
 * Render — edigital/services-hub
 *
 * Reproduit fidèlement la grille de cartes services de services.html (l. 225-337) :
 * <section class="project-area pt-150 pb-100"> > .container > .services-grid-wrap > .row > .col-md-4 col-sm-6 mb-5 > article.service-card > a > figure > img + .service-card-content > h3 + p
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$items = isset( $attributes['items'] ) && is_array( $attributes['items'] ) ? $attributes['items'] : array();
if ( empty( $items ) ) {
	return;
}

$wrapper = get_block_wrapper_attributes( array( 'class' => 'project-area pt-150 pb-100' ) );
?>
<section <?php echo $wrapper; ?>>
	<div class="container">
		<div class="services-grid-wrap">
			<div class="row">
				<?php foreach ( $items as $item ) :
					$titre = isset( $item['titre'] ) ? (string) $item['titre'] : '';
					$desc  = isset( $item['description'] ) ? (string) $item['description'] : '';
					$url   = isset( $item['url'] ) ? (string) $item['url'] : '';
					$img   = isset( $item['imageUrl'] ) ? (string) $item['imageUrl'] : '';
				?>
				<div class="col-md-4 col-sm-6 mb-5">
					<article class="service-card">
						<a href="<?php echo esc_url( $url ?: '#' ); ?>">
							<?php if ( $img ) : ?>
							<figure>
								<img alt="<?php echo esc_attr( wp_strip_all_tags( $titre ) ); ?>" src="<?php echo esc_url( $img ); ?>" />
							</figure>
							<?php endif; ?>
							<div class="service-card-content">
								<?php if ( $titre ) : ?>
									<h3><?php echo esc_html( $titre ); ?></h3>
								<?php endif; ?>
								<?php if ( $desc ) : ?>
									<p><?php echo wp_kses_post( $desc ); ?></p>
								<?php endif; ?>
							</div>
						</a>
					</article>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
