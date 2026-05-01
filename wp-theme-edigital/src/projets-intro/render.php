<?php
/**
 * Render — edigital/projets-intro
 *
 * Rendu fidèle à nos-projets.html :
 * intro h2 + boutons de filtre + grille des projets imbriqués dans
 * ms-portfolio-filter-area → filtre Isotope/Filterizr opérationnel.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre     = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$sousTitre = isset( $attributes['sousTitre'] ) ? (string) $attributes['sousTitre'] : '';
$filtres   = isset( $attributes['filtres'] ) && is_array( $attributes['filtres'] ) ? $attributes['filtres'] : array();

// SVG flèche commun à chaque carte (identique à nos-projets.html).
$arrow_svg = '<div class="ms-p-arrow" style="z-index:10;">'
	. '<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewBox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">'
	. '<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z"></path>'
	. '</svg></div>';

// Détecte la présence d'un filtre "Tous" (slug = "*"). Sinon, on en injecte un en tête.
$has_all = false;
foreach ( $filtres as $f ) {
	if ( isset( $f['slug'] ) && '*' === $f['slug'] ) { $has_all = true; break; }
}

// Requête des projets.
$projets_query = new WP_Query( array(
	'post_type'      => 'projet',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order date',
	'order'          => 'ASC',
) );

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

		<div class="ms-portfolio-filter-area project main-isotop">
			<div class="container">
				<?php if ( ! empty( $filtres ) ) : ?>
				<div class="filter-nav filter-nav--expanded js-filter-nav"></div>
				<div class="button-group filters-button-group filtr-btn filter-nav__list js-filter-nav__list style-2 text-center" style="margin-bottom: 40px; display: flex; justify-content: center; gap: 15px;">
					<?php if ( ! $has_all ) : ?>
						<button class="button is-checked" data-filter="*">Tous nos projets</button>
					<?php endif; ?>
					<?php foreach ( $filtres as $i => $f ) :
						$label  = isset( $f['label'] ) ? (string) $f['label'] : '';
						$slug   = isset( $f['slug'] ) ? (string) $f['slug'] : '';
						if ( '' === $label ) { continue; }
						$is_all = ( '*' === $slug );
						$filter = $is_all ? '*' : '.' . ltrim( $slug, '.' );
						$active = ( $is_all && $has_all ) ? ' is-checked' : '';
					?>
						<button class="button<?php echo esc_attr( $active ); ?>" data-filter="<?php echo esc_attr( $filter ); ?>"><?php echo esc_html( $label ); ?></button>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>

				<div class="portfolio_wrap style-3">
					<div class="row filter portfolio-feed ms-p--d grid-masonary">
					<?php if ( $projets_query->have_posts() ) :
						while ( $projets_query->have_posts() ) : $projets_query->the_post();
							$pid       = get_the_ID();
							$thumb_url = get_the_post_thumbnail_url( $pid, 'full' ) ?: '';
							$sous      = get_post_meta( $pid, 'sous_titre', true );
							if ( ! $sous ) {
								$sous = get_the_excerpt();
							}

							// Classes de filtre depuis la taxonomie expertise.
							$cat_terms = get_the_terms( $pid, 'expertise' );
							$cat_slugs = array();
							if ( $cat_terms && ! is_wp_error( $cat_terms ) ) {
								foreach ( $cat_terms as $term ) {
									$cat_slugs[] = $term->slug;
								}
							}
							$cat_class = ! empty( $cat_slugs ) ? implode( ' ', $cat_slugs ) : 'developpement';
					?>
						<div class="boxed left grid-item-p element-item custom-ratio col-lg-4 col-md-4 col-sm-6 portfolios has-post-thumbnail <?php echo esc_attr( $cat_class ); ?>">
							<div class="item--inner" style="background:transparent;border:none;overflow:visible;">
								<a aria-label="<?php echo esc_attr( get_the_title() ); ?>" href="<?php the_permalink(); ?>">
									<?php echo $arrow_svg; ?>
									<figure class="ms-p-img cursor-none" style="position:relative;margin:0;border-radius:32px;overflow:hidden;">
										<?php if ( $thumb_url ) : ?>
											<img alt="<?php echo esc_attr( get_the_title() ); ?>" src="<?php echo esc_url( $thumb_url ); ?>" style="width:100%;height:auto;display:block;" />
										<?php endif; ?>
										<div style="position:absolute;bottom:0;left:0;width:100%;height:75%;background:linear-gradient(to top,rgba(0,0,0,0.85),transparent);pointer-events:none;z-index:1;"></div>
										<div style="position:absolute;bottom:0;left:0;width:100%;padding:30px;z-index:2;display:flex;flex-direction:column;justify-content:flex-end;">
											<h3 style="color:#fff;margin-bottom:5px;font-size:22px;font-weight:600;text-shadow:1px 1px 5px rgba(0,0,0,0.8);line-height:1.2;"><?php the_title(); ?></h3>
											<?php if ( $sous ) : ?>
												<span style="color:#cccccc;font-size:14px;font-weight:500;letter-spacing:0.5px;"><?php echo esc_html( $sous ); ?></span>
											<?php endif; ?>
										</div>
									</figure>
								</a>
							</div>
						</div>
					<?php endwhile; wp_reset_postdata(); endif; ?>
						<div class="grid-sizer col-md-4"></div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
