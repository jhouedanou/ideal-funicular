<?php
/**
 * Single Post Template: Projet Single
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }
        /* Post header synchronization with listing page */
        .ms-hero-internal {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(\'assets/images/ChatGPT Image 23 mars 2026, 16_40_14.png\') no-repeat center center;
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
        }' ); }, 20 );
get_header();
?>
<main class="ms-main ms-single-post" data-scroll-section="">
<!-- Project Header -->
<section class="ms-hero-internal" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url('assets/images/ChatGPT Image 23 mars 2026, 16_40_14.png') no-repeat center center; background-size: cover; padding: 180px 0 120px; text-align: center;">
<div class="container">
<header class="ms-sp--header">
<div class="post-meta-date meta-date-sp" style="color: rgba(255,255,255,0.7) !important;">
<span class="post-author__name"><?php $acf_val = get_field('tude_de_cas'); echo $acf_val ? esc_html($acf_val) : 'Étude de Cas'; ?></span>
</div>
<h1 class="ms-sp--title" style="color: #fff !important; font-size: 52px !important; margin-bottom: 30px !important;"><?php $acf_val = get_field('logic_design_solutions'); echo $acf_val ? esc_html($acf_val) : 'Logic Design Solutions'; ?></h1>
<div class="post-category__list">
<ul class="post-categories">
<li><a href="#" rel="category tag" style="color: #fff !important; border-color: rgba(255,255,255,0.3) !important;"><?php $acf_val = get_field('d_veloppement_sur_mesure'); echo $acf_val ? esc_html($acf_val) : 'Développement sur mesure'; ?></a></li>
</ul>
</div>
</header>
</div>
</section>
<!-- Two Column Layout -->
<section class="project-details-area" style="padding: 100px 0;">
<div class="container">
<div class="row">
<!-- Left Block: Content -->
<div class="col-lg-8 pe-lg-5">
<figure class="media-wrapper media-wrapper--16:9 mb-5">
<img alt="Logic Design Solutions" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/LDSolutions.png" style="width: 100%; height: auto; border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.1);"/>
</figure>
<article class="entry-content" style="max-width: 100%; margin: 0; padding-right: 15px;">
<h3 style="font-size: 32px; font-weight: 700; margin-bottom: 25px;"><?php $acf_val = get_field('le_contexte_du_projet'); echo $acf_val ? esc_html($acf_val) : 'Le Contexte du Projet'; ?></h3>
<p><?php $acf_val = get_field('logic_design_solutions_a'); echo $acf_val ? wp_kses_post($acf_val) : 'Logic Design Solutions, acteur majeur dans l\'ingénierie des systèmes électroniques et embarqués, nous a sollicités pour réaliser une refonte complète de leur infrastructure digitale. Leur site vieillissant ne reflétait plus leur expertise de pointe ni leurs ambitions internationales.'; ?></p>
<h3 style="font-size: 28px; font-weight: 700; margin-top: 40px; margin-bottom: 20px;"><?php $acf_val = get_field('notre_approche_solution'); echo $acf_val ? esc_html($acf_val) : 'Notre Approche &amp; Solution'; ?></h3>
<p><?php $acf_val = get_field('nous_avons_opt_pour_une'); echo $acf_val ? wp_kses_post($acf_val) : 'Nous avons opté pour une approche centrée sur la performance et l\'expérience utilisateur (UX). Le défi consistait à présenter des concepts techniques ardus sous un format digeste, moderne et visuellement attrayant pour leurs potentiels clients (B2B).'; ?></p>
<ul style="margin-bottom: 30px; font-size: 18px; line-height: 1.8; color: #333; padding-left: 20px;">
<li style="margin-bottom: 10px;"><strong><?php $acf_val = get_field('architecture'); echo $acf_val ? esc_html($acf_val) : 'Architecture:'; ?></strong> Refonte de la hiérarchie de l'information pour une navigation intuitive.</li>
<li style="margin-bottom: 10px;"><strong><?php $acf_val = get_field('design_ui'); echo $acf_val ? esc_html($acf_val) : 'Design UI:'; ?></strong> Utilisation de codes couleurs tech (bleu profond, blanc) avec des micro-animations discrètes.</li>
<li style="margin-bottom: 10px;"><strong><?php $acf_val = get_field('performance'); echo $acf_val ? esc_html($acf_val) : 'Performance:'; ?></strong> Optimisation drastique des temps de chargement pour un SEO de premier plan.</li>
</ul>
<blockquote style="border-left: 5px solid #ff0000; padding: 30px; background: #f9f9f9; font-style: italic; border-radius: 0 10px 10px 0; margin-bottom: 40px;">
                                "Le nouveau site a propulsé notre image de marque et nous permet d'acquérir de manière fluide des leads hautement qualifiés. L'équipe E-digital a su traduire la complexité de nos métiers en une interface claire."
                            </blockquote>
