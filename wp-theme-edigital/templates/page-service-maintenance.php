<?php
/**
 * Template Name: E-Digital — Maintenance & Support Technique
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }
        /* Hero - personnalisée Maintenance */
        .ms-hero-internal {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(\'assets/images/hero-maintenance.png\') no-repeat center center;
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
<li aria-current="page" class="breadcrumb-item active">Maintenance &amp; Support</li>
</ol>
</nav>
<h1 class="ms-hero-title" style="font-size: 50px !important; margin-bottom: 30px !important; text-transform: none !important;">Maintenance:<br/>Sécurisez votre actif numérique</h1>
<p class="ms-hero-subtitle" style="max-width: 900px; margin: 0 auto; line-height: 1.6;"><?php $acf_val = get_field('un_site_ou_une_applicatio'); echo $acf_val ? wp_kses_post($acf_val) : 'Un site ou une application qui tombe, c’est une perte immédiate de chiffre d’affaires et de crédibilité. La technologie évolue chaque jour : ne laissez pas l\'obsolescence ou une faille technique paralyser votre entreprise.'; ?></p>
</div>
</div>
</div>
</section>
<!--================= Hero Banner End =================-->
<!--================= Services Text Area =================-->
<section class="project-area pt-150 pb-100">
<div class="container">
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; margin-top: 50px !important; text-transform: none !important;"><span><?php $acf_val = get_field('z_ro_interruption_100_d'); echo $acf_val ? esc_html($acf_val) : 'Zéro interruption, 100% de sérénité'; ?></span></h2>
<p style="font-size: 1.1rem; color: #666; max-width: 800px; margin: 20px auto 30px;"><?php $acf_val = get_field('nous_ne_nous_contentons_p'); echo $acf_val ? wp_kses_post($acf_val) : 'Nous ne nous contentons pas de réparer ; nous anticipons. Notre service de maintenance garantit la pérennité de vos outils :'; ?></p>
</div>
<div class="service-text-grid">
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-shield-alt"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('s_curit'); echo $acf_val ? esc_html($acf_val) : 'Sécurité'; ?></span>
<h3><?php $acf_val = get_field('maintenance_pr_ventive'); echo $acf_val ? esc_html($acf_val) : 'Maintenance Préventive'; ?></h3>
<p><?php $acf_val = get_field('mises_jour_critiques_et'); echo $acf_val ? wp_kses_post($acf_val) : 'Mises à jour critiques et patches de sécurité pour contrer les menaces avant qu’elles n\'agissent.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-bolt"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('assistance'); echo $acf_val ? esc_html($acf_val) : 'Assistance'; ?></span>
<h3><?php $acf_val = get_field('support_r_actif'); echo $acf_val ? esc_html($acf_val) : 'Support Réactif'; ?></h3>
<p><?php $acf_val = get_field('une_assistance_technique'); echo $acf_val ? wp_kses_post($acf_val) : 'Une assistance technique à vos côtés pour résoudre vos incidents dans les plus brefs délais.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-tachometer-alt"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('performance'); echo $acf_val ? esc_html($acf_val) : 'Performance'; ?></span>
<h3><?php $acf_val = get_field('optimisation_continue'); echo $acf_val ? esc_html($acf_val) : 'Optimisation Continue'; ?></h3>
<p><?php $acf_val = get_field('votre_outil_reste_perform'); echo $acf_val ? wp_kses_post($acf_val) : 'Votre outil reste performant, rapide et compatible avec les nouveaux usages du web.'; ?></p>
</div>
</div>
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%; margin-top: 100px;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; text-transform: none !important;"><span><?php $acf_val = get_field('la_fiabilit_e_digital_fr'); echo $acf_val ? esc_html($acf_val) : 'La fiabilité E-Digital.fr'; ?></span></h2>
<p style="font-size: 1.1rem; color: #666; max-width: 800px; margin: 20px auto 30px;">S’appuyer sur E-Digital, c’est bénéficier de plus de dix ans d’expérience dans la gestion d'infrastructures critiques.<br/><br/>Nous assurons la surveillance de vos plateformes pour que vous puissiez vous concentrer sur l'essentiel : vos besoins de croissance.</p>
</div>
</div>
</section>
<!--================= Services Text Area End =================-->
<!--================= Ticker Area =================-->
<section class="project-area last">
<div class="ms-text-ticker">
<div class="ms-tt-wrap s-d is-inview">
<ul class="ms-tt text-split scrollingText-two">
<li class="ms-tt__text">MAINTENANCE <span><?php $acf_val = get_field('pr_ventive'); echo $acf_val ? esc_html($acf_val) : 'PRÉVENTIVE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">SÉCURITÉ <span><?php $acf_val = get_field('web'); echo $acf_val ? esc_html($acf_val) : 'WEB'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">SUPPORT <span><?php $acf_val = get_field('r_actif'); echo $acf_val ? esc_html($acf_val) : 'RÉACTIF'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">99.9% <span><?php $acf_val = get_field('uptime'); echo $acf_val ? esc_html($acf_val) : 'UPTIME'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
<ul class="ms-tt two text-split scrollingText-four">
<li class="ms-tt__text">PERFORMANCE <span><?php $acf_val = get_field('syst_me'); echo $acf_val ? esc_html($acf_val) : 'SYSTÈME'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">MÀJ <span><?php $acf_val = get_field('critiques'); echo $acf_val ? esc_html($acf_val) : 'CRITIQUES'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">SAUVEGARDE <span><?php $acf_val = get_field('auto'); echo $acf_val ? esc_html($acf_val) : 'AUTO'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">FIABILITÉ <span><?php $acf_val = get_field('totale'); echo $acf_val ? esc_html($acf_val) : 'TOTALE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
</div>
</div>
</section>
<!--================= Ticker End =================-->
<!--================= CTA Section =================-->
<section class="service-cta">
<div class="container">
<h2 style="text-transform: none !important;"><?php $acf_val = get_field('ne_prenez_aucun_risque_av'); echo $acf_val ? esc_html($acf_val) : 'Ne prenez aucun risque avec vos plateformes'; ?></h2>
<p><?php $acf_val = get_field('d_couvrez_nos_plans_de_ma'); echo $acf_val ? wp_kses_post($acf_val) : 'Découvrez nos plans de maintenance sur-mesure pour vous sécuriser dès aujourd\'hui.'; ?></p>
<a class="btn-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php $acf_val = get_field('cliquez_ici_pour_renseign'); echo $acf_val ? esc_html($acf_val) : 'Cliquez ici pour renseigner le formulaire de devis'; ?></a>
</div>
</section>
<!--================= CTA End =================-->
</div>
</main>
<!--================= Footer =================-->
<?php get_footer(); 