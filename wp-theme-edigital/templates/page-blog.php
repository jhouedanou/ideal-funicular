<?php
/**
 * Template Name: E-Digital — Blog
 *
 * Hero + intro édités via les blocs Gutenberg `edigital/*` (the_content()).
 * La grille des articles + sidebar (« Les plus lus » + Catégories) sont
 * rendus dynamiquement ci-dessous, en 2 colonnes (col-lg-4 + col-lg-8)
 * pour reproduire fidèlement blog.html.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$paged    = max( 1, get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ?: 1 ) );
$blog_q   = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => 6,
	'paged'          => $paged,
) );

// Sur home.php (page des articles), la boucle principale itère sur les
// posts, pas sur la page Blog. On récupère donc explicitement le contenu
// (hero Gutenberg) de la page définie dans Réglages > Lecture.
$blog_page_id = (int) get_option( 'page_for_posts' );
$blog_page    = $blog_page_id ? get_post( $blog_page_id ) : null;
?>
<main class="ms-main">
	<div class="ms-page-content">
		<?php
		if ( $blog_page && ! empty( $blog_page->post_content ) ) {
			echo apply_filters( 'the_content', $blog_page->post_content );
		} elseif ( is_page() ) {
			while ( have_posts() ) : the_post();
				the_content();
			endwhile;
		}
		?>

		<section class="blog-post-area pb-100">
			<div class="container">
				<div class="row">
					<!-- Sidebar : Les plus lus + Catégories -->
					<div class="col-lg-4">
						<?php get_template_part( 'template-parts/blog-sidebar' ); ?>
					</div>

					<!-- Listing des articles -->
					<div class="col-lg-8">
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
								<?php endwhile; wp_reset_postdata();
								else : ?>
									<p style="padding:60px 15px;color:#747474;">
										<?php esc_html_e( 'Aucun article publié pour le moment. Revenez bientôt.', 'edigital' ); ?>
									</p>
								<?php endif; ?>
							</div>
							<?php if ( $blog_q->max_num_pages > 1 ) : ?>
								<nav aria-label="Pagination" class="pagination" style="margin-top:60px !important;">
									<div class="pagination__list">
										<?php echo paginate_links( array(
											'total'   => $blog_q->max_num_pages,
											'current' => $paged,
										) ); ?>
									</div>
								</nav>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php get_template_part( 'template-parts/newsletter-section' ); ?>
	</div>
</main>
<?php
get_footer();
