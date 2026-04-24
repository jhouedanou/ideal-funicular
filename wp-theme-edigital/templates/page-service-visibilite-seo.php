<?php
/**
 * Template Name: E-Digital — Visibilité SEO & Référencement Naturel
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }
        /* Hero - identique à nos-projets.html mais avec image personnalisée */
        .ms-hero-internal {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(\'assets/images/hero-visibilite.png\') no-repeat center center;
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
<li class="breadcrumb-item"><a "="" )="" );="" ?="" href="<?php echo esc_url( home_url( "><?php $acf_val = get_field('accueil'); echo $acf_val ? esc_html($acf_val) : '"&gt;Accueil'; ?></a></li>
<li class="breadcrumb-item"><a "="" )="" );="" ?="" href="<?php echo esc_url( home_url( " services=""><?php $acf_val = get_field('services'); echo $acf_val ? esc_html($acf_val) : '"&gt;Services'; ?></a></li>
<li aria-current="page" class="breadcrumb-item active">Visibilité</li>
</ol>
</nav>
<h1 class="ms-hero-title" style="font-size: 45px !important; margin-bottom: 30px !important;"><?php $acf_val = get_field('votre_site_existe_mais_r'); echo $acf_val ? esc_html($acf_val) : 'Votre site existe, mais reste invisible ?'; ?></h1>
<p class="ms-hero-subtitle" style="max-width: 800px; margin: 0 auto;"><?php $acf_val = get_field('un_site_sans_trafic_est_u'); echo $acf_val ? wp_kses_post($acf_val) : 'Un site sans trafic est un investissement perdu. Si votre plateforme ne génère ni contacts ni ventes, ce n\'est pas un problème de design, c\'est un problème de visibilité.'; ?></p>
</div>
</div>
</div>
</section>
<!--================= Hero Banner End =================-->
<!--================= Services Text Area =================-->
<section class="project-area pt-150 pb-100">
<div class="container">
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; margin-top: 50px !important; text-transform: none !important;"><span><?php $acf_val = get_field('e_digital_fr_l_exp_rien'); echo $acf_val ? esc_html($acf_val) : 'E-Digital.fr : L\'expérience au service de votre croissance'; ?></span></h2>
<p style="font-size: 1.1rem; color: #666; max-width: 800px; margin: 20px auto 0;"><?php $acf_val = get_field('ne_laissez_plus_vos_concu'); echo $acf_val ? wp_kses_post($acf_val) : 'Ne laissez plus vos concurrents prendre toute la place. Nous transformons votre site en un véritable levier de business.'; ?></p>
</div>
<div class="service-text-grid">
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-briefcase"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('visibilit'); echo $acf_val ? esc_html($acf_val) : 'Visibilité'; ?></span>
<h3><?php $acf_val = get_field('expertise'); echo $acf_val ? esc_html($acf_val) : 'Expertise'; ?></h3>
<p><?php $acf_val = get_field('plus_de_dix_ans_d_exp_rie'); echo $acf_val ? esc_html($acf_val) : 'Plus de dix ans d’expérience en stratégie digitale.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-bullseye"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('visibilit_1'); echo $acf_val ? esc_html($acf_val) : 'Visibilité'; ?></span>
<h3><?php $acf_val = get_field('objectif'); echo $acf_val ? esc_html($acf_val) : 'Objectif'; ?></h3>
<p><?php $acf_val = get_field('positionner_votre_marque'); echo $acf_val ? esc_html($acf_val) : 'Positionner votre marque là où vos clients vous cherchent.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-chart-line"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('visibilit_2'); echo $acf_val ? esc_html($acf_val) : 'Visibilité'; ?></span>
<h3><?php $acf_val = get_field('r_sultat'); echo $acf_val ? esc_html($acf_val) : 'Résultat'; ?></h3>
<p><?php $acf_val = get_field('un_flux_constant_de_prosp'); echo $acf_val ? esc_html($acf_val) : 'Un flux constant de prospects qualifiés pour nourrir votre développement.'; ?></p>
</div>
</div>
<div style="text-align: center; margin-top: 60px; font-size: 1.3rem; font-weight: 700; color: #e31414;">
                        Le constat est simple : Votre croissance de demain dépend de votre visibilité d'aujourd'hui.
                    </div>
</div>
</section>
<!--================= Services Text Area End =================-->
<!--================= Ticker Area =================-->
<section class="project-area last">
<div class="ms-text-ticker">
<div class="ms-tt-wrap s-d is-inview">
<ul class="ms-tt text-split scrollingText-two">
<li class="ms-tt__text">VISIBILITÉ <span><?php $acf_val = get_field('maximale'); echo $acf_val ? esc_html($acf_val) : 'MAXIMALE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">TRAFIC <span><?php $acf_val = get_field('qualifi'); echo $acf_val ? esc_html($acf_val) : 'QUALIFIÉ'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">STRATÉGIE <span><?php $acf_val = get_field('digitale'); echo $acf_val ? esc_html($acf_val) : 'DIGITALE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">SEO <span><?php $acf_val = get_field('performant'); echo $acf_val ? esc_html($acf_val) : 'PERFORMANT'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
<ul class="ms-tt two text-split scrollingText-four">
<li class="ms-tt__text">ACQUISITION <span><?php $acf_val = get_field('clients'); echo $acf_val ? esc_html($acf_val) : 'CLIENTS'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">RÉSULTATS <span><?php $acf_val = get_field('concrets'); echo $acf_val ? esc_html($acf_val) : 'CONCRETS'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">CROISSANCE <span><?php $acf_val = get_field('garantie'); echo $acf_val ? esc_html($acf_val) : 'GARANTIE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">EXPERTISE <span><?php $acf_val = get_field('10_ans'); echo $acf_val ? esc_html($acf_val) : '10 ANS'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
</div>
</div>
</section>
<!--================= Ticker End =================-->
<!--================= CTA Section =================-->
<section class="service-cta">
<div class="container">
<h2><?php $acf_val = get_field('pr_t_obtenir_des_r_sult'); echo $acf_val ? esc_html($acf_val) : 'Prêt à obtenir des résultats concrets ?'; ?></h2>
<p><?php $acf_val = get_field('discutons_ensemble_de_vos'); echo $acf_val ? wp_kses_post($acf_val) : 'Discutons ensemble de vos besoins et construisons la stratégie qui propulsera votre activité.'; ?></p>
<a "="" )="" );="" ?="" contact="" href="<?php echo esc_url( home_url( "><?php $acf_val = get_field('class_btn_cta_demande'); echo $acf_val ? esc_html($acf_val) : '" class="btn-cta"&gt;Demander un devis gratuit'; ?></a>
</div>
</section>
<!--================= CTA End =================-->
</div>
</main>
<!--================= Footer =================-->
<?php get_footer(); 