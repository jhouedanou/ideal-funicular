<?php
/**
 * Template Name: E-Digital — Nos Technologies
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Force allow scrolling on everything */
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
        /* Active menu highlight */
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
        .tech-card {
            background: #fff;
            padding: 40px;
            border-radius: 20px;
            margin-bottom: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .tech-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .tech-card img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 25px;
        }
        .tech-card h3 {
            margin-bottom: 15px;
            color: #000;
        }
        .tech-card p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
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
<li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php $acf_val = get_field('accueil'); echo $acf_val ? esc_html($acf_val) : 'Accueil'; ?></a></li>
<li aria-current="page" class="breadcrumb-item active">Nos Technologies</li>
</ol>
</nav>
<h1 class="ms-hero-title"><?php $acf_val = get_field('nos_technologies'); echo $acf_val ? esc_html($acf_val) : 'Nos Technologies'; ?></h1>
<p class="ms-hero-subtitle"><?php $acf_val = get_field('nous_ma_trisons_les_outil'); echo $acf_val ? wp_kses_post($acf_val) : 'Nous maîtrisons les outils les plus performants pour donner vie à vos projets les plus ambitieux.'; ?></p>
</div>
</div>
</div>
</section>
<!--================= Banner Area End =================-->
<!--================= Tech Grid Start =================-->
<div class="services-area-2 pt-100 pb-100">
<div class="container">
<div class="row">
<!-- Flutter -->
<div class="col-lg-4 col-md-6">
<div class="tech-card">
<img alt="Flutter" src="<?php $acf_img = get_field('img_flutter_original'); echo $acf_img ? esc_url($acf_img) : esc_url('https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg'); ?>"/>
<h3><?php $acf_val = get_field('flutter'); echo $acf_val ? esc_html($acf_val) : 'Flutter'; ?></h3>
<p><?php $acf_val = get_field('d_veloppement_mobile_mult'); echo $acf_val ? wp_kses_post($acf_val) : 'Développement mobile multiplateforme haute performance pour iOS et Android avec un code unique.'; ?></p>
</div>
</div>
<!-- React Native -->
<div class="col-lg-4 col-md-6">
<div class="tech-card">
<img alt="React Native" src="<?php $acf_img = get_field('img_react_original'); echo $acf_img ? esc_url($acf_img) : esc_url('https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg'); ?>"/>
<h3><?php $acf_val = get_field('react_native'); echo $acf_val ? esc_html($acf_val) : 'React Native'; ?></h3>
<p><?php $acf_val = get_field('applications_mobiles_nati'); echo $acf_val ? wp_kses_post($acf_val) : 'Applications mobiles natives puissantes utilisant la flexibilité et la rapidité de React.'; ?></p>
</div>
</div>
<!-- WordPress -->
<div class="col-lg-4 col-md-6">
<div class="tech-card">
<img alt="WordPress" src="<?php $acf_img = get_field('img_wordpress_plain'); echo $acf_img ? esc_url($acf_img) : esc_url('https://cdn.jsdelivr.net/gh/devicons/devicon/icons/wordpress/wordpress-plain.svg'); ?>"/>
<h3><?php $acf_val = get_field('wordpress'); echo $acf_val ? esc_html($acf_val) : 'WordPress'; ?></h3>
<p><?php $acf_val = get_field('cr_ation_de_sites_vitrine'); echo $acf_val ? wp_kses_post($acf_val) : 'Création de sites vitrines et blogs dynamiques, optimisés pour un référencement naturel maximal.'; ?></p>
</div>
</div>
<!-- Prestashop -->
<div class="col-lg-4 col-md-6">
<div class="tech-card">
<img alt="Prestashop" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-ecommerce.png"/> <!-- Placeholder for Prestashop icon -->
<h3><?php $acf_val = get_field('prestashop'); echo $acf_val ? esc_html($acf_val) : 'Prestashop'; ?></h3>
<p><?php $acf_val = get_field('solutions_e_commerce_robu'); echo $acf_val ? wp_kses_post($acf_val) : 'Solutions e-commerce robustes et évolutives pour gérer vos ventes en ligne en toute simplicité.'; ?></p>
</div>
</div>
<!-- Laravel / PHP -->
<div class="col-lg-4 col-md-6">
<div class="tech-card">
<img alt="Laravel" src="<?php $acf_img = get_field('img_laravel_original'); echo $acf_img ? esc_url($acf_img) : esc_url('https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg'); ?>"/>
<h3><?php $acf_val = get_field('laravel'); echo $acf_val ? esc_html($acf_val) : 'Laravel'; ?></h3>
<p><?php $acf_val = get_field('d_veloppement_de_platefor'); echo $acf_val ? wp_kses_post($acf_val) : 'Développement de plateformes web complexes et de logiciels métiers sécurisés sur mesure.'; ?></p>
</div>
</div>
<!-- Python / AI -->
<div class="col-lg-4 col-md-6">
<div class="tech-card">
<img alt="Python &amp; AI" src="<?php $acf_img = get_field('img_python_original'); echo $acf_img ? esc_url($acf_img) : esc_url('https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg'); ?>"/>
<h3><?php $acf_val = get_field('python_ia'); echo $acf_val ? esc_html($acf_val) : 'Python &amp; IA'; ?></h3>
<p><?php $acf_val = get_field('automatisation_intelligen'); echo $acf_val ? wp_kses_post($acf_val) : 'Automatisation intelligente et intégration de solutions d\'intelligence artificielle avancées.'; ?></p>
</div>
</div>
<!-- React / Next.js -->
<div class="col-lg-4 col-md-6">
<div class="tech-card">
<img alt="Next.js" src="<?php $acf_img = get_field('img_nextjs_original'); echo $acf_img ? esc_url($acf_img) : esc_url('https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nextjs/nextjs-original.svg'); ?>"/>
<h3><?php $acf_val = get_field('next_js'); echo $acf_val ? esc_html($acf_val) : 'Next.js'; ?></h3>
<p><?php $acf_val = get_field('interfaces_utilisateur_ul'); echo $acf_val ? wp_kses_post($acf_val) : 'Interfaces utilisateur ultra-rapides et optimisées pour le SEO avec les dernières innovations React.'; ?></p>
</div>
</div>
<!-- Tailwind CSS -->
<div class="col-lg-4 col-md-6">
<div class="tech-card">
<img alt="Tailwind CSS" src="<?php $acf_img = get_field('img_tailwindcss_original'); echo $acf_img ? esc_url($acf_img) : esc_url('https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg'); ?>"/>
<h3><?php $acf_val = get_field('tailwind_css'); echo $acf_val ? esc_html($acf_val) : 'Tailwind CSS'; ?></h3>
<p><?php $acf_val = get_field('design_moderne_r_actif_e'); echo $acf_val ? wp_kses_post($acf_val) : 'Design moderne, réactif et épuré pour une expérience utilisateur exceptionnelle sur tous les écrans.'; ?></p>
</div>
</div>
<!-- Node.js -->
<div class="col-lg-4 col-md-6">
<div class="tech-card">
<img alt="Node.js" src="<?php $acf_img = get_field('img_nodejs_original'); echo $acf_img ? esc_url($acf_img) : esc_url('https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg'); ?>"/>
<h3><?php $acf_val = get_field('node_js'); echo $acf_val ? esc_html($acf_val) : 'Node.js'; ?></h3>
<p><?php $acf_val = get_field('backend_temps_r_el_ultra'); echo $acf_val ? esc_html($acf_val) : 'Backend temps réel ultra-rapide pour des applications web modernes et scalables.'; ?></p>
</div>
</div>
</div>
</div>
</div>
<!--================= Tech Grid End =================-->
</div>
</main>
<!--================= Footer Area Start Here =================-->
<?php get_footer(); 