<?php
/**
 * Template Name: E-Digital — Création de Site Web
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
<li aria-current="page" class="breadcrumb-item active">Création Site Web</li>
</ol>
</nav>
<h1 class="ms-hero-title"><?php $acf_val = get_field('cr_ation_de_site_web'); echo $acf_val ? esc_html($acf_val) : 'Création de Site Web'; ?></h1>
<p class="ms-hero-subtitle">Des sites modernes, réactifs et optimisés SEO,<br/>conçus pour convertir vos visiteurs en clients.</p>
</div>
</div>
</div>
</section>
<!--================= Hero Banner End =================-->
<!--================= Services Text Area =================-->
<section class="project-area pt-150 pb-100">
<div class="container">
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; margin-top: 50px !important;"><span><?php $acf_val = get_field('nous_cr_ons_des_sites_web'); echo $acf_val ? wp_kses_post($acf_val) : 'Nous créons des sites web modernes, performants et optimisés pour propulser votre activité en ligne.'; ?></span></h2>
</div>
<div class="service-text-grid">
<!-- 1: Site Vitrine -->
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-laptop"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('pr_sence_en_ligne'); echo $acf_val ? esc_html($acf_val) : 'Présence en ligne'; ?></span>
<h3><?php $acf_val = get_field('site_vitrine_professionne'); echo $acf_val ? esc_html($acf_val) : 'Site Vitrine Professionnel'; ?></h3>
<p><?php $acf_val = get_field('un_site_vitrine_soign_r'); echo $acf_val ? wp_kses_post($acf_val) : 'Un site vitrine soigné, rapide et responsive qui reflète l\'image de votre entreprise. Conçu pour capter l\'attention de vos visiteurs dès la première seconde et les convertir en clients.'; ?></p>
</div>
<!-- 2: E-commerce -->
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-shopping-cart"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('vente_en_ligne'); echo $acf_val ? esc_html($acf_val) : 'Vente en ligne'; ?></span>
<h3><?php $acf_val = get_field('boutique_e_commerce'); echo $acf_val ? esc_html($acf_val) : 'Boutique E-commerce'; ?></h3>
<p><?php $acf_val = get_field('des_boutiques_en_ligne_su'); echo $acf_val ? wp_kses_post($acf_val) : 'Des boutiques en ligne sur WooCommerce, Shopify ou solution sur mesure. Catalogue produits, panier, paiement sécurisé, gestion des stocks — tout est optimisé pour maximiser vos ventes.'; ?></p>
</div>
<!-- 3: Sur Mesure -->
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-code"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('d_veloppement'); echo $acf_val ? esc_html($acf_val) : 'Développement'; ?></span>
<h3><?php $acf_val = get_field('d_veloppement_web_sur_mes'); echo $acf_val ? esc_html($acf_val) : 'Développement Web sur Mesure'; ?></h3>
<p><?php $acf_val = get_field('plateformes_web_complexes'); echo $acf_val ? wp_kses_post($acf_val) : 'Plateformes web complexes, intranet, portails clients ou applications métier en ligne. Nous développons des solutions robustes avec les technologies les plus adaptées à votre contexte.'; ?></p>
</div>
<!-- 4: SEO -->
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-search"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('r_f_rencement'); echo $acf_val ? esc_html($acf_val) : 'Référencement'; ?></span>
<h3><?php $acf_val = get_field('optimisation_seo_r_f_re'); echo $acf_val ? esc_html($acf_val) : 'Optimisation SEO &amp; Référencement'; ?></h3>
<p><?php $acf_val = get_field('chaque_site_est_con_u_ave'); echo $acf_val ? wp_kses_post($acf_val) : 'Chaque site est conçu avec les meilleures pratiques SEO intégrées : structure sémantique, balises optimisées, Core Web Vitals, maillage interne — pour une visibilité durable sur Google.'; ?></p>
</div>
<!-- 5: Refonte -->
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-sync-alt"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('redesign'); echo $acf_val ? esc_html($acf_val) : 'Redesign'; ?></span>
<h3><?php $acf_val = get_field('refonte_modernisation_d'); echo $acf_val ? esc_html($acf_val) : 'Refonte &amp; Modernisation de Site'; ?></h3>
<p><?php $acf_val = get_field('votre_site_est_vieillissa'); echo $acf_val ? wp_kses_post($acf_val) : 'Votre site est vieillissant ou ne convertit plus ? Nous le repensons de A à Z — nouveau design, nouvelle architecture, migration sécurisée — tout en préservant votre référencement existant.'; ?></p>
</div>
<!-- 6: Maintenance -->
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-shield-alt"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('support_s_curit'); echo $acf_val ? esc_html($acf_val) : 'Support &amp; Sécurité'; ?></span>
<h3><?php $acf_val = get_field('maintenance_support_web'); echo $acf_val ? esc_html($acf_val) : 'Maintenance &amp; Support Web'; ?></h3>
<p><?php $acf_val = get_field('mises_jour_r_guli_res'); echo $acf_val ? wp_kses_post($acf_val) : 'Mises à jour régulières, sauvegardes automatiques, surveillance de sécurité 24h/24 et support réactif. Votre site reste rapide, sécurisé et opérationnel en permanence.'; ?></p>
</div>
</div>
</div>
</section>
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
</div>
</main>
<!--================= Footer =================-->
<?php get_footer(); 