<h3 style="font-size: 28px; font-weight: 700; margin-bottom: 20px;"><?php $acf_val = get_field('le_r_sultat'); echo $acf_val ? esc_html($acf_val) : 'Le Résultat'; ?></h3>
<p>Une augmentation de <strong><?php $acf_val = get_field('40_de_trafic_organique'); echo $acf_val ? esc_html($acf_val) : '+40% de trafic organique'; ?></strong> dès le premier trimestre suivant le lancement et un taux de rebond divisé par deux. La plateforme est devenue un atout commercial majeur pour l'équipe de LDSolutions !</p>
</article>
</div>
<!-- Right Block: Sidebar Metadata -->
<div class="col-lg-4 mt-5 mt-lg-0">
<div class="project-sidebar" style="background: #ffffff; padding: 40px; border-radius: 24px; box-shadow: 0 20px 50px rgba(0,0,0,0.06); position: sticky; top: 120px;">
<h4 style="font-size: 24px; font-weight: 700; margin-bottom: 30px; border-bottom: 1px solid #eaeaea; padding-bottom: 15px;"><?php $acf_val = get_field('d_tails_du_projet'); echo $acf_val ? esc_html($acf_val) : 'Détails du Projet'; ?></h4>
<div class="sidebar-item" style="margin-bottom: 25px;">
<h5 style="font-size: 14px; text-transform: uppercase; color: #888; font-weight: 600; letter-spacing: 1px; margin-bottom: 8px;"><?php $acf_val = get_field('client'); echo $acf_val ? esc_html($acf_val) : 'Client'; ?></h5>
<p style="font-size: 18px; font-weight: 600; color: #000; margin: 0;"><?php $acf_val = get_field('logic_design_solutions_1'); echo $acf_val ? esc_html($acf_val) : 'Logic Design Solutions'; ?></p>
</div>
<div class="sidebar-item" style="margin-bottom: 25px;">
<h5 style="font-size: 14px; text-transform: uppercase; color: #888; font-weight: 600; letter-spacing: 1px; margin-bottom: 8px;"><?php $acf_val = get_field('cat_gorie'); echo $acf_val ? esc_html($acf_val) : 'Catégorie'; ?></h5>
<p style="font-size: 18px; font-weight: 600; color: #000; margin: 0;"><?php $acf_val = get_field('d_veloppement_ux_ui_desi'); echo $acf_val ? esc_html($acf_val) : 'Développement, UX/UI Design'; ?></p>
</div>
<div class="sidebar-item" style="margin-bottom: 25px;">
<h5 style="font-size: 14px; text-transform: uppercase; color: #888; font-weight: 600; letter-spacing: 1px; margin-bottom: 8px;"><?php $acf_val = get_field('technologies'); echo $acf_val ? esc_html($acf_val) : 'Technologies'; ?></h5>
<p style="font-size: 18px; font-weight: 600; color: #000; margin: 0;"><?php $acf_val = get_field('wordpress_react_css3'); echo $acf_val ? esc_html($acf_val) : 'WordPress, React, CSS3'; ?></p>
</div>
<div class="sidebar-item" style="margin-bottom: 40px;">
<h5 style="font-size: 14px; text-transform: uppercase; color: #888; font-weight: 600; letter-spacing: 1px; margin-bottom: 8px;"><?php $acf_val = get_field('date'); echo $acf_val ? esc_html($acf_val) : 'Date'; ?></h5>
<p style="font-size: 18px; font-weight: 600; color: #000; margin: 0;"><?php $acf_val = get_field('janvier_2024'); echo $acf_val ? esc_html($acf_val) : 'Janvier 2024'; ?></p>
</div>
<a class="ms-btn ms-btn--primary" href="https://e-digital.fr/creation-site-internet/refonte-de-site-internet-pour-lingenierie-en-systemes-electroniques-et-embarques/" style="width: 100%; text-align: center; border-radius: 30px; padding: 15px 30px; background: #ff0000; color: #fff; font-weight: 700; text-transform: uppercase; transition: all 0.3s; display: block; text-decoration: none;" target="_blank">
<div class="ms-btn__text">Voir le Site Live</div>
</a>
</div>
</div>
</div>
</div>
</section>
<!-- Project Navigation -->
<section class="project-nav-area" style="background: #111; padding: 80px 0; margin-top: 50px;">
<div class="container">
<div class="row align-items-center text-center">
<div class="col-12">
<span style="display: block; color: rgba(255,255,255,0.5); font-size: 14px; text-transform: uppercase; tracking: 2px; margin-bottom: 10px;"><?php $acf_val = get_field('projet_suivant'); echo $acf_val ? esc_html($acf_val) : 'Projet Suivant'; ?></span>
<a href="<?php echo esc_url( home_url( '/nos-projets/' ) ); ?>" style="text-decoration: none;">
<h2 onmouseout="this.style.color='#fff'" onmouseover="this.style.color='#ff0000'" style="color: #fff; font-size: 48px; font-weight: 700; margin: 0; transition: color 0.3s;"><?php $acf_val = get_field('quitus_immobilier'); echo $acf_val ? esc_html($acf_val) : 'Quitus Immobilier'; ?></h2>
</a>
</div>
</div>
</div>
</section>
</main>
<!--================= Footer Area Start Here =================-->
<?php get_footer(); 