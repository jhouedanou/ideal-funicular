<?php
/**
 * Template Name: E-Digital — Blog
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }
        .ms-hero-internal {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(\'assets/images/hero-blog.png\') no-repeat center center;
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
        }
        .blog-post-area {
            padding-top: 100px;
            padding-bottom: 100px;
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
<li aria-current="page" class="breadcrumb-item active">Blog</li>
</ol>
</nav>
<h1 class="ms-hero-title"><?php $acf_val = get_field('notre_blog'); echo $acf_val ? esc_html($acf_val) : 'Notre Blog'; ?></h1>
<p class="ms-hero-subtitle"><?php $acf_val = get_field('actualit_s_conseils_et_t'); echo $acf_val ? wp_kses_post($acf_val) : 'Actualités, conseils et tendances du monde digital pour propulser votre activité.'; ?></p>
</div>
</div>
</div>
</section>
<!--================= Banner Area End =================-->
<!--================= Blog Area Start =================-->
<section class="blog-post-area">
<div class="container">
<div class="row">
<!-- Left Block: Most Read / Recent -->
<div class="col-lg-4">
<div class="ms-sidebar">
<aside class="ms_widget_recent_posts mb-50">
<h4 class="mb-30" style="font-weight: 700; text-transform: uppercase;"><?php $acf_val = get_field('les_plus_lus'); echo $acf_val ? esc_html($acf_val) : 'Les plus lus'; ?></h4>
<ul class="recent-post-list" style="list-style: none; padding: 0;">
<!-- Recent Post 1 -->
<li class="mb-20" style="display: flex; gap: 15px; align-items: flex-start;">
<img alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-mobile-dev.png" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;"/>
<div>
<a "="" )="" );="" ?="" blog-single="" href="<?php echo esc_url( home_url( "><?php $acf_val = get_field('style_text_decoration'); echo $acf_val ? wp_kses_post($acf_val) : '" style="text-decoration: none; color: #000; font-weight: 600; display: block; line-height: 1.2;"&gt;Développement mobile : Les tendances 2024'; ?></a>
<div style="font-size: 13px; color: #747474; margin-top: 5px; display: flex; align-items: center; gap: 10px;">
<span><?php $acf_val = get_field('04_07_2024'); echo $acf_val ? esc_html($acf_val) : '04.07.2024'; ?></span>
<span><i class="far fa-eye"></i> 1.2k vues</span>
</div>
</div>
</li>
<!-- Recent Post 2 -->
<li class="mb-20" style="display: flex; gap: 15px; align-items: flex-start;">
<img alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-smma.png" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;"/>
<div>
<a "="" )="" );="" ?="" blog-single="" href="<?php echo esc_url( home_url( "><?php $acf_val = get_field('style_text_decoration_1'); echo $acf_val ? wp_kses_post($acf_val) : '" style="text-decoration: none; color: #000; font-weight: 600; display: block; line-height: 1.2;"&gt;Pourquoi le SMMA est indispensable'; ?></a>
<div style="font-size: 13px; color: #747474; margin-top: 5px; display: flex; align-items: center; gap: 10px;">
<span><?php $acf_val = get_field('27_01_2026'); echo $acf_val ? esc_html($acf_val) : '27.01.2026'; ?></span>
<span><i class="far fa-eye"></i> 856 vues</span>
</div>
</div>
</li>
<!-- Recent Post 3 -->
<li class="mb-20" style="display: flex; gap: 15px; align-items: flex-start;">
<img alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-strategy.png" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;"/>
<div>
<a "="" )="" );="" ?="" blog-single="" href="<?php echo esc_url( home_url( "><?php $acf_val = get_field('style_text_decoration_2'); echo $acf_val ? wp_kses_post($acf_val) : '" style="text-decoration: none; color: #000; font-weight: 600; display: block; line-height: 1.2;"&gt;SEO : Dominer les résultats de recherche'; ?></a>
<div style="font-size: 13px; color: #747474; margin-top: 5px; display: flex; align-items: center; gap: 10px;">
<span><?php $acf_val = get_field('05_05_2024'); echo $acf_val ? esc_html($acf_val) : '05.05.2024'; ?></span>
<span><i class="far fa-eye"></i> 2.4k vues</span>
</div>
</div>
</li>
</ul>
</aside>
<aside class="widget_categories mb-50">
<h4 class="mb-30" style="font-weight: 700; text-transform: uppercase;"><?php $acf_val = get_field('cat_gories'); echo $acf_val ? esc_html($acf_val) : 'Catégories'; ?></h4>
<ul style="list-style: none; padding: 0;">
<li class="mb-10"><a href="#" style="text-decoration: none; color: #000; display: flex; justify-content: space-between;">Design <span><?php $acf_val = get_field('12'); echo $acf_val ? esc_html($acf_val) : '(12)'; ?></span></a></li>
<li class="mb-10"><a href="#" style="text-decoration: none; color: #000; display: flex; justify-content: space-between;">Technologie <span><?php $acf_val = get_field('8'); echo $acf_val ? esc_html($acf_val) : '(8)'; ?></span></a></li>
<li class="mb-10"><a href="#" style="text-decoration: none; color: #000; display: flex; justify-content: space-between;">E-commerce <span><?php $acf_val = get_field('15'); echo $acf_val ? esc_html($acf_val) : '(15)'; ?></span></a></li>
<li class="mb-10"><a href="#" style="text-decoration: none; color: #000; display: flex; justify-content: space-between;">Stratégie <span><?php $acf_val = get_field('20'); echo $acf_val ? esc_html($acf_val) : '(20)'; ?></span></a></li>
</ul>
</aside>
</div>
</div>
<!-- Right Block: Blog Listing -->
<div class="col-lg-8">
<div class="ms-posts--wrap">
<div class="row ms-posts--card">
<!-- Article 1 -->
<?php if(have_posts()): while(have_posts()): the_post(); ?><article class="grid-item col-sm-12 col-md-6 post has-post-thumbnail">
<a "="" )="" );="" ?="" blog-single="" href="<?php the_permalink(); ?>"><?php $acf_val = get_field('aria_label_d_veloppeme'); echo $acf_val ? esc_html($acf_val) : '" aria-label="Développement Mobile"&gt;'; ?></a>
<figure class="ms-posts--card__media">
<img alt="Développement Mobile" src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full') ?: ''; ?>"/>
</figure>
<div class="post-content">
<div class="post-meta-header">
<div class="post-header--author">
<img alt="E-digital" src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png" style="width: 20px;"/>
<div class="post-meta__info">
<span class="post-meta__author"><?php $acf_val = get_field('e_digital'); echo $acf_val ? esc_html($acf_val) : 'E-digital'; ?></span>
<span class="post-meta__date"><?php $acf_val = get_field('04_07_2024_1'); echo $acf_val ? esc_html($acf_val) : '04.07.2024'; ?></span>
</div>
</div>
</div>
<div class="post-meta-cont">
<div class="post-category">
<a href="<?php the_permalink(); ?>"><?php $acf_val = get_field('technologie'); echo $acf_val ? esc_html($acf_val) : 'Technologie'; ?></a>
</div>
<div class="post-header">
<a "="" )="" );="" ?="" blog-single="" class="post-title" href="<?php the_permalink(); ?>">"&gt;
                                                        <h3><?php the_title(); ?></h3>
</a>
</div>
</div>
</div>
</article><?php endwhile; endif; ?>
<!-- Article 2 -->

<!-- Article 3 -->

<!-- Article 4 -->

<!-- Article 5 -->

<!-- Article 6 -->

</div>
<!-- Pagination -->
<nav aria-label="Pagination" class="pagination" style="margin-top: 100px !important;">
<ol class="pagination__list">
<li class="page-item active"><a class="pagination__item" href="#">1</a></li>
<li><a class="pagination__item" href="#">2</a></li>
<li><a class="pagination__item" href="#">3</a></li>
<li class="page-item next"><a href="#"><?php $acf_val = get_field('suivant'); echo $acf_val ? esc_html($acf_val) : 'Suivant'; ?></a></li>
</ol>
</nav>
</div>
</div>
</div>
</div>
</section>
<!--================= Blog Area End =================-->
<!--================= Newsletter Area Start =================-->
<div class="container pb-100">
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