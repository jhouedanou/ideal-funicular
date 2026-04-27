<?php
/**
 * Template Name: E-Digital — Blog
 *
 * Migré vers les blocs Gutenberg (Phase 4 du plan de migration).
 * Le hero + l'intro sont édités via les blocs `edigital/*`. La grille
 * des articles reste dynamique : elle est rendue ci-dessous via la
 * boucle WordPress principale + paginate_links().
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$paged    = max( 1, get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ?: 1 ) );
$blog_q   = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => 6,
	'paged'          => $paged,
) );
?>
<main class="ms-main">
	<div class="ms-page-content">
		<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile;
		?>

		<section class="blog-area pb-100">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="ms-posts--wrap">
							<div class="row ms-posts--card">
								<?php if ( $blog_q->have_posts() ) :
									while ( $blog_q->have_posts() ) : $blog_q->the_post();
										$thumb = get_the_post_thumbnail_url( get_the_ID(), 'full' ) ?: '';
										$cats  = get_the_category();
										$cat   = ( $cats && ! is_wp_error( $cats ) ) ? $cats[0]->name : '';
									?>
									<article class="grid-item col-sm-12 col-md-6 post has-post-thumbnail">
										<a aria-label="<?php echo esc_attr( get_the_title() ); ?>" href="<?php the_permalink(); ?>"></a>
										<figure class="ms-posts--card__media">
											<?php if ( $thumb ) : ?>
												<img alt="<?php echo esc_attr( get_the_title() ); ?>" src="<?php echo esc_url( $thumb ); ?>" />
											<?php endif; ?>
										</figure>
										<div class="post-content">
											<div class="post-meta-header">
												<div class="post-header--author">
													<img alt="E-digital" src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png" style="width:20px;" />
													<div class="post-meta__info">
														<span class="post-meta__author">E-digital</span>
														<span class="post-meta__date"><?php echo esc_html( get_the_date() ); ?></span>
													</div>
												</div>
											</div>
											<div class="post-meta-cont">
												<?php if ( $cat ) : ?>
													<div class="post-category">
														<a href="<?php the_permalink(); ?>"><?php echo esc_html( $cat ); ?></a>
													</div>
												<?php endif; ?>
												<div class="post-header">
													<a class="post-title" href="<?php the_permalink(); ?>">
														<h3><?php the_title(); ?></h3>
													</a>
												</div>
											</div>
										</div>
									</article>
								<?php endwhile; wp_reset_postdata(); endif; ?>
							</div>
							<nav aria-label="Pagination" class="pagination" style="margin-top:60px !important;">
								<div class="pagination__list">
									<?php echo paginate_links( array(
										'total'   => $blog_q->max_num_pages,
										'current' => $paged,
									) ); ?>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>
<?php
get_footer();
