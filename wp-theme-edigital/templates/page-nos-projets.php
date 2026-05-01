<?php
/**
 * Template Name: E-Digital — Nos Projets
 *
 * Migré vers les blocs Gutenberg (Phase 4 du plan de migration).
 * Le hero + intro + filtres sont édités via les blocs `edigital/*`
 * (`service-hero`, `projets-intro`). La grille des projets reste
 * dynamique : elle est rendue ci-dessous via une boucle WP_Query
 * sur le CPT `projet`.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

// Sur l'archive du CPT `projet` (slug /nos-projets/), have_posts() boucle
// sur les projets — pas sur la page WP. On charge donc explicitement la
// page « nos-projets » pour exposer son contenu Gutenberg.
$nos_projets_page = get_page_by_path( 'nos-projets' );
?>
<main class="ms-main">
	<div class="ms-page-content">
		<?php if ( $nos_projets_page ) : ?>
			<?php echo apply_filters( 'the_content', $nos_projets_page->post_content ); ?>
		<?php else : ?>
			<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
		<?php endif; ?>

		<section class="project-area portfolio-area portfolio-feed-area pb-100">
			<div class="container">
				<div class="portfolio_wrap style-3">
					<div class="row filter portfolio-feed ms-p--d grid-masonary">
						<?php
						$q = new WP_Query( array(
							'post_type'      => 'projet',
							'posts_per_page' => -1,
						) );
						if ( $q->have_posts() ) :
							while ( $q->have_posts() ) : $q->the_post();
								$cat_terms = get_the_terms( get_the_ID(), 'projet_category' );
								$cat_slugs = array();
								if ( $cat_terms && ! is_wp_error( $cat_terms ) ) {
									foreach ( $cat_terms as $term ) {
										$cat_slugs[] = $term->slug;
									}
								}
								$cat_class = ! empty( $cat_slugs ) ? implode( ' ', $cat_slugs ) : 'developpement';
								$thumb     = get_the_post_thumbnail_url( get_the_ID(), 'full' ) ?: '';
								$sous      = function_exists( 'get_field' ) ? get_field( 'sous_titre' ) : '';
								?>
								<div class="boxed left grid-item-p element-item custom-ratio col-lg-4 col-md-4 col-sm-6 portfolios has-post-thumbnail <?php echo esc_attr( $cat_class ); ?>">
									<div class="item--inner" style="background:transparent;border:none;overflow:visible;">
										<a aria-label="<?php echo esc_attr( get_the_title() ); ?>" href="<?php the_permalink(); ?>">
											<figure class="ms-p-img cursor-none" style="position:relative;margin:0;border-radius:32px;overflow:hidden;">
												<?php if ( $thumb ) : ?>
													<img alt="<?php echo esc_attr( get_the_title() ); ?>" src="<?php echo esc_url( $thumb ); ?>" style="width:100%;height:auto;display:block;" />
												<?php endif; ?>
												<div style="position:absolute;bottom:0;left:0;width:100%;height:75%;background:linear-gradient(to top,rgba(0,0,0,0.85),transparent);pointer-events:none;z-index:1;"></div>
												<div style="position:absolute;bottom:0;left:0;width:100%;padding:30px;z-index:2;display:flex;flex-direction:column;justify-content:flex-end;">
													<h3 style="color:#fff;margin-bottom:5px;font-size:22px;font-weight:600;"><?php the_title(); ?></h3>
													<?php if ( $sous ) : ?>
														<span style="color:#ccc;font-size:14px;font-weight:500;letter-spacing:0.5px;"><?php echo esc_html( $sous ); ?></span>
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
		</section>

		<?php get_template_part( 'template-parts/newsletter-section' ); ?>
	</div>
</main>
<?php
get_footer();
