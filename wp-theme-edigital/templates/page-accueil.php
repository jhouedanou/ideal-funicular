<?php
/**
 * Template Name: E-Digital — Accueil
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
// Les fallbacks ACF sont chargés globalement via /inc/acf-helpers.php.
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Force allow scrolling on everything */
        html,
        body {
            height: auto !important;
            overflow: visible !important;
            overflow-x: hidden !important;
            display: block !important;
            position: relative !important;
        }

        .ms-main,
        .ms-page-content {
            height: auto !important;
            overflow: visible !important;
            position: relative !important;
            display: block !important;
        }

        /* Preserving slider visual aspect but allowing it to flow */
        .banner-horizental {
            position: relative !important;
            height: 100vh !important;
            overflow: hidden !important;
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
        }

        /* Standardize H3 tags to 18px */
        h3 {
            font-size: 18px !important;
        }

        /* Fix author icon size */
        .post-header--author img {
            width: 40px !important;
            height: 40px !important;
            object-fit: contain !important;
            border-radius: 50% !important;
        }

        .banner-horizental .swiper-container-h {
            height: 100vh !important;
        }

        /* Slider visuals */
        .banner-horizental .swiper-container-h .swiper-wrapper .swiper-slide .slider-inner {
            background: #000;
            height: 100vh;
            position: relative;
        }

        .banner-horizental .swiper-container-h .swiper-wrapper .swiper-slide .slider-inner::after {
            content: "";
            position: absolute;
            width: 101%;
            height: 100%;
            top: 0;
            left: -1px;
            background-color: transparent;
            background-image: radial-gradient(at center right, #FFFFFF00 50%, #00000096 100%);
            z-index: 1;
        }

        .banner-horizental .swiper-container-h .swiper-wrapper .swiper-slide .slider-inner img {
            object-fit: cover;
            width: 100%;
            height: 100vh;
        }

        .banner-horizental .swiper-container-h .swiper-wrapper .swiper-slide .slider-inner video {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .banner-horizental .swiper-container-h .swiper-button-next,
        .banner-horizental .swiper-container-h .swiper-button-prev {
            top: 50%;
            height: 85px;
            width: 85px;
            line-height: 85px;
            border-radius: 50%;
            z-index: 100;
            pointer-events: auto;
        }

        .banner-horizental .swiper-container-h .swiper-button-next::after,
        .banner-horizental .swiper-container-h .swiper-button-prev::after {
            background: none;
            color: #ffffff;
            font-size: 30px;
        }

        .banner-horizental .swiper-container-h .swiper-button-next {
            right: 50px;
        }

        .banner-horizental .swiper-container-h .swiper-button-prev {
            left: 50px;
        }

        @media (max-width: 768px) {

            .banner-horizental .swiper-container-h .swiper-button-next,
            .banner-horizental .swiper-container-h .swiper-button-prev {
                display: none;
            }
        }

        /* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }' ); }, 20 );
get_header();
?>
<main class="ms-main">
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
        $type_media  = get_field( 'slide_type_media' ) ?: 'image';
        $image       = get_field( 'slide_image' );
        $video       = get_field( 'slide_video' );
        $luminosite  = get_field( 'slide_luminosite' );
        $luminosite  = ( $luminosite !== '' && $luminosite !== false ) ? floatval( $luminosite ) : 0.4;
        $titre       = get_field( 'slide_titre' ) ?: get_the_title();
        $sous_titre  = get_field( 'slide_sous_titre' );
        $btn_texte   = get_field( 'slide_btn_texte' );
        $btn_lien    = get_field( 'slide_btn_lien' );
        $brightness  = 'filter: brightness(' . esc_attr( $luminosite ) . ');';
?>
<div class="swiper-slide">
<div class="slider-inner">
<?php if ( 'video' === $type_media && ! empty( $video['url'] ) ) : ?>
<video autoplay="" loop="" muted="" playsinline="" preload="auto" style="<?php echo $brightness; ?>">
<source src="<?php echo esc_url( $video['url'] ); ?>" type="video/mp4"/>
</video>
<?php elseif ( ! empty( $image['url'] ) ) : ?>
<img alt="<?php echo esc_attr( $image['alt'] ?: get_the_title() ); ?>" src="<?php echo esc_url( $image['url'] ); ?>" style="<?php echo $brightness; ?>"/>
<?php endif; ?>
<div class="ms-slider--cont ms-material-label swiper-material-animate-scale">
<div class="ms-cont__inner">
<h1 class="ms-sc--t" data-splitting=""><?php echo wp_kses( $titre, array( 'br' => array() ) ); ?></h1>
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
    // Fallback si aucune slide n'est créée
?>
<div class="swiper-slide">
<div class="slider-inner">
<div class="ms-slider--cont ms-material-label swiper-material-animate-scale">
<div class="ms-cont__inner">
<h1 class="ms-sc--t" data-splitting="">Bienvenue chez<br/>E-digital</h1>
<p class="ms-sc--text">Créez vos premières slides dans l'admin : Slider Hero → Ajouter</p>
</div>
</div>
</div>
</div>
<?php endif; ?>
</div>
<div class="swiper-button-wrapper">
<div aria-label="Diapositive suivante" class="swiper-button-next" role="button" tabindex="0">
</div>
<div aria-label="Diapositive précédente" class="swiper-button-prev" role="button" tabindex="0">
</div>
</div>
</div>
</div>
<div class="ms-page-content portfolio-banner" id="services">
<div class="container">
<div class="ms-ah-wrapper">
<h1 class="content__title" data-effect5="" data-scroll="off" data-splitting=""> Agence Digitale<br/>
                        Avant-gardiste</h1>
<h2 class="heading-title"><?php $acf_val = get_field('propos'); echo $acf_val ? esc_html($acf_val) : 'À Propos'; ?></h2>
</div>
</div>
</div>
<?php
$marquee_items = get_field('marquee_images');
if ( $marquee_items ) :
    // Doubler les items pour l'effet infini
    $all_items = array_merge( $marquee_items, $marquee_items );
?>
<div class="marquee-area">
<div class="marquee-inner">
<ul class="marquee">
<?php foreach ( $all_items as $item ) :
    $img = $item['marquee_image'];
    $alt = $item['marquee_alt'] ?: ( $img['alt'] ?? '' );
    if ( ! empty( $img['url'] ) ) : ?>
<li><img alt="<?php echo esc_attr( $alt ); ?>" src="<?php echo esc_url( $img['url'] ); ?>"/></li>
<?php endif; endforeach; ?>
</ul>
</div>
</div>
<?php else : ?>
<div class="marquee-area">
<div class="marquee-inner">
<ul class="marquee">
<li><img alt="Conception Web sur Mesure" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/web-design.png"/></li>
<li><img alt="Développement Mobile" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-mobile-dev.png"/></li>
<li><img alt="Applications Mobiles" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/mobile-app.png"/></li>
<li><img alt="Marketing Digital" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-smma.png"/></li>
<li><img alt="Logiciels Métier" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/logiciel-metier.png"/></li>
<li><img alt="Création de Sites" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-web-creation.png"/></li>
<li><img alt="Applications Spécifiques" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-custom-app.png"/></li>
<li><img alt="E-commerce" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-ecommerce.png"/></li>
</ul>
</div>
</div>
<?php endif; ?>
<div class="project-area">
<div class="container">
<div class="e-con-inner">
<p class="number-tag"><?php $acf_val = get_field('01'); echo $acf_val ? esc_html($acf_val) : '-01'; ?></p>
<h2 class="content__title rts-has-mask-fill"><span><?php $acf_val = get_field('nous_sommes_une_agence_di'); echo $acf_val ? wp_kses_post($acf_val) : 'NOUS SOMMES UNE AGENCE DIGITALE SPÉCIALISÉE DANS
                            LE DÉVELOPPEMENT WEB ET MOBILE AU SERVICE DES TPE/PME DEPUIS 2003.'; ?></span></h2>
</div>
<div class="ms-hero">
<div class="ms-parallax jarallax-img" data-speed="0.7" data-type="scroll">
</div>
<a class="rts-btn popup-video btn-secondary-5-1 mfp-inline" href="#video-popup">
<svg fill="none" height="24" viewbox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
<path d="M5.25 20.9999C5.05109 20.9999 4.86032 20.9209 4.71967 20.7803C4.57902 20.6396 4.5 20.4488 4.5 20.2499V3.74993C4.49999 3.6196 4.53395 3.49151 4.59852 3.37829C4.6631 3.26508 4.75606 3.17065 4.86825 3.1043C4.98044 3.03796 5.10798 3.002 5.2383 2.99997C5.36862 2.99794 5.49722 3.0299 5.61143 3.09271L20.6114 11.3427C20.7291 11.4074 20.8273 11.5026 20.8956 11.6182C20.964 11.7338 21 11.8656 21 11.9999C21 12.1342 20.964 12.266 20.8956 12.3816C20.8273 12.4972 20.7291 12.5924 20.6114 12.6571L5.61143 20.9071C5.50069 20.968 5.37637 20.9999 5.25 20.9999Z" fill="currentColor"></path>
</svg>
</a>
<?php
$popup_video = get_field('video_popup_url');
$popup_video_url = ! empty( $popup_video['url'] ) ? $popup_video['url'] : get_template_directory_uri() . '/assets/images/slider/freepik_create-a-video_seedance_720p_16-9_24fps_3921.mp4';
?>
<div class="mfp-hide" id="video-popup" style="max-width:900px;margin:auto;background:#000;border-radius:16px;overflow:hidden;">
<video autoplay="" controls="" style="width:100%;display:block;">
<source src="<?php echo esc_url( $popup_video_url ); ?>" type="video/mp4"/>
</video>
</div>
</div>
</div>
</div>
<div class="project-area bottom">
<div class="container">
<div class="e-con-inner">
<h2 class="content__title rts-has-mask-fill"><span><?php $acf_val = get_field('agence_digitale_sp_cialis'); echo $acf_val ? wp_kses_post($acf_val) : 'Agence digitale spécialisée dans la conception et le développement de solutions sur mesure.'; ?></span></h2>
<p class="number-tag"><?php $acf_val = get_field('expertise'); echo $acf_val ? esc_html($acf_val) : 'Expertise'; ?></p>
</div>
<div class="portfolio_wrap">
<div class="portfolio-feed ms-p--d row">
<div class="below left grid-item-p custom-ratio col-md-4 portfolios">
<div class="item--inner">
<a aria-label="Conception Web sur Mesure" href="<?php echo esc_url( home_url( '/services/service-creation-web/' ) ); ?>">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<figure class="ms-p-img cursor-none">
<img alt="Conception Web sur Mesure" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/web-design.png"/>
</figure>
<div class="ms-p-content justify-top cursor-none">
<div class="ms-p-content__inner bottom">
<h3><?php $acf_val = get_field('conception_web_sur_mesure'); echo $acf_val ? esc_html($acf_val) : 'Conception Web sur Mesure'; ?></h3>
<span class="ms-p-cat"><?php $acf_val = get_field('sites_web_e_commerce'); echo $acf_val ? esc_html($acf_val) : 'Sites Web &amp; E-commerce'; ?></span>
</div>
</div>
</a>
</div>
</div>
<div class="below left grid-item-p custom-ratio col-md-4 portfolios">
<div class="item--inner">
<a aria-label="Applications Mobiles" href="<?php echo esc_url( home_url( '/services/service-app-metier/' ) ); ?>">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<figure class="ms-p-img cursor-none">
<img alt="Applications Mobiles" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/mobile-app.png"/>
</figure>
<div class="ms-p-content justify-top cursor-none">
<div class="ms-p-content__inner bottom">
<h3><?php $acf_val = get_field('applications_mobiles'); echo $acf_val ? esc_html($acf_val) : 'Applications Mobiles'; ?></h3>
<span class="ms-p-cat"><?php $acf_val = get_field('ios_android'); echo $acf_val ? esc_html($acf_val) : 'iOS &amp; Android'; ?></span>
</div>
</div>
</a>
</div>
</div>
<div class="below left grid-item-p custom-ratio col-md-4 portfolios">
<div class="item--inner">
<a aria-label="Logiciels Métier" href="<?php echo esc_url( home_url( '/services/service-app-metier/' ) ); ?>">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<figure class="ms-p-img cursor-none">
<img alt="Logiciels Métier" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/logiciel-metier.png"/>
</figure>
<div class="ms-p-content justify-top cursor-none">
<div class="ms-p-content__inner bottom">
<h3><?php $acf_val = get_field('logiciels_m_tier'); echo $acf_val ? esc_html($acf_val) : 'Logiciels Métier'; ?></h3>
<span class="ms-p-cat"><?php $acf_val = get_field('crm_erp_solutions'); echo $acf_val ? esc_html($acf_val) : 'CRM, ERP &amp; Solutions'; ?></span>
</div>
</div>
</a>
</div>
</div>
<div class="grid-sizer col-md-4"></div>
</div>
</div>
<div class="btn-wrap">
<a class="btn btn-mokko btn--md" href="<?php echo esc_url( home_url( '/nos-projets/' ) ); ?>" role="button">
<div class="ms-btn--label">
<div class="ms-btn__text">Voir tous les projets</div>
<div class="ms-btn__border"></div>
</div>
</a>
</div>
</div>
</div>
<div class="project-area last">
<div class="ms-text-ticker">
<div class="ms-tt-wrap s-d is-inview">
<ul class="ms-tt text-split scrollingText-two">
<li class="ms-tt__text">SITES <span><?php $acf_val = get_field('web'); echo $acf_val ? esc_html($acf_val) : 'WEB'; ?></span> SUR MESURE </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/>
</li>
<li class="ms-tt__text">APPLICATIONS <span><?php $acf_val = get_field('mobiles'); echo $acf_val ? esc_html($acf_val) : 'MOBILES'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/>
</li>
<li class="ms-tt__text">LOGICIELS <span><?php $acf_val = get_field('m_tier'); echo $acf_val ? esc_html($acf_val) : 'MÉTIER'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/>
</li>
<li class="ms-tt__text">SOLUTION <span><?php $acf_val = get_field('smma'); echo $acf_val ? esc_html($acf_val) : 'SMMA'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/>
</li>
<li class="ms-tt__text">SITES <span><?php $acf_val = get_field('e_commerce'); echo $acf_val ? esc_html($acf_val) : 'E-COMMERCE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/>
</li>
</ul>
<ul class="ms-tt two text-split scrollingText-four">
<li class="ms-tt__text">SEO &amp; <span><?php $acf_val = get_field('strat_gie'); echo $acf_val ? esc_html($acf_val) : 'STRATÉGIE'; ?></span> DIGITALE </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/>
</li>
<li class="ms-tt__text">DESIGN <span><?php $acf_val = get_field('premium'); echo $acf_val ? esc_html($acf_val) : 'PREMIUM'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/>
</li>
<li class="ms-tt__text">ACCOMPAGNEMENT <span><?php $acf_val = get_field('d_di'); echo $acf_val ? esc_html($acf_val) : 'DÉDIÉ'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/>
</li>
<li class="ms-tt__text">INNOVATION <span><?php $acf_val = get_field('tech'); echo $acf_val ? esc_html($acf_val) : 'TECH'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/>
</li>
<li class="ms-tt__text">EXPERTISE <span><?php $acf_val = get_field('web_1'); echo $acf_val ? esc_html($acf_val) : 'WEB'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/>
</li>
</ul>
</div>
</div>
<div class="container">
<div class="e-con-inner">
<h2 class="content__title rts-has-mask-fill"><span><?php $acf_val = get_field('nous_donnons_vie_vos_id'); echo $acf_val ? wp_kses_post($acf_val) : 'Nous donnons vie à vos idées grâce à notre
                            maîtrise des dernières technologies web et mobiles.'; ?></span></h2>
<p class="number-tag"><?php $acf_val = get_field('histoire'); echo $acf_val ? esc_html($acf_val) : 'Histoire'; ?></p>
</div>
<div class="ms-posts--wrap">
<div class="row ms-posts--card">
<?php
// Boucle Actualités (CPT `actualite`) avec repli sur les articles `post`
// si aucune actualité n'a encore été publiée.
$blog_query = new WP_Query( array(
    'post_type'      => 'actualite',
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
if ( ! $blog_query->have_posts() ) {
    $blog_query = new WP_Query( array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 6,
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
        $avatar_url = get_template_directory_uri() . '/assets/images/portfolio/avatar.png';
?>
<article class="grid-item col-sm-12 col-md-6 col-lg-4 post has-post-thumbnail">
<a aria-label="<?php echo esc_attr( get_the_title() ); ?>" href="<?php the_permalink(); ?>"></a>
<figure class="ms-posts--card__media">
<?php if ( $thumb_url ) : ?>
<img alt="<?php echo esc_attr( get_the_title() ); ?>" src="<?php echo esc_url( $thumb_url ); ?>"/>
<?php else : ?>
<img alt="<?php echo esc_attr( get_the_title() ); ?>" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-web-creation.png"/>
<?php endif; ?>
</figure>
<div class="post-content">
<div class="post-meta-header">
<div class="post-header--author">
<img alt="<?php echo esc_attr( get_the_author() ); ?>" src="<?php echo esc_url( $avatar_url ); ?>"/>
<div class="post-meta__info">
<span class="post-meta__author"><?php echo esc_html( get_the_author() ); ?></span>
<span class="post-meta__date"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></span>
</div>
</div>
</div>
<div class="post-meta-cont">
<?php if ( ! empty( $categories ) ) : ?>
<div class="post-category">
<?php foreach ( $categories as $i => $cat ) :
    if ( $i > 0 ) echo ', ';
?>
<?php $cat_link = get_term_link( $cat ); ?>
<a href="<?php echo esc_url( is_wp_error( $cat_link ) ? '#' : $cat_link ); ?>" rel="category tag"><?php echo esc_html( $cat->name ); ?></a>
<?php endforeach; ?>
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
<?php
    endwhile;
    wp_reset_postdata();
endif;
?>
</div>
<div class="btn-wrap">
<?php $archive_actu = get_post_type_archive_link( 'actualite' ) ?: home_url( '/blog/' ); ?>
<a class="btn btn-mokko btn--md" href="<?php echo esc_url( $archive_actu ); ?>" role="button">
<div class="ms-btn--label">
<div class="ms-btn__text">Toutes les actualités</div>
<div class="ms-btn__border"></div>
</div>
</a>
</div>
</div>
</div>
<div class="newsletter-area">
<div class="newsletter-inner">
<h2 class="heading-title"><?php echo esc_html( edigital_field( 'newsletter', __( 'Newsletter', 'edigital' ) ) ); ?></h2>
<div class="form-area">
<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" class="mc4wp-form mc4wp-form-116" data-id="116" data-name="Newsletter E-digital" id="mc4wp-form-1" method="post" data-edigital-newsletter>
<input name="action" type="hidden" value="edigital_newsletter_subscribe"/>
<input name="nonce" type="hidden" value="<?php echo esc_attr( wp_create_nonce( 'edigital_newsletter' ) ); ?>"/>
<input name="form_type" type="hidden" value="newsletter"/>
<div class="mc4wp-form-fields">
<div class="ms-mc4wp--wrap">
<p>Abonnez-vous pour recevoir nos idées inspirantes,<br/> l'actualité de nos
                                            projets et nos innovations quotidiennes.</p>
<div class="ms-mc4wp--action">
<input class="form-control" name="email" placeholder="Votre adresse e-mail" required="" type="email"/>
<button class="btn btn-default btn--md btn--primary" type="submit">
<span class="ms-btn__text">
<svg class="ms-btt-i" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
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
</div>
</div>
<div class="ms-page-content">
<section class="project-area four">
<div class="row">
<div class="col-lg-12">
<div class="ms-ah-wrapper custom-style">
<h2 class="content__title hero-title title up-text"> Notre <br/> Expertise</h2>
</div>
</div>
<div class="col-lg-4"></div>
<div class="col-lg-8">
<div class="portfolio_wrap">
<div class="portfolio-feed ms-p--d row p-0">
<div class="overlay left grid-item-p custom-ratio col-md-4 portfolios has-post-thumbnail">
<div class="item--inner">
<a aria-label="Mélange de style et de savoir-faire" href="<?php echo esc_url( home_url( '/projet/' ) ); ?>">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<figure class="ms-p-img parallax p_b cursor-none">
<img alt="Conception de site vitrine" class="is-inview" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/expertise-vitrine.png"/>
</figure>
<div class="ms-p-content justify-bottom cursor-none">
<div class="ms-p-content__inner bottom align-items-start">
<h3><?php $acf_val = get_field('conception_de_site_vitrin'); echo $acf_val ? esc_html($acf_val) : 'Conception de site vitrine'; ?></h3>
<span class="ms-p-cat"><?php $acf_val = get_field('web_design'); echo $acf_val ? esc_html($acf_val) : 'Web Design'; ?></span>
</div>
</div>
</a>
</div>
</div>
<div class="overlay left grid-item-p custom-ratio col-md-4 portfolios has-post-thumbnail">
<div class="item--inner">
<a aria-label="Réalités abstraites" href="<?php echo esc_url( home_url( '/projet/' ) ); ?>">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<figure class="ms-p-img parallax p_b cursor-none">
<img alt="Développement E-commerce" class="is-inview" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/expertise-ecommerce.png"/>
</figure>
<div class="ms-p-content justify-bottom cursor-none">
<div class="ms-p-content__inner bottom align-items-start">
<h3><?php $acf_val = get_field('d_veloppement_e_commerce'); echo $acf_val ? esc_html($acf_val) : 'Développement E-commerce'; ?></h3>
<span class="ms-p-cat"><?php $acf_val = get_field('e_commerce_2'); echo $acf_val ? esc_html($acf_val) : 'E-commerce'; ?></span>
</div>
</div>
</a>
</div>
</div>
<div class="overlay left grid-item-p custom-ratio col-md-4 portfolios has-post-thumbnail">
<div class="item--inner">
<a aria-label="Palette de la nature" href="<?php echo esc_url( home_url( '/projet/' ) ); ?>">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<figure class="ms-p-img parallax p_b cursor-none">
<img alt="Application Mobile Native" class="is-inview" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/expertise-mobile.png"/>
</figure>
<div class="ms-p-content justify-bottom cursor-none">
<div class="ms-p-content__inner bottom align-items-start">
<h3><?php $acf_val = get_field('application_mobile_native'); echo $acf_val ? esc_html($acf_val) : 'Application Mobile Native'; ?></h3>
<span class="ms-p-cat"><?php $acf_val = get_field('d_veloppement_mobile'); echo $acf_val ? esc_html($acf_val) : 'Développement Mobile'; ?></span>
</div>
</div>
</a>
</div>
</div>
<div class="overlay left grid-item-p custom-ratio col-md-4 portfolios has-post-thumbnail">
<div class="item--inner">
<a aria-label="Portraits de passion" href="<?php echo esc_url( home_url( '/projet/' ) ); ?>">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<figure class="ms-p-img parallax p_b cursor-none">
<img alt="Référencement SEO / SEA" class="is-inview" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/expertise-seo.png"/>
</figure>
<div class="ms-p-content justify-bottom cursor-none">
<div class="ms-p-content__inner bottom align-items-start">
<h3><?php $acf_val = get_field('r_f_rencement_seo_sea'); echo $acf_val ? esc_html($acf_val) : 'Référencement SEO / SEA'; ?></h3>
<span class="ms-p-cat"><?php $acf_val = get_field('marketing_digital'); echo $acf_val ? esc_html($acf_val) : 'Marketing Digital'; ?></span>
</div>
</div>
</a>
</div>
</div>
<div class="overlay left grid-item-p custom-ratio col-md-4 portfolios has-post-thumbnail">
<div class="item--inner">
<a aria-label="Visions cinématographiques" href="<?php echo esc_url( home_url( '/projet/' ) ); ?>">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<figure class="ms-p-img parallax p_b cursor-none">
<img alt="Création d'Identité Visuelle" class="is-inview" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/expertise-branding.png"/>
</figure>
<div class="ms-p-content justify-bottom cursor-none">
<div class="ms-p-content__inner bottom align-items-start">
<h3><?php $acf_val = get_field('cr_ation_d_identit_visue'); echo $acf_val ? esc_html($acf_val) : 'Création d\'Identité Visuelle'; ?></h3>
<span class="ms-p-cat"><?php $acf_val = get_field('branding_design'); echo $acf_val ? esc_html($acf_val) : 'Branding &amp; Design'; ?></span>
</div>
</div>
</a>
</div>
</div>
<div class="overlay left grid-item-p custom-ratio col-md-4 portfolios has-post-thumbnail">
<div class="item--inner">
<a aria-label="Symétrie graphique" href="<?php echo esc_url( home_url( '/projet/' ) ); ?>">
<div class="ms-p-arrow">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z">
</path>
</svg>
</div>
<figure class="ms-p-img parallax p_b cursor-none">
<img alt="Maintenance &amp; Hébergement" class="is-inview" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/expertise-support.png"/>
</figure>
<div class="ms-p-content justify-bottom cursor-none">
<div class="ms-p-content__inner bottom align-items-start">
<h3><?php $acf_val = get_field('maintenance_h_bergement'); echo $acf_val ? esc_html($acf_val) : 'Maintenance &amp; Hébergement'; ?></h3>
<span class="ms-p-cat"><?php $acf_val = get_field('support_technique'); echo $acf_val ? esc_html($acf_val) : 'Support Technique'; ?></span>
</div>
</div>
</a>
</div>
</div>
<div class="grid-sizer col-md-4"></div>
</div>
<div class="portfolio-button-area d-flex align-items-center justify-content-start">
<p><?php $acf_val = get_field('d_couvrez_nos_derni_res_r'); echo $acf_val ? esc_html($acf_val) : 'Découvrez nos dernières réalisations'; ?></p>
<img alt="" class="attachment-full size-full wp-image-4746" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/arrow-right.svg" width="24"/>
<a class="ms-sl" href="<?php echo esc_url( home_url( '/nos-projets/' ) ); ?>" role="button"><?php $acf_val = get_field('voir_tous_les_projets'); echo $acf_val ? esc_html($acf_val) : 'Voir Tous Les Projets'; ?></a>
</div>
</div>
</div>
</div>
</section>
<section class="accordion-area">
<div class="row">
<div class="col-lg-12">
<div class="ms-ah-wrapper custom-style2">
<h2 class="content__title hero-title title up-text"><?php $acf_val = get_field('services'); echo $acf_val ? esc_html($acf_val) : 'Services'; ?></h2>
</div>
</div>
<div class="col-lg-4"></div>
<div class="col-lg-8">
<div class="accordion-container">
<?php
$accordion_items = get_field('accordion_services');
if ( $accordion_items ) :
    foreach ( $accordion_items as $item ) : ?>
<div class="ms_ac_panel">
<div class="ms_ac--label">
<div class="label-title"><?php echo esc_html( strtoupper( $item['accordion_titre'] ) ); ?></div>
<div class="ms_ac--icon rotation">
<div class="accordion_icon--open">
<svg aria-hidden="true" class="e-font-icon-svg e-fas-arrow-down" viewbox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
<path d="M413.1 222.5l22.2 22.2c9.4 9.4 9.4 24.6 0 33.9L241 473c-9.4 9.4-24.6 9.4-33.9 0L12.7 278.6c-9.4-9.4-9.4-24.6 0-33.9l22.2-22.2c9.5-9.5 25-9.3 34.3.4L184 343.4V56c0-13.3 10.7-24 24-24h32c13.3 0 24 10.7 24 24v287.4l114.8-120.5c9.3-9.8 24.8-10 34.3-.4z"></path>
</svg>
</div>
</div>
</div>
<div class="ms_ac--content">
<div class="ms_ac--text">
<?php echo wp_kses_post( $item['accordion_contenu'] ); ?>
</div>
</div>
</div>
<?php endforeach;
else : ?>
<p style="padding:20px;color:#888;">Aucun service configuré. Ajoutez des entrées dans l'accordéon Services depuis l'admin.</p>
<?php endif; ?>
</div>
</div>
</div>
</div>
</section>
<section class="pricing-area" id="tarifs" style="padding: 100px 0; background: #fff;">
<div class="row">
<div class="col-lg-12">
<div class="ms-ah-wrapper custom-style2">
<h2 class="content__title hero-title title up-text"><?php $acf_val = get_field('nos_tarifs'); echo $acf_val ? esc_html($acf_val) : 'NOS TARIFS'; ?></h2>
</div>
</div>
<div class="col-lg-4"></div>
<div class="col-lg-8">
<div class="pricing-cards-wrapper" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-top: 40px;">
<!-- Site Vitrine -->
<div class="pricing-card" style="border: 1px solid #eee; padding: 40px; border-radius: 20px; transition: 0.3s; background: #f9f9f9; display: flex; flex-direction: column; justify-content: space-between;">
<div class="top">
<h4 style="font-size: 1.5rem; margin-bottom: 10px;"><?php $acf_val = get_field('site_vitrine'); echo $acf_val ? esc_html($acf_val) : 'Site Vitrine'; ?></h4>
<p style="color: #666; font-size: 0.9rem;"><?php $acf_val = get_field('id_al_pour_les_tpe_pme_et'); echo $acf_val ? esc_html($acf_val) : 'Idéal pour les TPE/PME et indépendants.'; ?></p>
<div class="price" style="margin: 20px 0; font-size: 2.5rem; font-weight: 700; color: #e31414;">à
                                        partir de 1 200€</div>
</div>
<ul style="list-style: none; padding: 0; margin-bottom: 30px; color: #444; font-size: 0.95rem;">
<li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #e31414; margin-right: 10px;"></i> Design Personnalisé</li>
<li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #e31414; margin-right: 10px;"></i> Optimisé SEO</li>
<li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #e31414; margin-right: 10px;"></i> Responsive Design</li>
</ul>
<a class="btn btn--sm btn--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="text-align: center; display: block; color: #fff !important;"><?php $acf_val = get_field('demander_un'); echo $acf_val ? esc_html($acf_val) : 'Demander un
                                    Devis'; ?></a>
</div>
<!-- Site E-commerce -->
<div class="pricing-card" style="border: 1px solid #eee; padding: 40px; border-radius: 20px; transition: 0.3s; background: #000; color: #fff; display: flex; flex-direction: column; justify-content: space-between;">
<div class="top">
<h4 style="font-size: 1.5rem; margin-bottom: 10px;"><?php $acf_val = get_field('site_e_commerce'); echo $acf_val ? esc_html($acf_val) : 'Site E-commerce'; ?></h4>
<p style="color: #aaa; font-size: 0.9rem;"><?php $acf_val = get_field('votre_boutique_en_ligne_s'); echo $acf_val ? esc_html($acf_val) : 'Votre boutique en ligne sur mesure.'; ?></p>
<div class="price" style="margin: 20px 0; font-size: 2.5rem; font-weight: 700; color: #e31414;">à
                                        partir de 3 500€</div>
</div>
<ul style="list-style: none; padding: 0; margin-bottom: 30px; color: #ddd; font-size: 0.95rem;">
<li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #e31414; margin-right: 10px;"></i> Paiement Sécurisé</li>
<li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #e31414; margin-right: 10px;"></i> Gestion des Stocks</li>
<li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #e31414; margin-right: 10px;"></i> PrestaShop / WooCommerce
                                    </li>
</ul>
<a class="btn btn--sm btn--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="text-align: center; display: block; background: #e31414; border: none; color: #fff !important;"><?php $acf_val = get_field('demander'); echo $acf_val ? esc_html($acf_val) : 'Demander
                                    un Devis'; ?></a>
</div>
<!-- App Mobile -->
<div class="pricing-card" style="border: 1px solid #eee; padding: 40px; border-radius: 20px; transition: 0.3s; background: #f9f9f9; display: flex; flex-direction: column; justify-content: space-between;">
<div class="top">
<h4 style="font-size: 1.5rem; margin-bottom: 10px;"><?php $acf_val = get_field('app_mobile'); echo $acf_val ? esc_html($acf_val) : 'App Mobile'; ?></h4>
<p style="color: #666; font-size: 0.9rem;"><?php $acf_val = get_field('application_native_ios'); echo $acf_val ? esc_html($acf_val) : 'Application Native iOS &amp; Android.'; ?></p>
<div class="price" style="margin: 20px 0; font-size: 2.5rem; font-weight: 700; color: #e31414;">à
                                        partir de 5 000€</div>
</div>
<ul style="list-style: none; padding: 0; margin-bottom: 30px; color: #444; font-size: 0.95rem;">
<li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #e31414; margin-right: 10px;"></i> Haute Performance</li>
<li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #e31414; margin-right: 10px;"></i> UX / UI Premium</li>
<li style="margin-bottom: 10px;"><i class="fas fa-check" style="color: #e31414; margin-right: 10px;"></i> Notification Push</li>
</ul>
<a class="btn btn--sm btn--primary" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="text-align: center; display: block; color: #fff !important;"><?php $acf_val = get_field('demander_un_1'); echo $acf_val ? esc_html($acf_val) : 'Demander un
                                    Devis'; ?></a>
</div>
</div>
<div class="additional-prices" style="margin-top: 50px; padding: 30px; border-radius: 15px; border-left: 5px solid #e31414; background: #fff;">
<div class="row">
<div class="col-md-6">
<p style="font-size: 1.1rem; margin-bottom: 5px; font-weight: 600;"><?php $acf_val = get_field('r_f_rencement'); echo $acf_val ? esc_html($acf_val) : 'Référencement
                                        SEO'; ?></p>
<p style="color: #e31414; font-weight: 700;"><?php $acf_val = get_field('partir_de_500_mois'); echo $acf_val ? esc_html($acf_val) : 'à partir de 500€ / mois'; ?></p>
</div>
<div class="col-md-6">
<p style="font-size: 1.1rem; margin-bottom: 5px; font-weight: 600;"><?php $acf_val = get_field('maintenance'); echo $acf_val ? esc_html($acf_val) : 'Maintenance &amp;
                                        Support'; ?></p>
<p style="color: #e31414; font-weight: 700;"><?php $acf_val = get_field('partir_de_99_mois'); echo $acf_val ? esc_html($acf_val) : 'à partir de 99€ / mois'; ?></p>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="ms-hero four">
<div class="ms-parallax jarallax-img" data-speed="0.7" data-type="scroll" style="background-image: url(assets/images/portfolio/createurs-bg.png);">
</div>
<div class="ms-hc">
<div class="ms-hc--inner">
<h2 class="ms-hero-title">Créateurs d'expériences<br/> digitales depuis 2003</h2>
</div>
</div>
</section>
<section class="blog-area">
<div class="blog-inner">
<div class="row">
<div class="col-lg-12">
<div class="ms-ah-wrapper custom-style2">
<h2 class="content__title hero-title title up-text"><?php $acf_val = get_field('actualit_s_e_digital'); echo $acf_val ? esc_html($acf_val) : 'ACTUALITÉS E-DIGITAL'; ?></h2>
</div>
</div>
<div class="col-lg-4"></div>
<div class="col-lg-8">
<div class="ms-posts--wrap">
<div class="row ms-posts--card">
<article class="grid-item col-sm-12 col-md-6 col-lg-6 post has-post-thumbnail">
<a aria-label="Visualizing Data: A Deep Dive into AI" href="<?php echo esc_url( home_url( '/blog-single/' ) ); ?>"></a>
<figure class="ms-posts--card__media">
<img alt="Développement d'applications mobiles" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-mobile.png"/>
</figure>
<div class="post-content">
<div class="post-meta-header">
<div class="post-header--author">
<img alt="E-digital" src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png"/>
<div class="post-meta__info">
<span class="post-meta__author"><?php $acf_val = get_field('e_digital_6'); echo $acf_val ? esc_html($acf_val) : 'E-digital'; ?></span>
<span class="post-meta__date"><?php $acf_val = get_field('04_07_2024_1'); echo $acf_val ? esc_html($acf_val) : '04.07.2024'; ?></span>
</div>
</div>
</div>
<div class="post-meta-cont">
<div class="post-category">
<a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" rel="category tag"><?php $acf_val = get_field('technology'); echo $acf_val ? esc_html($acf_val) : 'Technology'; ?></a>
</div>
<div class="post-header">
<a class="post-title" href="#">
<h3><?php $acf_val = get_field('d_veloppement_d_applicati_1'); echo $acf_val ? wp_kses_post($acf_val) : 'Développement d\'applications mobiles à Paris et Guyancourt
                                                            📱✨'; ?></h3>
</a>
</div>
</div>
</div>
</article>
<article class="grid-item col-sm-12 col-md-6 col-lg-6 post has-post-thumbnail">
<a aria-label="Why AI Is Perspective" href="<?php echo esc_url( home_url( '/blog-single/' ) ); ?>"></a>
<figure class="ms-posts--card__media">
<img alt="Agence Marketing des Médias Sociaux" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-marketing.png"/>
</figure>
<div class="post-content">
<div class="post-meta-header">
<div class="post-header--author">
<img alt="E-digital" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png"/>
<div class="post-meta__info">
<span class="post-meta__author"><?php $acf_val = get_field('e_digital_7'); echo $acf_val ? esc_html($acf_val) : 'E-digital'; ?></span>
<span class="post-meta__date"><?php $acf_val = get_field('27_01_2026_1'); echo $acf_val ? esc_html($acf_val) : '27.01.2026'; ?></span>
</div>
</div>
</div>
<div class="post-meta-cont">
<div class="post-category">
<a href="#" rel="category tag"><?php $acf_val = get_field('strat_gie_4'); echo $acf_val ? esc_html($acf_val) : 'Stratégie'; ?></a>
</div>
<div class="post-header">
<a class="post-title" href="#">
<h3><?php $acf_val = get_field('agence_marketing_des_m_di_1'); echo $acf_val ? esc_html($acf_val) : 'Agence Marketing des Médias Sociaux'; ?></h3>
</a>
</div>
</div>
</div>
</article>
<article class="grid-item col-sm-12 col-md-6 col-lg-6 post has-post-thumbnail">
<a aria-label="A Day in the Life of a Photographer" href="<?php echo esc_url( home_url( '/blog-single/' ) ); ?>"></a>
<figure class="ms-posts--card__media">
<img alt="Création de Site Internet" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-design.png"/>
</figure>
<div class="post-content">
<div class="post-meta-header">
<div class="post-header--author">
<img alt="E-digital" src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png"/>
<div class="post-meta__info">
<span class="post-meta__author"><?php $acf_val = get_field('e_digital_8'); echo $acf_val ? esc_html($acf_val) : 'E-digital'; ?></span>
<span class="post-meta__date"><?php $acf_val = get_field('07_01_2026_1'); echo $acf_val ? esc_html($acf_val) : '07.01.2026'; ?></span>
</div>
</div>
</div>
<div class="post-meta-cont">
<div class="post-category">
<a href="#" rel="category tag"><?php $acf_val = get_field('design_2'); echo $acf_val ? esc_html($acf_val) : 'Design'; ?></a>
</div>
<div class="post-header">
<a class="post-title" href="#">
<h3><?php $acf_val = get_field('cr_ation_de_site_internet_1'); echo $acf_val ? wp_kses_post($acf_val) : 'Création de Site Internet à Guyancourt : Donnez Vie à Vos
                                                            Idées'; ?></h3>
</a>
</div>
</div>
</div>
</article>
<article class="grid-item col-sm-12 col-md-6 col-lg-6 post has-post-thumbnail">
<a aria-label="My Take on the Future of AI" href="<?php echo esc_url( home_url( '/blog-single/' ) ); ?>"></a>
<figure class="ms-posts--card__media">
<img alt="Création Application Spécifique" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-software.png"/>
</figure>
<div class="post-content">
<div class="post-meta-header">
<div class="post-header--author">
<img alt="E-digital" src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png"/>
<div class="post-meta__info">
<span class="post-meta__author"><?php $acf_val = get_field('e_digital_9'); echo $acf_val ? esc_html($acf_val) : 'E-digital'; ?></span>
<span class="post-meta__date"><?php $acf_val = get_field('03_03_2025_1'); echo $acf_val ? esc_html($acf_val) : '03.03.2025'; ?></span>
</div>
</div>
</div>
<div class="post-meta-cont">
<div class="post-category">
<a href="#" rel="category tag"><?php $acf_val = get_field('d_veloppement_1'); echo $acf_val ? esc_html($acf_val) : 'Développement'; ?></a>
</div>
<div class="post-header">
<a class="post-title" href="#">
<h3><?php $acf_val = get_field('cr_ation_application_sp_c_1'); echo $acf_val ? esc_html($acf_val) : 'Création Application Spécifique'; ?></h3>
</a>
</div>
</div>
</div>
</article>
</div>
<div class="blog-button-area d-flex align-items-center justify-content-start">
<p><?php $acf_val = get_field('d_couvrez_toutes_nos_r_al'); echo $acf_val ? esc_html($acf_val) : 'Découvrez toutes nos réalisations'; ?></p>
<img alt="" class="attachment-full size-full wp-image-4746" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/arrow-right.svg" width="24"/>
<a class="ms-sl" href="<?php echo esc_url( home_url( '/nos-projets/' ) ); ?>" role="button"><?php $acf_val = get_field('voir_tous_les_projets_1'); echo $acf_val ? esc_html($acf_val) : 'Voir tous les projets'; ?></a>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</main>
<section class="client-area">
<div class="client-bg-area ms-parallax jarallax-img" data-speed="0.7" data-type="scroll" style="background-image: url(assets/images/clients/client-bg.webp);">
<div class="container">
<h2 class="heading-title text-center">Ils nous font<br/> confiance.</h2>
<div class="client-logo-area">
<div class="row align-items-center justify-content-center">
<div class="col-lg-4 col-md-6 col-sm-6 mb-5">
<div class="text-area">
<h4 class="text-center" style="color: #9e9e9e; font-size: 38px; font-family: 'Cinzel', serif; letter-spacing: 2px;"><?php $acf_val = get_field('total_ci'); echo $acf_val ? esc_html($acf_val) : 'TOTAL CI'; ?></h4>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 mb-5">
<div class="text-area">
<h4 class="text-center" style="color: #9e9e9e; font-size: 40px; font-family: 'Playfair Display', serif; font-style: italic;"><?php $acf_val = get_field('yves_rocher'); echo $acf_val ? esc_html($acf_val) : 'Yves Rocher'; ?></h4>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 mb-5">
<div class="text-area">
<h4 class="text-center" style="color: #9e9e9e; font-size: 42px; font-family: 'Caveat', cursive;"><?php $acf_val = get_field('raufils'); echo $acf_val ? esc_html($acf_val) : 'Raufils
                                    Assurance'; ?></h4>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 mb-5">
<div class="text-area">
<h4 class="text-center" style="color: #9e9e9e; font-size: 44px; font-family: 'Oswald', sans-serif; text-transform: uppercase;"><?php $acf_val = get_field('ordisud'); echo $acf_val ? esc_html($acf_val) : 'ORDISUD'; ?></h4>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 mb-5">
<div class="text-area">
<h4 class="text-center" style="color: #9e9e9e; font-size: 34px; font-family: 'Dancing Script', cursive;"><?php $acf_val = get_field('quitus_immobilier'); echo $acf_val ? esc_html($acf_val) : 'Quitus Immobilier'; ?></h4>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 mb-5">
<div class="text-area">
<h4 class="text-center" style="color: #9e9e9e; font-size: 36px; font-family: 'Unbounded', sans-serif; letter-spacing: 1px;"><?php $acf_val = get_field('ordea'); echo $acf_val ? esc_html($acf_val) : 'ORDEA'; ?></h4>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 mb-5">
<div class="text-area">
<h4 class="text-center" style="color: #9e9e9e; font-size: 34px; font-family: 'Montserrat', sans-serif; font-weight: 900;"><?php $acf_val = get_field('cabinet_famchon'); echo $acf_val ? esc_html($acf_val) : 'Cabinet Famchon'; ?></h4>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<?php get_footer(); 