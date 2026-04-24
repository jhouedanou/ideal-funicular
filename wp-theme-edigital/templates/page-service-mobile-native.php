<?php
/**
 * Template Name: E-Digital — Applications Mobiles Natives
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }
        /* Hero - identique à nos-projets.html */
        .ms-hero-internal {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(\'assets/images/service-web-hero.jpg\') no-repeat center center;
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
<li aria-current="page" class="breadcrumb-item active">App Mobile</li>
</ol>
</nav>
<h1 class="ms-hero-title"><?php $acf_val = get_field('applications_mobiles_nati'); echo $acf_val ? esc_html($acf_val) : 'Applications Mobiles Natives'; ?></h1>
<p class="ms-hero-subtitle">Offrez une expérience utilisateur exceptionnelle<br/>sur iOS et Android.</p>
</div>
</div>
</div>
</section>
<!--================= Hero Banner End =================-->
<!--================= Services Text Area =================-->
<section class="project-area pt-150 pb-100">
<div class="container">
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; margin-top: 50px !important;"><span><?php $acf_val = get_field('nous_concevons_des_applic'); echo $acf_val ? wp_kses_post($acf_val) : 'Nous concevons des applications fluides, performantes et intuitives pour engager vos utilisateurs au quotidien.'; ?></span></h2>
</div>
<div class="service-text-grid">
<div class="service-text-card">
<div class="stc-icon"><i class="fab fa-apple"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('app_mobile'); echo $acf_val ? esc_html($acf_val) : 'App Mobile'; ?></span>
<h3><?php $acf_val = get_field('d_veloppement_ios'); echo $acf_val ? esc_html($acf_val) : 'Développement iOS'; ?></h3>
<p><?php $acf_val = get_field('applications_natives_flui'); echo $acf_val ? wp_kses_post($acf_val) : 'Applications natives fluides et performantes développées en Swift pour iPhone et iPad.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fab fa-android"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('app_mobile_1'); echo $acf_val ? esc_html($acf_val) : 'App Mobile'; ?></span>
<h3><?php $acf_val = get_field('d_veloppement_android'); echo $acf_val ? esc_html($acf_val) : 'Développement Android'; ?></h3>
<p><?php $acf_val = get_field('applications_robustes_et'); echo $acf_val ? wp_kses_post($acf_val) : 'Applications robustes et modernes développées en Kotlin pour l\'écosystème Android.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-layer-group"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('app_mobile_2'); echo $acf_val ? esc_html($acf_val) : 'App Mobile'; ?></span>
<h3><?php $acf_val = get_field('multiplateforme'); echo $acf_val ? esc_html($acf_val) : 'Multiplateforme'; ?></h3>
<p><?php $acf_val = get_field('solutions_hybrides_flutt'); echo $acf_val ? wp_kses_post($acf_val) : 'Solutions hybrides (Flutter/React Native) pour un déploiement rapide sur les deux stores.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-vials"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('app_mobile_3'); echo $acf_val ? esc_html($acf_val) : 'App Mobile'; ?></span>
<h3><?php $acf_val = get_field('tests_qa'); echo $acf_val ? esc_html($acf_val) : 'Tests &amp; QA'; ?></h3>
<p><?php $acf_val = get_field('tests_rigoureux_sur_une_m'); echo $acf_val ? wp_kses_post($acf_val) : 'Tests rigoureux sur une multitude d\'appareils pour garantir une stabilité parfaite.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-upload"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('app_mobile_4'); echo $acf_val ? esc_html($acf_val) : 'App Mobile'; ?></span>
<h3><?php $acf_val = get_field('publication_stores'); echo $acf_val ? esc_html($acf_val) : 'Publication Stores'; ?></h3>
<p><?php $acf_val = get_field('accompagnement_complet_po'); echo $acf_val ? wp_kses_post($acf_val) : 'Accompagnement complet pour la mise en ligne sur l\'App Store et Google Play Store.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-tools"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('app_mobile_5'); echo $acf_val ? esc_html($acf_val) : 'App Mobile'; ?></span>
<h3><?php $acf_val = get_field('maintenance_mobile'); echo $acf_val ? esc_html($acf_val) : 'Maintenance Mobile'; ?></h3>
<p><?php $acf_val = get_field('mises_jour_r_guli_res_p'); echo $acf_val ? esc_html($acf_val) : 'Mises à jour régulières pour suivre les évolutions des systèmes iOS et Android.'; ?></p>
</div>
</div></div>
</section></div>

<!--================= Services Text Area End =================-->
<!--================= Ticker Area =================-->
<section class="project-area last">
<div class="ms-text-ticker">
<div class="ms-tt-wrap s-d is-inview">
<ul class="ms-tt text-split scrollingText-two">
<li class="ms-tt__text">SITES <span><?php $acf_val = get_field('web'); echo $acf_val ? esc_html($acf_val) : 'WEB'; ?></span> SUR MESURE </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">E-COMMERCE <span><?php $acf_val = get_field('premium'); echo $acf_val ? esc_html($acf_val) : 'PREMIUM'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">DESIGN <span><?php $acf_val = get_field('unique'); echo $acf_val ? esc_html($acf_val) : 'UNIQUE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">SEO <span><?php $acf_val = get_field('optimis'); echo $acf_val ? esc_html($acf_val) : 'OPTIMISÉ'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
<ul class="ms-tt two text-split scrollingText-four">
<li class="ms-tt__text">RESPONSIVE <span><?php $acf_val = get_field('design'); echo $acf_val ? esc_html($acf_val) : 'DESIGN'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">PERFORMANCE <span><?php $acf_val = get_field('web_1'); echo $acf_val ? esc_html($acf_val) : 'WEB'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">ACCOMPAGNEMENT <span><?php $acf_val = get_field('d_di'); echo $acf_val ? esc_html($acf_val) : 'DÉDIÉ'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">EXPERTISE <span><?php $acf_val = get_field('20_ans'); echo $acf_val ? esc_html($acf_val) : '20 ANS'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
</div>
</div>
</section>
<!--================= Ticker End =================-->
<!--================= CTA Section =================-->
<section class="service-cta">
<div class="container">
<h2><?php $acf_val = get_field('pr_t_lancer_votre_proje'); echo $acf_val ? esc_html($acf_val) : 'Prêt à lancer votre projet ?'; ?></h2>
<p><?php $acf_val = get_field('discutons_ensemble_de_vos'); echo $acf_val ? wp_kses_post($acf_val) : 'Discutons ensemble de vos besoins et construisons le site web qui propulsera votre activité.'; ?></p>
<a class="btn-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php $acf_val = get_field('demander_un_devis_gratuit'); echo $acf_val ? esc_html($acf_val) : 'Demander un devis gratuit'; ?></a>
</div>
</section>
<!--================= CTA End =================-->

</main>
<!--================= Footer =================-->
<?php get_footer(); 