<?php
/**
 * Template Name: E-Digital — Publicité Google Ads & Meta Ads
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }
        /* Hero - personnalisée publicite Google Meta */
        .ms-hero-internal {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(\'assets/images/hero-ads.png\') no-repeat center center;
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
<li aria-current="page" class="breadcrumb-item active">Publicité Google et Meta</li>
</ol>
</nav>
<h1 class="ms-hero-title" style="font-size: 50px !important; margin-bottom: 30px !important; text-transform: none !important;">Publicité Google &amp; Meta :<br/>Dominez votre marché</h1>
<p class="ms-hero-subtitle" style="max-width: 800px; margin: 0 auto; line-height: 1.6;"><?php $acf_val = get_field('vous_voulez_des_r_sultats'); echo $acf_val ? wp_kses_post($acf_val) : 'Vous voulez des résultats immédiats ? Là où le SEO prend des mois, la publicité payante (Google Ads &amp; Meta Ads) vous propulse en tête de liste en 24 heures.'; ?></p>
</div>
</div>
</div>
</section>
<!--================= Hero Banner End =================-->
<!--================= Services Text Area =================-->
<section class="project-area pt-150 pb-100">
<div class="container">
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; margin-top: 50px !important; text-transform: none !important;"><span><?php $acf_val = get_field('pourquoi_coupler_google_e'); echo $acf_val ? esc_html($acf_val) : 'Pourquoi coupler Google et Meta ?'; ?></span></h2>
<p style="font-size: 1.1rem; color: #666; max-width: 800px; margin: 20px auto 30px;"><?php $acf_val = get_field('c_est_l_alliance_parfaite'); echo $acf_val ? esc_html($acf_val) : 'C’est l’alliance parfaite pour couvrir 100% du parcours de vos clients :'; ?></p>
</div>
<?php
// Zone éditable Gutenberg : si la page a du contenu saisi dans l'éditeur,
// il prend le pas sur les grilles statiques ci-dessous.
$page_content = edigital_get_editor_content();
if ( $page_content ) :
?>
<div class="edigital-gutenberg-zone">
<?php echo apply_filters( 'the_content', $page_content ); ?>
</div>
<?php else : ?>
<div class="service-text-grid" style="grid-template-columns: repeat(2, 1fr);">
<div class="service-text-card">
<div class="stc-icon"><i class="fab fa-google"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('l_intention'); echo $acf_val ? esc_html($acf_val) : 'L\'Intention'; ?></span>
<h3><?php $acf_val = get_field('google_ads'); echo $acf_val ? esc_html($acf_val) : 'Google Ads'; ?></h3>
<p><?php $acf_val = get_field('on_cible_les_clients_qui'); echo $acf_val ? wp_kses_post($acf_val) : 'On cible les clients qui recherchent activement votre service. Vous apparaissez au moment précis où le besoin est exprimé. C\'est de la capture de demande pure.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fab fa-facebook-f"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('l_audience'); echo $acf_val ? esc_html($acf_val) : 'L\'Audience'; ?></span>
<h3><?php $acf_val = get_field('meta_ads'); echo $acf_val ? esc_html($acf_val) : 'Meta Ads'; ?></h3>
<p><?php $acf_val = get_field('on_cible_les_clients_selo'); echo $acf_val ? wp_kses_post($acf_val) : 'On cible les clients selon leurs centres d\'intérêt et comportements. On crée le besoin et installe votre marque dans le quotidien de vos futurs acheteurs (Facebook, Instagram, WhatsApp).'; ?></p>
</div>
</div>
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%; margin-top: 100px;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; text-transform: none !important;"><span><?php $acf_val = get_field('l_avantage_e_digital_fr'); echo $acf_val ? esc_html($acf_val) : 'L’avantage E-Digital.fr'; ?></span></h2>
<p style="font-size: 1.1rem; color: #666; max-width: 800px; margin: 20px auto 30px;"><?php $acf_val = get_field('g_rer_des_budgets_publici'); echo $acf_val ? wp_kses_post($acf_val) : 'Gérer des budgets publicitaires ne s\'improvise pas. Avec plus de dix ans d\'expérience, nous optimisons chaque euro investi pour garantir votre rentabilité.'; ?></p>
</div>
<div class="service-text-grid">
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-crosshairs"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('performance'); echo $acf_val ? esc_html($acf_val) : 'Performance'; ?></span>
<h3><?php $acf_val = get_field('ciblage_laser'); echo $acf_val ? esc_html($acf_val) : 'Ciblage laser'; ?></h3>
<p><?php $acf_val = get_field('ne_payez_que_pour_des_cli'); echo $acf_val ? esc_html($acf_val) : 'Ne payez que pour des clics qualifiés.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-chart-pie"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('performance_1'); echo $acf_val ? esc_html($acf_val) : 'Performance'; ?></span>
<h3><?php $acf_val = get_field('roi_mesurable'); echo $acf_val ? esc_html($acf_val) : 'ROI mesurable'; ?></h3>
<p><?php $acf_val = get_field('vous_savez_exactement_ce'); echo $acf_val ? esc_html($acf_val) : 'Vous savez exactement ce que chaque campagne rapporte à votre entreprise.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-bolt"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('performance_2'); echo $acf_val ? esc_html($acf_val) : 'Performance'; ?></span>
<h3><?php $acf_val = get_field('r_activit'); echo $acf_val ? esc_html($acf_val) : 'Réactivité'; ?></h3>
<p><?php $acf_val = get_field('ajustement_des_strat_gies'); echo $acf_val ? wp_kses_post($acf_val) : 'Ajustement des stratégies en temps réel pour coller aux besoins de votre croissance.'; ?></p>
</div>
</div>
<div style="text-align: center; margin-top: 60px; font-size: 1.3rem; font-weight: 700; color: #e31414;">
                        Stop aux budgets gaspillés. Passez à une stratégie publicitaire qui transforme vos investissements en chiffre d'affaires.
                    </div>
<?php endif; ?>
</div>
</section>
<!--================= Services Text Area End =================-->
<!--================= Ticker Area =================-->
<section class="project-area last">
<div class="ms-text-ticker">
<div class="ms-tt-wrap s-d is-inview">
<ul class="ms-tt text-split scrollingText-two">
<li class="ms-tt__text">PUBLICITÉ <span><?php $acf_val = get_field('digitale'); echo $acf_val ? esc_html($acf_val) : 'DIGITALE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">GOOGLE <span><?php $acf_val = get_field('ads'); echo $acf_val ? esc_html($acf_val) : 'ADS'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">META <span><?php $acf_val = get_field('ads_1'); echo $acf_val ? esc_html($acf_val) : 'ADS'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">ROI <span><?php $acf_val = get_field('maximal'); echo $acf_val ? esc_html($acf_val) : 'MAXIMAL'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
<ul class="ms-tt two text-split scrollingText-four">
<li class="ms-tt__text">ACQUISITION <span><?php $acf_val = get_field('clients'); echo $acf_val ? esc_html($acf_val) : 'CLIENTS'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">RENTABILITÉ <span><?php $acf_val = get_field('garantie'); echo $acf_val ? esc_html($acf_val) : 'GARANTIE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">CLICS <span><?php $acf_val = get_field('qualifi_s'); echo $acf_val ? esc_html($acf_val) : 'QUALIFIÉS'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">CROISSANCE <span><?php $acf_val = get_field('rapide'); echo $acf_val ? esc_html($acf_val) : 'RAPIDE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
</div>
</div>
</section>
<!--================= Ticker End =================-->
<!--================= CTA Section =================-->
<section class="service-cta">
<div class="container">
<h2><?php $acf_val = get_field('pr_t_dominer_votre_marc'); echo $acf_val ? esc_html($acf_val) : 'Prêt à dominer votre marché ?'; ?></h2>
<p><?php $acf_val = get_field('contactez_nous_pour_d_fin'); echo $acf_val ? wp_kses_post($acf_val) : 'Contactez-nous pour définir votre budget et lancer vos premières campagnes rentables.'; ?></p>
<a class="btn-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php $acf_val = get_field('d_marrer_vos_campagnes'); echo $acf_val ? esc_html($acf_val) : 'Démarrer vos campagnes'; ?></a>
</div>
</section>
<!--================= CTA End =================-->
</div>
</main>
<!--================= Footer =================-->
<?php get_footer(); 