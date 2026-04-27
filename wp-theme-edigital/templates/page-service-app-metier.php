<?php
/**
 * Template Name: E-Digital — Applications Métier
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }
        /* Hero - personnalisée App Métier */
        .ms-hero-internal {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(\'assets/images/hero-app-metier.png\') no-repeat center center;
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

        /* ===== Service Text Cards ===== */
        .service-text-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            margin-top: 60px;
        }
        .service-text-card {
            background: #f8f8f8;
            border-left: 4px solid #e31414;
            padding: 40px 32px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .service-text-card:hover {
            box-shadow: 0 12px 40px rgba(0,0,0,0.10);
            transform: translateY(-4px);
        }
        [data-theme="dark"] .service-text-card {
            background: #1a1a1a;
        }
        .service-text-card .stc-icon {
            font-size: 2rem;
            color: #e31414;
            margin-bottom: 18px;
        }
        .service-text-card .stc-tag {
            display: inline-block;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #e31414;
            margin-bottom: 12px;
        }
        .service-text-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 14px;
            line-height: 1.3;
        }
        .service-text-card p {
            font-size: 0.97rem;
            line-height: 1.75;
            color: #666;
            margin: 0;
        }
        [data-theme="dark"] .service-text-card p {
            color: #aaa;
        }
        @media (max-width: 991px) {
            .service-text-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 575px) {
            .service-text-grid { grid-template-columns: 1fr; }
        }' ); }, 20 );
get_header();
?>
<main class="ms-main">
<div class="ms-page-content">
<!--================= Hero Banner =================-->
<section class="ms-hero-internal">
<div class="container">
<div class="ms-hc">
<div class="ms-hc--inner">
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php $acf_val = get_field('accueil'); echo $acf_val ? esc_html($acf_val) : 'Accueil'; ?></a></li>
<li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php $acf_val = get_field('services'); echo $acf_val ? esc_html($acf_val) : 'Services'; ?></a></li>
<li aria-current="page" class="breadcrumb-item active">Application Métier</li>
</ol>
</nav>
<h1 class="ms-hero-title" style="font-size: 50px !important; margin-bottom: 30px !important; text-transform: none !important;">Applications Métier :<br/>L’outil sur-mesure pour votre performance</h1>
<p class="ms-hero-subtitle" style="max-width: 900px; margin: 0 auto; line-height: 1.6;"><?php $acf_val = get_field('vos_processus_internes_so'); echo $acf_val ? wp_kses_post($acf_val) : 'Vos processus internes sont ralentis par des fichiers Excel complexes ou des logiciels rigides ? Pour franchir un cap, votre entreprise a besoin d\'outils qui s\'adaptent à votre manière de travailler, et non l\'inverse.'; ?></p>
</div>
</div>
</div>
</section>
<!--================= Hero Banner End =================-->
<!--================= Services Text Area =================-->
<section class="project-area pt-150 pb-100">
<div class="container">
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; margin-top: 50px !important; text-transform: none !important;"><span><?php $acf_val = get_field('pourquoi_passer_au_sur_me'); echo $acf_val ? esc_html($acf_val) : 'Pourquoi passer au sur-mesure ?'; ?></span></h2>
<p style="font-size: 1.1rem; color: #666; max-width: 800px; margin: 20px auto 30px;"><?php $acf_val = get_field('une_application_m_tier_n'); echo $acf_val ? wp_kses_post($acf_val) : 'Une application métier n\'est pas un gadget, c\'est le moteur de votre productivité :'; ?></p>
</div>
<?php
// Zone éditable Gutenberg : si la page a du contenu saisi dans l'éditeur,
// il prend le pas sur la grille statique ci-dessous.
$page_content = edigital_get_editor_content();
if ( $page_content ) :
?>
<div class="edigital-gutenberg-zone">
<?php echo apply_filters( 'the_content', $page_content ); ?>
</div>
<?php else : ?>
<div class="service-text-grid">
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-cogs"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('productivit'); echo $acf_val ? esc_html($acf_val) : 'Productivité'; ?></span>
<h3><?php $acf_val = get_field('automatisation'); echo $acf_val ? esc_html($acf_val) : 'Automatisation'; ?></h3>
<p><?php $acf_val = get_field('supprimez_les_t_ches_r_p'); echo $acf_val ? esc_html($acf_val) : 'Supprimez les tâches répétitives à faible valeur ajoutée.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-database"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('data'); echo $acf_val ? esc_html($acf_val) : 'Data'; ?></span>
<h3><?php $acf_val = get_field('centralisation'); echo $acf_val ? esc_html($acf_val) : 'Centralisation'; ?></h3>
<p><?php $acf_val = get_field('vos_donn_es_sont_accessib'); echo $acf_val ? esc_html($acf_val) : 'Vos données sont accessibles partout, en temps réel et en toute sécurité.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-tachometer-alt"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('volution'); echo $acf_val ? esc_html($acf_val) : 'Évolution'; ?></span>
<h3><?php $acf_val = get_field('agilit'); echo $acf_val ? esc_html($acf_val) : 'Agilité'; ?></h3>
<p><?php $acf_val = get_field('un_outil_qui_volue_au_ry'); echo $acf_val ? esc_html($acf_val) : 'Un outil qui évolue au rythme de vos besoins et de votre croissance.'; ?></p>
</div>
</div>
<?php endif; ?>
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%; margin-top: 100px;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; text-transform: none !important;"><span><?php $acf_val = get_field('l_expertise_e_digital_fr'); echo $acf_val ? esc_html($acf_val) : 'L’expertise E-Digital.fr'; ?></span></h2>
<p style="font-size: 1.1rem; color: #666; max-width: 800px; margin: 20px auto 30px;">Développer une application efficace demande une compréhension profonde des enjeux business.<br/><br/>Avec plus de dix ans d’expérience, E-Digital conçoit des solutions robustes et intuitives qui transforment votre organisation quotidienne en avantage concurrentiel.</p>
</div>
</div>
</section>
<!--================= Services Text Area End =================-->
<!--================= Ticker Area =================-->
<section class="project-area last">
<div class="ms-text-ticker">
<div class="ms-tt-wrap s-d is-inview">
<ul class="ms-tt text-split scrollingText-two">
<li class="ms-tt__text">APPLICATION <span><?php $acf_val = get_field('m_tier'); echo $acf_val ? esc_html($acf_val) : 'MÉTIER'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">LOGICIEL <span><?php $acf_val = get_field('sur_mesure'); echo $acf_val ? esc_html($acf_val) : 'SUR-MESURE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">PRODUCTIVITÉ <span><?php $acf_val = get_field('maximale'); echo $acf_val ? esc_html($acf_val) : 'MAXIMALE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">AUTOMATISATION <span><?php $acf_val = get_field('web'); echo $acf_val ? esc_html($acf_val) : 'WEB'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
<ul class="ms-tt two text-split scrollingText-four">
<li class="ms-tt__text">PORTAIL <span><?php $acf_val = get_field('client'); echo $acf_val ? esc_html($acf_val) : 'CLIENT'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">DÉVELOPPEMENT <span><?php $acf_val = get_field('agile'); echo $acf_val ? esc_html($acf_val) : 'AGILE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">DIGITALISATION <span><?php $acf_val = get_field('m_tier_1'); echo $acf_val ? esc_html($acf_val) : 'MÉTIER'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">SYSTÈME <span><?php $acf_val = get_field('int_gr'); echo $acf_val ? esc_html($acf_val) : 'INTÉGRÉ'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
</div>
</div>
</section>
<!--================= Ticker End =================-->
<!--================= CTA Section =================-->
<section class="service-cta">
<div class="container">
<h2 style="text-transform: none !important;"><?php $acf_val = get_field('digitalisez_votre_savoir'); echo $acf_val ? esc_html($acf_val) : 'Digitalisez votre savoir-faire'; ?></h2>
<p><?php $acf_val = get_field('ne_laissez_pas_des_outils'); echo $acf_val ? wp_kses_post($acf_val) : 'Ne laissez pas des outils obsolètes brider votre développement. Passons à la vitesse supérieure.'; ?></p>
<a class="btn-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php $acf_val = get_field('discuter_de_mon_projet_d'); echo $acf_val ? esc_html($acf_val) : 'Discuter de mon projet d\'application'; ?></a>
</div>
</section>
<!--================= CTA End =================-->
</div>
</main>
<!--================= Footer =================-->
<?php get_footer(); 