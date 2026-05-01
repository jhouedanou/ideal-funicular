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

	<?php get_template_part( 'template-parts/newsletter-section' ); ?>

</main>
<?php get_footer();
