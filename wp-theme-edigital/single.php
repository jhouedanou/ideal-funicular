<?php
/**
 * Single Post Template: Blog Single
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() {
	wp_add_inline_style( 'edigital-style', '/* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }
        /* Post header synchronization with listing page */
        .ms-hero-internal {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("assets/images/ChatGPT Image 23 mars 2026, 16_40_14.png") no-repeat center center;
            background-size: cover;
            padding: 150px 0 100px;
            text-align: center;
        }
        .main-header.ms-nb--transparent {
            position: absolute !important;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 999;
            background: transparent !important;
            backdrop-filter: none !important;
        }
        .ms-main.ms-single-post {
            margin-top: 0 !important;
        }
        .ms-sp--header {
            text-align: center;
        }
        .ms-sp--title {
            font-weight: 700 !important;
            line-height: 1.2;
            margin-bottom: 20px !important;
        }
        .post-meta-date.meta-date-sp {
            margin-bottom: 20px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .ms-single-post--img {
            margin-top: 60px;
            margin-bottom: 60px;
        }
        .ms-single-post--img img {
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .entry-content {
            max-width: 800px;
            margin: 0 auto;
            font-size: 18px;
            line-height: 1.8;
            color: #333;
        }
        .entry-content h3 {
            font-size: 32px;
            font-weight: 700;
            margin-top: 50px;
            margin-bottom: 25px;
            color: #000;
        }
        .entry-content p {
            margin-bottom: 25px;
        }
        .entry-content blockquote {
            border-left: 5px solid #ff0000;
            padding: 30px;
            background: #f9f9f9;
            font-style: italic;
            margin: 40px 0;
            border-radius: 0 10px 10px 0;
        }
        /* Hide preloader remnants */
        .swiper-pagination-progressbar, .loading-bar, .loader-bar, #loaded {
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
        }
        /* Style for social buttons in footer */
        .social-btn-custom .ms-btn__text {
            color: #000 !important;
            transition: color 0.3s ease !important;
        }
        .social-btn-custom:hover .ms-btn__text {
            color: #fff !important;
        }
        /* Remove underline from footer menu */
        .footer-nav-area li a {
            text-decoration: none !important;
            border-bottom: none !important;
        }
        .footer-nav-area li a::after {
            display: none !important;
        }' );
}, 20 );
get_header();
?>
<main class="ms-main ms-single-post" data-scroll-section="">
<?php while ( have_posts() ) : the_post(); ?>
	<!-- Post Header with Banner Background -->
	<section class="ms-hero-internal">
		<div class="container">
			<header class="ms-sp--header" style="padding-top: 50px !important; padding-bottom: 50px !important;">
				<div class="post-meta-date meta-date-sp" style="color: rgba(255,255,255,0.7) !important;">
					<span class="post-author__name"><?php echo esc_html( get_the_author() ); ?></span>
					<span><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></span>
				</div>
				<h1 class="ms-sp--title" style="color: #fff !important; font-size: 48px !important;"><?php the_title(); ?></h1>
				<?php $cats = get_the_category(); ?>
				<?php if ( ! empty( $cats ) ) : ?>
					<div class="post-category__list">
						<ul class="post-categories">
							<?php foreach ( $cats as $cat ) : ?>
								<li>
									<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" rel="category tag" style="color: #fff !important; border-color: rgba(255,255,255,0.3) !important;">
										<?php echo esc_html( $cat->name ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</header>
		</div>
	</section>

	<!-- Main post image -->
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="ms-single-post--img default container">
		<figure class="media-wrapper media-wrapper--21:9">
			<?php the_post_thumbnail( 'full', array(
				'class' => 'attachment-most-default-post-thumb size-most-default-post-thumb wp-post-image',
				'style' => 'width: 100%; height: auto; object-fit: cover; max-height: 600px;',
			) ); ?>
		</figure>
	</div>
	<?php endif; ?>

	<!-- Article content -->
	<article class="ms-sp--article">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</article>

	<!-- Post Navigation -->
	<?php
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	$blog_url  = get_permalink( (int) get_option( 'page_for_posts' ) );
	if ( ! $blog_url ) {
		$blog_url = home_url( '/blog/' );
	}
	?>
	<nav class="navigation post-navigation mt-100 mb-100" style="max-width: 800px; margin-left: auto !important; margin-right: auto !important; padding: 0 15px;">
		<div class="nav-links row">
			<div class="nav-previous col-6 text-start">
				<?php if ( $prev_post ) : ?>
					<a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>" rel="prev" style="text-decoration: none;">
						<span class="nav-label" style="display: block; color: #747474; font-size: 14px; text-transform: uppercase;"><?php esc_html_e( 'Article précédent', 'edigital' ); ?></span>
						<h4 class="post-title" style="color: #000; font-weight: 700; font-size: 18px;"><?php echo esc_html( get_the_title( $prev_post ) ); ?></h4>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( $blog_url ); ?>" rel="prev" style="text-decoration: none;">
						<span class="nav-label" style="display: block; color: #747474; font-size: 14px; text-transform: uppercase;"><?php esc_html_e( 'Retour au blog', 'edigital' ); ?></span>
						<h4 class="post-title" style="color: #000; font-weight: 700; font-size: 18px;"><?php esc_html_e( 'Voir tous les articles', 'edigital' ); ?></h4>
					</a>
				<?php endif; ?>
			</div>
			<div class="nav-next col-6 text-end">
				<?php if ( $next_post ) : ?>
					<a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>" rel="next" style="text-decoration: none;">
						<span class="nav-label" style="display: block; color: #747474; font-size: 14px; text-transform: uppercase;"><?php esc_html_e( 'Article suivant', 'edigital' ); ?></span>
						<h4 class="post-title" style="color: #000; font-weight: 700; font-size: 18px;"><?php echo esc_html( get_the_title( $next_post ) ); ?></h4>
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( $blog_url ); ?>" rel="next" style="text-decoration: none;">
						<span class="nav-label" style="display: block; color: #747474; font-size: 14px; text-transform: uppercase;"><?php esc_html_e( 'Retour au blog', 'edigital' ); ?></span>
						<h4 class="post-title" style="color: #000; font-weight: 700; font-size: 18px;"><?php esc_html_e( 'Voir tous les articles', 'edigital' ); ?></h4>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</nav>
<?php endwhile; ?>
</main>
<!--================= Footer Area Start Here =================-->
<?php get_footer();