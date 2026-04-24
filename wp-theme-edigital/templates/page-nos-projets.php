<?php
/**
 * Template Name: E-Digital — Nos Projets
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }
        .ms-hero-internal {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(\'assets/images/ChatGPT Image 23 mars 2026, 16_40_14.png\') no-repeat center center;
            background-size: cover;
            padding: 150px 0 100px;
            text-align: center;
        }
        .ms-hero-title {
            color: #fff !important;
            font-size: 60px !important;
            font-weight: 700 !important;
            margin-bottom: 20px !important;
        }
        .ms-hero-subtitle {
            color: #9e9e9e !important;
            font-size: 20px !important;
        }
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 20px;
            justify-content: center;
            list-style: none;
            display: flex;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: "/";
            color: #9e9e9e;
            padding: 0 10px;
        }
        .breadcrumb-item a {
            color: #9e9e9e;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .breadcrumb-item a:hover {
            color: #fff;
        }
        .breadcrumb-item.active {
            color: #fff;
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
        }' ); }, 20 );
get_header();
?>
<main class="ms-main">
<div class="ms-page-content">
<!--================= Banner Area Start =================-->
<section class="ms-hero-internal">
<div class="container">
<div class="ms-hc">
<div class="ms-hc--inner">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a "="" )="" );="" ?="" href="<?php echo esc_url( home_url( "><?php $acf_val = get_field('accueil'); echo $acf_val ? esc_html($acf_val) : '"&gt;Accueil'; ?></a></li>
<li aria-current="page" class="breadcrumb-item active">Nos Projets</li>
</ol>
</nav>
<h1 class="ms-hero-title"><?php $acf_val = get_field('nos_projets'); echo $acf_val ? esc_html($acf_val) : 'Nos Projets'; ?></h1>
<p class="ms-hero-subtitle"><?php $acf_val = get_field('d_couvrez_nos_derni_res_r'); echo $acf_val ? wp_kses_post($acf_val) : 'Découvrez nos dernières réalisations et laissez-vous inspirer pour votre futur projet digital.'; ?></p>
</div>
</div>
</div>
</section>
<!--================= Banner Area End =================-->
<!--================= Projects Area Start =================--><section class="project-area pt-150 pb-100">
<div class="container">
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; margin-top: 50px !important;"><span><?php $acf_val = get_field('agence_digitale_sp_cialis'); echo $acf_val ? wp_kses_post($acf_val) : 'Agence digitale spécialisée dans la conception et le développement de solutions sur mesure.'; ?></span></h2>
</div>
<div class="ms-portfolio-filter-area project main-isotop">
<div class="container">
<div class="filter-nav filter-nav--expanded js-filter-nav"></div>
<!-- Pure Native Filter Buttons -->
<div class="button-group filters-button-group filtr-btn filter-nav__list js-filter-nav__list style-2 text-center" style="margin-bottom: 40px; display: flex; justify-content: center; gap: 15px;">
<button class="button is-checked" data-filter="*">Tous nos projets</button>
<button class="button" data-filter=".design">Design</button>
<button class="button" data-filter=".developpement">Développement</button>
<button class="button" data-filter=".portfolio">Portfolio</button>
</div>
<div class="portfolio_wrap style-3">
<!-- Grid setup ensuring 3 columns without whitespace gaps -->
<div class="row filter portfolio-feed ms-p--d grid-masonary">
<!-- Project 1: Logic Design Solutions -->
<?php $q = new WP_Query(['post_type'=&gt;'projet', 'posts_per_page'=&gt;-1]); if($q-&gt;have_posts()): while($q-&gt;have_posts()): $q-&gt;the_post(); ?><div class="boxed left grid-item-p element-item custom-ratio col-lg-4 col-md-4 col-sm-6 portfolios has-post-thumbnail developpement">
<div class="item--inner" style="background: transparent; border: none; overflow: visible;">
<a "="" )="" );="" ?="" href="<?php the_permalink(); ?>" projet="">" aria-label="Logic Design Solutions"&gt;
                                            <div class="ms-p-arrow" style="z-index: 10;">
<svg class="ms-btt-arrow" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z"></path>
</svg>
</div>
<figure class="ms-p-img cursor-none" style="position: relative; margin: 0; border-radius: 32px; overflow: hidden;">
<img alt="Logic Design Solutions" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?: ''; ?>" style="width: 100%; height: auto; display: block;"/>
<!-- Overlay gradient perfectly masked by border-radius -->
<div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 75%; background: linear-gradient(to top, rgba(0,0,0,0.85), transparent); pointer-events: none; z-index: 1;"></div>
<!-- Title overlay cleanly placed -->
<div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 30px; z-index: 2; display: flex; flex-direction: column; justify-content: flex-end;">
<h3 style="color: #ffffff; margin-bottom: 5px; font-size: 22px; font-weight: 600; text-shadow: 1px 1px 5px rgba(0,0,0,0.8); line-height: 1.2;"><?php the_title(); ?></h3>
<span style="color: #cccccc; font-size: 14px; font-weight: 500; letter-spacing: 0.5px;"><?php echo get_field('sous_titre') ?: 'Projet'; ?></span>
</div>
</figure>
</a>
</div>
</div><?php endwhile; wp_reset_postdata(); endif; ?>
<!-- Project 2: Quitus Immobilier -->

<!-- Project 3: Pouret Medical -->

<!-- Project 4: Ruaud Industries -->

<!-- Project 5: Yvanick conseil -->

<!-- Project 6: Bike service -->

<!-- Project 7: Dupain -->

<!-- Project 8: Fer play -->

<!-- Project 9: Cabinet FAMCHON -->

<!-- Project 10: Maintenance PC Paris -->

<div class="grid-sizer col-md-4"></div>
</div>
</div>
</div>
</div>
</div>
</section>
<!--================= Projects Area End =================-->
<!--================= Ticker Area Start =================-->
<section class="project-area last">
<div class="ms-text-ticker">
<div class="ms-tt-wrap s-d is-inview">
<ul class="ms-tt text-split scrollingText-two">
<li class="ms-tt__text">SITES <span><?php $acf_val = get_field('web'); echo $acf_val ? esc_html($acf_val) : 'WEB'; ?></span> SUR MESURE </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">APPLICATIONS <span><?php $acf_val = get_field('mobiles'); echo $acf_val ? esc_html($acf_val) : 'MOBILES'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">LOGICIELS <span><?php $acf_val = get_field('m_tier'); echo $acf_val ? esc_html($acf_val) : 'MÉTIER'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">SOLUTION <span><?php $acf_val = get_field('smma'); echo $acf_val ? esc_html($acf_val) : 'SMMA'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">SITES <span><?php $acf_val = get_field('e_commerce'); echo $acf_val ? esc_html($acf_val) : 'E-COMMERCE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
<ul class="ms-tt two text-split scrollingText-four">
<li class="ms-tt__text">SEO &amp; <span><?php $acf_val = get_field('strat_gie'); echo $acf_val ? esc_html($acf_val) : 'STRATÉGIE'; ?></span> DIGITALE </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">DESIGN <span><?php $acf_val = get_field('premium'); echo $acf_val ? esc_html($acf_val) : 'PREMIUM'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">ACCOMPAGNEMENT <span><?php $acf_val = get_field('d_di'); echo $acf_val ? esc_html($acf_val) : 'DÉDIÉ'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">INNOVATION <span><?php $acf_val = get_field('tech'); echo $acf_val ? esc_html($acf_val) : 'TECH'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">EXPERTISE <span><?php $acf_val = get_field('web_1'); echo $acf_val ? esc_html($acf_val) : 'WEB'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
</div>
</div>
</section>
<!--================= Ticker Area End =================-->
<!--================= Newsletter Area Start =================-->
<div class="container">
<div class="newsletter-area">
<div class="newsletter-inner">
<h2 class="heading-title"><?php $acf_val = get_field('newsletter'); echo $acf_val ? esc_html($acf_val) : 'Newsletter'; ?></h2>
<div class="form-area">
<form class="mc4wp-form mc4wp-form-116" data-id="116" data-name="Newsletter E-digital" id="mc4wp-form-1" method="post">
<div class="mc4wp-form-fields">
<div class="ms-mc4wp--wrap">
<p>Abonnez-vous pour recevoir nos idées inspirantes,<br/> l'actualité de nos projets et nos innovations quotidiennes.</p>
<div class="ms-mc4wp--action">
<input class="form-control" name="EMAIL" placeholder="Votre adresse e-mail" required="" type="email"/>
<button class="btn btn-default btn--md btn--primary" type="submit">
<span class="ms-btn__text">
<svg class="ms-btt-i" enable-background="new 0 0 96 96" height="96px" version="1.1" viewbox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z"></path>
</svg>
</span>
</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<!--================= Newsletter Area End =================-->
</div>
</main>
<!--================= Footer Area Start Here =================-->
<?php get_footer(); 