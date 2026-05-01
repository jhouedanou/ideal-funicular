<?php
/**
 * Sidebar du blog — widgets « Les plus lus » + « Catégories ».
 *
 * Inclus via : get_template_part( 'template-parts/blog-sidebar' );
 *
 * Reproduit fidèlement la sidebar de blog.html (col-lg-4) :
 *   - Recent posts (3 articles les plus récents)
 *   - Catégories (avec compte d'articles)
 *
 * @package EDigital
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$recent = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'no_found_rows'  => true,
) );

$categories = get_categories( array(
	'orderby' => 'count',
	'order'   => 'DESC',
	'hide_empty' => true,
) );
?>
<div class="ms-sidebar">
	<aside class="ms_widget_recent_posts mb-50">
		<h4 class="mb-30" style="font-weight: 700; text-transform: uppercase;">
			<?php esc_html_e( 'Les plus lus', 'edigital' ); ?>
		</h4>
		<?php if ( $recent->have_posts() ) : ?>
			<ul class="recent-post-list" style="list-style: none; padding: 0;">
				<?php while ( $recent->have_posts() ) : $recent->the_post();
					$thumb = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
				?>
					<li class="mb-20" style="display: flex; gap: 15px; align-items: flex-start;">
						<?php if ( $thumb ) : ?>
							<img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>"
								style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
						<?php endif; ?>
						<div>
							<a href="<?php the_permalink(); ?>"
								style="text-decoration: none; color: #000; font-weight: 600; display: block; line-height: 1.2;">
								<?php the_title(); ?>
							</a>
							<div style="font-size: 13px; color: #747474; margin-top: 5px; display: flex; align-items: center; gap: 10px;">
								<span><?php echo esc_html( get_the_date() ); ?></span>
							</div>
						</div>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php else : ?>
			<p style="color:#747474;">
				<?php esc_html_e( 'Aucun article publié pour le moment.', 'edigital' ); ?>
			</p>
		<?php endif;
		wp_reset_postdata();
		?>
	</aside>

	<aside class="widget_categories mb-50">
		<h4 class="mb-30" style="font-weight: 700; text-transform: uppercase;">
			<?php esc_html_e( 'Catégories', 'edigital' ); ?>
		</h4>
		<?php if ( ! empty( $categories ) ) : ?>
			<ul style="list-style: none; padding: 0;">
				<?php foreach ( $categories as $cat ) : ?>
					<li class="mb-10">
						<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
							style="text-decoration: none; color: #000; display: flex; justify-content: space-between;">
							<?php echo esc_html( $cat->name ); ?>
							<span>(<?php echo (int) $cat->count; ?>)</span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<p style="color:#747474;">
				<?php esc_html_e( 'Aucune catégorie.', 'edigital' ); ?>
			</p>
		<?php endif; ?>
	</aside>
</div>
