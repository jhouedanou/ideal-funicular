<?php
/**
 * Template Name: E-Digital — Accueil
 *
 * Architecture :
 *   - Le hero (slider) est rendu depuis le CPT « slide ».
 *   - Les actualités sont rendues depuis le CPT « actualite ».
 *   - La newsletter reste un module dédié (formulaire AJAX).
 *   - Tout le reste du contenu (intro, marquee, expertise, services,
 *     tarifs, clients…) est édité via les blocs Gutenberg E-Digital
 *     dans l'interface WordPress, puis rendu via the_content().
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_enqueue_scripts', function () {
	wp_add_inline_style( 'edigital-style', '
		html, body {
			height: auto !important;
			overflow: visible !important;
			overflow-x: hidden !important;
			display: block !important;
			position: relative !important;
		}
		.ms-main, .ms-page-content {
			height: auto !important;
			overflow: visible !important;
			position: relative !important;
			display: block !important;
		}
		.banner-horizental {
			position: relative !important;
			height: 100vh !important;
			overflow: hidden !important;
		}
		.social-btn-custom .ms-btn__text { color: #000 !important; transition: color 0.3s ease !important; }
		.social-btn-custom:hover .ms-btn__text { color: #fff !important; }
		.footer-nav-area li a { text-decoration: none !important; border-bottom: none !important; }
		.footer-nav-area li a::after { display: none !important; }
		h3 { font-size: 18px !important; }
		.post-header--author img {
			width: 40px !important; height: 40px !important;
			object-fit: contain !important; border-radius: 50% !important;
		}
		.banner-horizental .swiper-container-h { height: 100vh !important; }
		.banner-horizental .swiper-container-h .swiper-wrapper .swiper-slide .slider-inner {
			background: #000; height: 100vh; position: relative;
		}
		.banner-horizental .swiper-container-h .swiper-wrapper .swiper-slide .slider-inner::after {
			content: ""; position: absolute; width: 101%; height: 100%; top: 0; left: -1px;
			background-color: transparent;
			background-image: radial-gradient(at center right, #FFFFFF00 50%, #00000096 100%);
			z-index: 1;
		}
		.banner-horizental .swiper-container-h .swiper-wrapper .swiper-slide .slider-inner img {
			object-fit: cover; width: 100%; height: 100vh;
		}
		.banner-horizental .swiper-container-h .swiper-wrapper .swiper-slide .slider-inner video {
			object-fit: cover; width: 100%; height: 100%;
		}
		.banner-horizental .swiper-container-h .swiper-button-next,
		.banner-horizental .swiper-container-h .swiper-button-prev {
			top: 50%; height: 85px; width: 85px; line-height: 85px;
			border-radius: 50%; z-index: 100; pointer-events: auto;
		}
		.banner-horizental .swiper-container-h .swiper-button-next::after,
		.banner-horizental .swiper-container-h .swiper-button-prev::after {
			background: none; color: #ffffff; font-size: 30px;
		}
		.banner-horizental .swiper-container-h .swiper-button-next { right: 50px; }
		.banner-horizental .swiper-container-h .swiper-button-prev { left: 50px; }
		@media (max-width: 768px) {
			.banner-horizental .swiper-container-h .swiper-button-next,
			.banner-horizental .swiper-container-h .swiper-button-prev { display: none; }
		}
		.menu-item.active a span {
			border-bottom: 2px solid #ff0000 !important;
			padding-bottom: 5px;
		}
	' );
}, 20 );

get_header();
?>
<main class="ms-main">

	<?php /* --- HERO SLIDER (CPT slide) --- */ ?>
	<div class="banner-horizental">
		<div class="swiper swiper-container-h">
			<div class="swiper-wrapper">
				<?php
				$slides_query = new WP_Query( array(
					'post_type'      => 'slide',
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				) );

				if ( $slides_query->have_posts() ) :
					while ( $slides_query->have_posts() ) : $slides_query->the_post();
						$type_media = get_post_meta( get_the_ID(), 'slide_type_media', true ) ?: 'image';
						$image      = get_post_meta( get_the_ID(), 'slide_image', true );
						$video      = get_post_meta( get_the_ID(), 'slide_video', true );
						$luminosite = get_post_meta( get_the_ID(), 'slide_luminosite', true );
						$luminosite = ( '' !== $luminosite && false !== $luminosite ) ? floatval( $luminosite ) : 0.4;
						$titre      = get_post_meta( get_the_ID(), 'slide_titre', true ) ?: get_the_title();
						$sous_titre = get_post_meta( get_the_ID(), 'slide_sous_titre', true );
						$btn_texte  = get_post_meta( get_the_ID(), 'slide_btn_texte', true );
						$btn_lien   = get_post_meta( get_the_ID(), 'slide_btn_lien', true );

						// Compatibilité : si ACF est actif, on récupère via get_field qui peut renvoyer un array (image/video).
						if ( function_exists( 'get_field' ) ) {
							$image = get_field( 'slide_image' ) ?: $image;
							$video = get_field( 'slide_video' ) ?: $video;
						}

						$brightness = 'filter: brightness(' . esc_attr( $luminosite ) . ');';
				?>
				<div class="swiper-slide">
					<div class="slider-inner">
						<?php if ( 'video' === $type_media && ! empty( $video['url'] ) ) : ?>
						<video autoplay loop muted playsinline preload="auto" style="<?php echo $brightness; ?>">
							<source src="<?php echo esc_url( $video['url'] ); ?>" type="video/mp4" />
						</video>
						<?php elseif ( ! empty( $image['url'] ) ) : ?>
						<img alt="<?php echo esc_attr( $image['alt'] ?: get_the_title() ); ?>"
							src="<?php echo esc_url( $image['url'] ); ?>" style="<?php echo $brightness; ?>" />
						<?php endif; ?>
						<div class="ms-slider--cont ms-material-label swiper-material-animate-scale">
							<div class="ms-cont__inner">
								<h1 class="ms-sc--t" data-splitting>
									<?php echo wp_kses( $titre, array( 'br' => array() ) ); ?>
								</h1>
								<?php if ( $sous_titre ) : ?>
								<p class="ms-sc--text"><?php echo esc_html( $sous_titre ); ?></p>
								<?php endif; ?>
								<?php if ( $btn_texte && $btn_lien ) : ?>
								<div class="ms-cont__btn">
									<a class="btn btn-mokko btn--lg btn--primary" href="<?php echo esc_url( $btn_lien ); ?>">
										<div class="ms-btn__text"><?php echo esc_html( $btn_texte ); ?></div>
									</a>
								</div>
								<?php endif; ?>
								<div class="ms-slider--overlay"></div>
							</div>
						</div>
					</div>
				</div>
				<?php
					endwhile;
					wp_reset_postdata();
				else :
				?>
				<div class="swiper-slide">
					<div class="slider-inner">
						<div class="ms-slider--cont ms-material-label swiper-material-animate-scale">
							<div class="ms-cont__inner">
								<h1 class="ms-sc--t" data-splitting><?php esc_html_e( 'Bienvenue chez E-digital', 'edigital' ); ?></h1>
								<p class="ms-sc--text"><?php esc_html_e( 'Créez vos premières slides dans l\'admin : Slider Hero → Ajouter.', 'edigital' ); ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="swiper-button-wrapper">
				<div aria-label="<?php esc_attr_e( 'Diapositive suivante', 'edigital' ); ?>"
					class="swiper-button-next" role="button" tabindex="0"></div>
				<div aria-label="<?php esc_attr_e( 'Diapositive précédente', 'edigital' ); ?>"
					class="swiper-button-prev" role="button" tabindex="0"></div>
			</div>
		</div>
	</div>

	<?php /* --- CONTENU ÉDITÉ DEPUIS WORDPRESS (blocs Gutenberg E-Digital) --- */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="ms-page-content">
		<?php the_content(); ?>
	</div>
	<?php endwhile; ?>

	<?php /* --- ACTUALITÉS (CPT actualite) --- */ ?>
	<section class="blog-area">
		<div class="blog-inner">
			<div class="row">
				<div class="col-lg-12">
					<div class="ms-ah-wrapper custom-style2">
						<h2 class="content__title hero-title title up-text">
							<?php esc_html_e( 'Actualités E-Digital', 'edigital' ); ?>
						</h2>
					</div>
				</div>
				<div class="col-lg-4"></div>
				<div class="col-lg-8">
					<div class="ms-posts--wrap">
						<div class="row ms-posts--card">
							<?php
							$blog_query = new WP_Query( array(
								'post_type'      => 'actualite',
								'post_status'    => 'publish',
								'posts_per_page' => 4,
								'orderby'        => 'date',
								'order'          => 'DESC',
							) );
							if ( ! $blog_query->have_posts() ) {
								$blog_query = new WP_Query( array(
									'post_type'      => 'post',
									'post_status'    => 'publish',
									'posts_per_page' => 4,
									'orderby'        => 'date',
									'order'          => 'DESC',
								) );
							}
							if ( $blog_query->have_posts() ) :
								while ( $blog_query->have_posts() ) : $blog_query->the_post();
									$categories = ( 'actualite' === get_post_type() )
										? get_the_terms( get_the_ID(), 'actualite_categorie' )
										: get_the_category();
									if ( is_wp_error( $categories ) ) { $categories = array(); }
									$thumb_url  = get_the_post_thumbnail_url( null, 'medium' );
									$avatar_url = get_template_directory_uri() . '/fav-icone.png';
							?>
							<article class="grid-item col-sm-12 col-md-6 col-lg-6 post has-post-thumbnail">
								<a aria-label="<?php echo esc_attr( get_the_title() ); ?>" href="<?php the_permalink(); ?>"></a>
								<figure class="ms-posts--card__media">
									<?php if ( $thumb_url ) : ?>
									<img alt="<?php echo esc_attr( get_the_title() ); ?>" src="<?php echo esc_url( $thumb_url ); ?>" />
									<?php else : ?>
									<img alt="<?php echo esc_attr( get_the_title() ); ?>"
										src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-web-creation.png" />
									<?php endif; ?>
								</figure>
								<div class="post-content">
									<div class="post-meta-header">
										<div class="post-header--author">
											<img alt="E-digital" src="<?php echo esc_url( $avatar_url ); ?>" />
											<div class="post-meta__info">
												<span class="post-meta__author"><?php echo esc_html( get_the_author() ); ?></span>
												<span class="post-meta__date"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></span>
											</div>
										</div>
									</div>
									<div class="post-meta-cont">
										<?php if ( ! empty( $categories ) ) : ?>
										<div class="post-category">
											<?php foreach ( $categories as $cat ) : ?>
											<a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" rel="category tag">
												<?php echo esc_html( $cat->name ); ?>
											</a>
											<?php endforeach; ?>
										</div>
										<?php endif; ?>
										<div class="post-header">
											<a class="post-title" href="<?php the_permalink(); ?>">
												<h3><?php echo esc_html( get_the_title() ); ?></h3>
											</a>
										</div>
									</div>
								</div>
							</article>
							<?php endwhile; wp_reset_postdata(); endif; ?>
						</div>
						<div class="blog-button-area d-flex align-items-center justify-content-start">
							<p><?php esc_html_e( 'Découvrez toutes nos actualités', 'edigital' ); ?></p>
							<img alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/arrow-right.svg" width="24" />
							<?php $archive_actu = get_post_type_archive_link( 'actualite' ) ?: home_url( '/blog/' ); ?>
							<a class="ms-sl" href="<?php echo esc_url( $archive_actu ); ?>" role="button">
								<?php esc_html_e( 'Voir toutes les actualités', 'edigital' ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php /* --- NEWSLETTER --- */ ?>
	<div class="newsletter-area">
		<div class="newsletter-inner">
			<h2 class="heading-title"><?php esc_html_e( 'Newsletter', 'edigital' ); ?></h2>
			<div class="form-area">
				<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
					class="mc4wp-form mc4wp-form-116" data-id="116" data-name="Newsletter E-digital"
					id="mc4wp-form-1" method="post" data-edigital-newsletter>
					<input name="action" type="hidden" value="edigital_newsletter_subscribe" />
					<input name="nonce" type="hidden" value="<?php echo esc_attr( wp_create_nonce( 'edigital_newsletter' ) ); ?>" />
					<input name="form_type" type="hidden" value="newsletter" />
					<div class="mc4wp-form-fields">
						<div class="ms-mc4wp--wrap">
							<p>
								<?php esc_html_e( 'Abonnez-vous pour recevoir nos idées inspirantes,', 'edigital' ); ?><br />
								<?php esc_html_e( 'l\'actualité de nos projets et nos innovations quotidiennes.', 'edigital' ); ?>
							</p>
							<div class="ms-mc4wp--action">
								<input class="form-control" name="email" type="email" required
									placeholder="<?php esc_attr_e( 'Votre adresse e-mail', 'edigital' ); ?>" />
								<button class="btn btn-default btn--md btn--primary" type="submit">
									<span class="ms-btn__text">
										<svg class="ms-btt-i" viewBox="0 0 96 96" width="96" height="96"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z" />
										</svg>
									</span>
								</button>
							</div>
							<p class="edigital-newsletter-feedback" role="status" aria-live="polite"></p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

</main>
<?php get_footer();
