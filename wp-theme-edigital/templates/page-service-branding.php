<?php
/**
 * Template Name: E-Digital — Branding & Design
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }
        /* Hero - personnalisée Branding */
        .ms-hero-internal {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(\'assets/images/hero-branding.png\') no-repeat center center;
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
<li aria-current="page" class="breadcrumb-item active">Branding &amp; Design</li>
</ol>
</nav>
<h1 class="ms-hero-title" style="font-size: 50px !important; margin-bottom: 30px !important; text-transform: none !important;">Branding &amp; Design :<br/>Soyez mémorable, soyez leader</h1>
<p class="ms-hero-subtitle" style="max-width: 900px; margin: 0 auto; line-height: 1.6;"><?php $acf_val = get_field('votre_identit_visuelle_e'); echo $acf_val ? wp_kses_post($acf_val) : 'Votre identité visuelle est la première promesse que vous faites à vos clients. Si votre image est datée ou floue, vous perdez en crédibilité avant même d\'avoir pris la parole. Le branding, c\'est l\'art de transformer votre expertise en une marque forte et reconnaissable.'; ?></p>
</div>
</div>
</div>
</section>
<!--================= Hero Banner End =================-->
<!--================= Services Text Area =================-->
<section class="project-area pt-150 pb-100">
<div class="container">
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; margin-top: 50px !important; text-transform: none !important;"><span><?php $acf_val = get_field('au_del_du_simple_logo'); echo $acf_val ? esc_html($acf_val) : 'Au-delà du simple logo'; ?></span></h2>
<p style="font-size: 1.1rem; color: #666; max-width: 800px; margin: 20px auto 30px;"><?php $acf_val = get_field('nous_cr_ons_des_univers_d'); echo $acf_val ? wp_kses_post($acf_val) : 'Nous créons des univers de marque qui captent l\'attention et inspirent la confiance :'; ?></p>
</div>
<div class="service-text-grid">
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-fingerprint"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('adn_visuel'); echo $acf_val ? esc_html($acf_val) : 'ADN visuel'; ?></span>
<h3><?php $acf_val = get_field('identit_visuelle_unique'); echo $acf_val ? esc_html($acf_val) : 'Identité Visuelle Unique'; ?></h3>
<p><?php $acf_val = get_field('un_design_qui_refl_te_vos'); echo $acf_val ? wp_kses_post($acf_val) : 'Un design qui reflète vos valeurs et vous distingue immédiatement de la concurrence.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-chess-knight"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('strat_gie'); echo $acf_val ? esc_html($acf_val) : 'Stratégie'; ?></span>
<h3><?php $acf_val = get_field('design_strat_gique'); echo $acf_val ? esc_html($acf_val) : 'Design Stratégique'; ?></h3>
<p><?php $acf_val = get_field('chaque_couleur_police_et'); echo $acf_val ? esc_html($acf_val) : 'Chaque couleur, police et forme est choisie pour servir vos objectifs business.'; ?></p>
</div>
<div class="service-text-card">
<div class="stc-icon"><i class="fas fa-mobile-alt"></i></div>
<span class="stc-tag"><?php $acf_val = get_field('exp_rience'); echo $acf_val ? esc_html($acf_val) : 'Expérience'; ?></span>
<h3><?php $acf_val = get_field('exp_rience_utilisateur_u'); echo $acf_val ? esc_html($acf_val) : 'Expérience Utilisateur (UX)'; ?></h3>
<p><?php $acf_val = get_field('des_interfaces_pens_es_po'); echo $acf_val ? esc_html($acf_val) : 'Des interfaces pensées pour la conversion et le confort de vos clients.'; ?></p>
</div>
</div>
<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%; margin-top: 100px;">
<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; text-transform: none !important;"><span><?php $acf_val = get_field('l_expertise_e_digital_fr'); echo $acf_val ? esc_html($acf_val) : 'L\'expertise E-Digital.fr'; ?></span></h2>
<p style="font-size: 1.1rem; color: #666; max-width: 800px; margin: 20px auto 30px;"><?php $acf_val = get_field('une_marque_forte_est_un_a'); echo $acf_val ? wp_kses_post($acf_val) : 'Une marque forte est un actif qui prend de la valeur. Avec plus de dix ans d’expérience, E-Digital conçoit des identités visuelles pérennes, capables de soutenir les besoins de votre croissance sur le long terme.'; ?></p>
</div>
</div>
</section>
<!--================= Services Text Area End =================-->
<!--================= Ticker Area =================-->
<section class="project-area last">
<div class="ms-text-ticker">
<div class="ms-tt-wrap s-d is-inview">
<ul class="ms-tt text-split scrollingText-two">
<li class="ms-tt__text">BRANDING <span><?php $acf_val = get_field('design'); echo $acf_val ? esc_html($acf_val) : '&amp; DESIGN'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">IDENTITÉ <span><?php $acf_val = get_field('visuelle'); echo $acf_val ? esc_html($acf_val) : 'VISUELLE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">DESIGN <span><?php $acf_val = get_field('ux_ui'); echo $acf_val ? esc_html($acf_val) : 'UX/UI'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">LOGO <span><?php $acf_val = get_field('sur_mesure'); echo $acf_val ? esc_html($acf_val) : 'SUR MESURE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
<ul class="ms-tt two text-split scrollingText-four">
<li class="ms-tt__text">EXPÉRIENCE <span><?php $acf_val = get_field('client'); echo $acf_val ? esc_html($acf_val) : 'CLIENT'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">STRATÉGIE <span><?php $acf_val = get_field('marque'); echo $acf_val ? esc_html($acf_val) : 'MARQUE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">DESIGN <span><?php $acf_val = get_field('graphique'); echo $acf_val ? esc_html($acf_val) : 'GRAPHIQUE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">DIRECTION <span><?php $acf_val = get_field('artistique'); echo $acf_val ? esc_html($acf_val) : 'ARTISTIQUE'; ?></span> </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
</div>
</div>
</section>
<!--================= Ticker End =================-->
<!--================= CTA Section =================-->
<section class="service-cta">
<div class="container">
<h2 style="text-transform: none !important;"><?php $acf_val = get_field('donnez_votre_ambition_l'); echo $acf_val ? esc_html($acf_val) : 'Donnez à votre ambition l\'image qu\'elle mérite'; ?></h2>
<p><?php $acf_val = get_field('ne_laissez_plus_une_image'); echo $acf_val ? esc_html($acf_val) : 'Ne laissez plus une image médiocre freiner votre développement.'; ?></p>
<a "="" )="" );="" ?="" contact="" href="<?php echo esc_url( home_url( "><?php $acf_val = get_field('class_btn_cta_cliquez'); echo $acf_val ? esc_html($acf_val) : '" class="btn-cta"&gt;Cliquez ici pour renseigner le formulaire de devis'; ?></a>
</div>
</section>
<!--================= CTA End =================-->
</div>
</main>
<!--================= Footer =================-->
<?php get_footer(); 