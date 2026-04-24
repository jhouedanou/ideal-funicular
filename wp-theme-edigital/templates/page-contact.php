<?php
/**
 * Template Name: E-Digital — Contact
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
add_action( 'wp_enqueue_scripts', function() { wp_add_inline_style( 'edigital-style', '/* Force allow scrolling */
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
        /* Active menu highlight */
        .menu-item.active a span {
            border-bottom: 2px solid #ff0000 !important;
            padding-bottom: 5px;
        }

        /* Marquee spacing for transparent header */
        .marquee-area.contact {
            padding-top: 151px;
            background: #000 url(\'assets/images/contact-hero-bg.jpg\') center center / cover no-repeat;
            position: relative;
        }
        .marquee-area.contact::before {
            content: \'\';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            z-index: 0;
        }
        .marquee-area.contact .marquee-inner {
            position: relative;
            z-index: 1;
        }
        .ms-tt__text {
            color: #fff !important;
            font-weight: 700;
            text-transform: uppercase;
        }
        .wpcf7-submit:hover {
            background: #ff0000;
            color: #fff;
        }
        .tag {
            font-weight: 700;
            text-transform: uppercase;
            color: #999;
            font-size: 0.9rem;
            margin-bottom: 10px;
            list-style: none;
        }
        .contact ul {
            padding: 0;
            margin-bottom: 30px;
        }
        .contact ul li {
            list-style: none;
            font-size: 1.2rem;
            font-weight: 500;
        }
        .ms-s-w {
            margin-top: 10px;
        }
        .ms-s-i {
            font-size: 1.5rem;
            margin-right: 20px;
            color: #000;
            transition: color 0.3s ease;
        }
        .ms-s-i:hover {
            color: #ff0000;
        }
        /* Footer social icons */
        .social-btn-custom .ms-btn__text {
            color: #000 !important;
            transition: color 0.3s ease !important;
        }
        .social-btn-custom:hover .ms-btn__text {
            color: #fff !important;
        }
        .footer-nav-area li a {
            text-decoration: none !important;
            border-bottom: none !important;
        }
        .footer-nav-area li a::after {
            display: none !important;
        }
        /* Force hiding loader/preloader elements */
        #ms-preloader, .ms-preloader, .loading-bar, .loader-bar, #loaded, .preloader, 
        .swiper-pagination-progressbar, .p-progress-bar {
            display: none !important;
            opacity: 0 !important;
            visibility: hidden !important;
            height: 0 !important;
            width: 0 !important;
            pointer-events: none !important;
            z-index: -1 !important;
        }
        /* Header Fix: Ensure it\'s on top and clickable */
        .main-header.ms-nb--transparent {
            position: absolute !important;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999 !important;
            background: transparent !important;
            backdrop-filter: none !important;
            pointer-events: auto !important;
        }
        .main-header__inner {
            z-index: 10000 !important;
            pointer-events: auto !important;
        }
        .main-header__nav {
            pointer-events: auto !important;
        }
        /* Fix search icon stroke - theme CSS uses var(--color-contrast-high) which overrides HTML attribute */
        #ms-header .header__search-icon svg path {
            stroke: hsl(0, 0%, 17%) !important;
        }

        /* ====== STYLES DU FORMULAIRE MULTI-ÉTAPES ====== */
        :root {
            --primary: #ff0000;
            --dark: #0a0a0a;
            --gray: #f5f5f5;
            --border: #e0e0e0;
            --text-dark: #333;
            --text-light: #777;
        }
        
        .contact-multistep-section {
            padding: 80px 0;
            background: #fff;
        }
        
        .contact-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 60px;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }
        
        @media (max-width: 991px) {
            .contact-layout {
                grid-template-columns: 1fr;
            }
        }
        
        /* Progress Bar */
        .ms-step-progress {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
        }
        
        .ms-step-progress::before {
            content: \'\';
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            width: 100%;
            height: 2px;
            background: var(--border);
            z-index: 1;
        }
        
        .ms-step-item {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #fff;
            padding: 0 10px;
            color: #ccc;
            font-weight: 600;
            font-family: \'Unbounded\', sans-serif;
        }
        
        .ms-step-bubble {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fff;
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }
        
        .ms-step-item.active { color: var(--primary); }
        .ms-step-item.active .ms-step-bubble {
            border-color: var(--primary);
            background: var(--primary);
            color: #fff;
        }
        
        .ms-step-item.done { color: var(--text-dark); }
        .ms-step-item.done .ms-step-bubble {
            border-color: var(--text-dark);
            background: var(--text-dark);
            color: #fff;
        }
        
        /* Panels */
        .ms-step-panel {
            background: #fff;
            padding: 40px;
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            animation: fadeIn 0.4s ease forwards;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .ms-step-title {
            font-family: \'Unbounded\', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 5px;
            color: var(--dark);
        }
        
        .ms-step-subtitle {
            color: var(--text-light);
            margin-bottom: 30px;
            font-size: 1rem;
        }
        
        /* Form fields */
        .ms-field-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .ms-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        @media (max-width: 768px) { .ms-row-2 { grid-template-columns: 1fr; } }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
        }
        
        .req { color: var(--primary); }
        
        .ms-input, .ms-select, .ms-textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid var(--border);
            border-radius: 4px;
            background: var(--gray);
            font-family: \'Montserrat\', sans-serif;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .ms-input:focus, .ms-select:focus, .ms-textarea:focus {
            outline: none;
            border-color: var(--dark);
            background: #fff;
        }
        
        .ms-input.error, .ms-select.error, .ms-textarea.error {
            border-color: var(--primary);
            background: #fffafa;
        }
        
        .ms-textarea { min-height: 120px; resize: vertical; }
        
        .ms-field-error {
            color: var(--primary);
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
        }
        .ms-field-error.visible { display: block; }
        
        /* File Upload */
        .ms-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            padding: 20px;
            border: 2px dashed var(--border);
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
            background: #fff;
            color: var(--text-light);
        }
        .ms-upload-label:hover { border-color: var(--dark); color: var(--dark); }
        .ms-upload-label input[type="file"] { display: none; }
        .ms-upload-icon { font-size: 1.5rem; }
        .ms-upload-name { margin-top: 10px; font-size: 0.9rem; font-weight: 600; color: var(--primary); }
        
        /* RGPD */
        .ms-rgpd {
            display: flex;
            gap: 15px;
            align-items: flex-start;
            margin: 30px 0;
            font-size: 0.9rem;
            color: var(--text-light);
        }
        .ms-rgpd input { margin-top: 4px; }
        
        /* Buttons */
        .ms-form-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            border-top: 1px solid var(--border);
            padding-top: 30px;
        }
        
        .ms-btn-next, .ms-btn-submit {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 15px 30px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
            margin-left: auto;
        }
        .ms-btn-next:hover, .ms-btn-submit:hover { background: #d00000; transform: translateY(-2px); }
        
        .ms-btn-prev {
            background: transparent;
            color: var(--text-dark);
            border: 1px solid var(--border);
            padding: 14px 25px;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .ms-btn-prev:hover { background: var(--gray); }
        
        /* Success Message */
        .ms-form-success {
            display: none;
            text-align: center;
            padding: 60px 40px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 8px;
        }
        .ms-form-success.visible { display: block; animation: fadeIn 0.5s ease; }
        .ms-success-icon {
            width: 80px;
            height: 80px;
            background: #e6ffe6;
            color: #00c853;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 20px;
        }
        .ms-form-success h3 { font-family: \'Unbounded\', sans-serif; margin-bottom: 20px; }
        .ms-form-success p { font-size: 1.1rem; color: var(--text-light); }
        
        /* Sidebar Infos */
        .contact-info-col {
            position: sticky;
            top: 120px;
        }
        
        .contact-info-card {
            background: var(--dark);
            color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }
        
        .contact-info-card h3 {
            font-family: \'Unbounded\', sans-serif;
            color: #fff;
            margin-bottom: 30px;
            font-size: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 20px;
        }
        
        .contact-info-item {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
        }
        .cii-icon {
            color: var(--primary);
            font-size: 1.2rem;
            margin-top: 3px;
        }
        .cii-text p {
            color: rgba(255,255,255,0.6);
            font-size: 0.85rem;
            text-transform: uppercase;
            font-weight: 700;
            margin: 0 0 5px 0;
            letter-spacing: 1px;
        }
        .cii-text span {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 500;
        }
        
        .contact-social-row {
            display: flex;
            gap: 10px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .contact-social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.1);
            color: #fff;
            border-radius: 50px;
            padding: 10px 20px;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .contact-social-btn:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-3px);
        }' ); }, 20 );
get_header();
?>
<main class="ms-main">
<!--================= Marquee Area Start =================-->
<div class="marquee-area contact">
<div class="marquee-inner">
<ul class="marquee">
<li class="ms-tt__text">Travaillons Ensemble </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">Travaillons Ensemble </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">Travaillons Ensemble </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
<li class="ms-tt__text">Travaillons Ensemble </li>
<li class="ms-tt__text img"><img alt="" decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg"/></li>
</ul>
</div>
</div>
<!--================= Marquee Area End =================-->
<div class="ms-page-content">
<!--================= Contact Form Area Start =================-->
<section class="contact-multistep-section">
<div class="container">
<div class="contact-layout">
<!-- Colonne formulaire -->
<div class="contact-form-col">
<!-- Barre de progression -->
<div class="ms-step-progress" id="msStepProgress">
<div class="ms-step-item active" data-step="1">
<div class="ms-step-bubble">1</div>
<div class="ms-step-label">Qui êtes-vous ?</div>
</div>
<div class="ms-step-item" data-step="2">
<div class="ms-step-bubble">2</div>
<div class="ms-step-label">Votre projet</div>
</div>
<div class="ms-step-item" data-step="3">
<div class="ms-step-bubble">3</div>
<div class="ms-step-label">Budget &amp; Validation</div>
</div>
</div>
<form id="msContactForm" novalidate="">
<!-- ===== ÉTAPE 1 : Identité & Contact ===== -->
<div class="ms-step-panel" id="msStep1">
<h2 class="ms-step-title"><?php $acf_val = get_field('identit_contact'); echo $acf_val ? esc_html($acf_val) : 'Identité &amp; Contact'; ?></h2>
<p class="ms-step-subtitle"><?php $acf_val = get_field('parlez_nous_de_vous_pour'); echo $acf_val ? esc_html($acf_val) : 'Parlez-nous de vous pour que nous puissions vous identifier.'; ?></p>
<div class="ms-row-2">
<div class="ms-field-group">
<label for="ms-firstname">Prénom <span class="req">*</span></label>
<input class="ms-input" id="ms-firstname" name="firstname" placeholder="Jean" required="" type="text"/>
<div class="ms-field-error" id="err-firstname">Veuillez saisir votre prénom.</div>
</div>
<div class="ms-field-group">
<label for="ms-lastname">Nom <span class="req">*</span></label>
<input class="ms-input" id="ms-lastname" name="lastname" placeholder="Dupont" required="" type="text"/>
<div class="ms-field-error" id="err-lastname">Veuillez saisir votre nom.</div>
</div>
</div>
<div class="ms-row-2">
<div class="ms-field-group">
<label for="ms-email">Adresse e-mail professionnelle <span class="req">*</span></label>
<input class="ms-input" id="ms-email" name="email" placeholder="jean@société.fr" required="" type="email"/>
<div class="ms-field-error" id="err-email">Veuillez entrer une adresse e-mail valide.</div>
</div>
<div class="ms-field-group">
<label for="ms-phone">Numéro de téléphone <span class="req">*</span></label>
<input class="ms-input" id="ms-phone" name="phone" placeholder="01 84 25 16 81" required="" type="tel"/>
<div class="ms-field-error" id="err-phone">Veuillez entrer un numéro de téléphone valide.</div>
</div>
</div>
<div class="ms-row-2">
<div class="ms-field-group">
<label for="ms-company">Nom de l'entreprise <span class="req">*</span></label>
<input class="ms-input" id="ms-company" name="company" placeholder="Votre entreprise" required="" type="text"/>
<div class="ms-field-error" id="err-company">Le nom de l'entreprise est requis.</div>
</div>
<div class="ms-field-group">
<label for="ms-url">URL du site actuel <span style="color:#aaa;font-weight:400;font-size:0.75rem;"><?php $acf_val = get_field('optionnel'); echo $acf_val ? esc_html($acf_val) : '(optionnel)'; ?></span></label>
<input class="ms-input" id="ms-url" name="url" placeholder="https://www.votre-site.fr" type="url"/>
</div>
</div>
<div class="ms-form-nav">
<span></span>
<button class="ms-btn-next" onclick="msGoTo(2)" type="button">Continuer →</button>
</div>
</div>
<!-- ===== ÉTAPE 2 : Votre Projet ===== -->
<div class="ms-step-panel" id="msStep2" style="display:none;">
<h2 class="ms-step-title"><?php $acf_val = get_field('votre_projet'); echo $acf_val ? esc_html($acf_val) : 'Votre Projet'; ?></h2>
<p class="ms-step-subtitle"><?php $acf_val = get_field('c_est_ici_que_vous_pourre'); echo $acf_val ? wp_kses_post($acf_val) : 'C\'est ici que vous pourrez décrire votre projet pour nous permettre de préparer une étude personnalisée.'; ?></p>
<div class="ms-field-group">
<label for="ms-service">Type de prestation <span class="req">*</span></label>
<select class="ms-select" id="ms-service" name="service" required="">
<option value="">-- Sélectionnez une prestation --</option>
<option value="creation">Création solution numérique</option>
<option value="audit_visibilite">Audit visibilité</option>
<option value="publicite">Publicité Google et Meta</option>
<option value="maintenance">Maintenance</option>
<option value="autres">Autres</option>
</select>
<div class="ms-field-error" id="err-service">Veuillez sélectionner un type de prestation.</div>
</div>
<div class="ms-field-group">
<label for="ms-description">Description du projet <span class="req">*</span></label>
<textarea class="ms-textarea" id="ms-description" name="description" placeholder="Décrivez votre projet ici..." required=""></textarea>
<div class="ms-field-error" id="err-description">Veuillez décrire brièvement votre projet.</div>
</div>
<div class="ms-field-group">
<label>Ajouter un PDF <span style="color:#aaa;font-weight:400;font-size:0.75rem;"><?php $acf_val = get_field('cahier_des_charges_opt'); echo $acf_val ? esc_html($acf_val) : '(Cahier des charges - Optionnel)'; ?></span></label>
<label class="ms-upload-label" for="ms-file">
<input accept=".pdf" id="ms-file" name="cahier_charges" onchange="msUpdateFileName(this)" type="file"/>
<span class="ms-upload-icon"><i class="fas fa-file-upload"></i></span>
<span class="ms-upload-text"><?php $acf_val = get_field('d_posez_votre_fichier_pdf'); echo $acf_val ? esc_html($acf_val) : 'Déposez votre fichier PDF ou cliquez pour parcourir'; ?></span>
</label>
<div class="ms-upload-name" id="ms-file-name" style="display:none;"></div>
</div>
<div class="ms-form-nav">
<button class="ms-btn-prev" onclick="msGoTo(1)" type="button">← Retour</button>
<button class="ms-btn-next" onclick="msGoTo(3)" type="button">Continuer →</button>
</div>
</div>
<!-- ===== ÉTAPE 3 : Budget & Validation ===== -->
<div class="ms-step-panel" id="msStep3" style="display:none;">
<h2 class="ms-step-title"><?php $acf_val = get_field('budget_validation'); echo $acf_val ? esc_html($acf_val) : 'Budget &amp; Validation'; ?></h2>
<p class="ms-step-subtitle"><?php $acf_val = get_field('ces_informations_nous_aid'); echo $acf_val ? esc_html($acf_val) : 'Ces informations nous aident à personnaliser notre proposition commerciale.'; ?></p>
<div class="ms-row-2">
<div class="ms-field-group">
<label for="ms-budget">Budget estimé <span class="req">*</span></label>
<select class="ms-select" id="ms-budget" name="budget" required="">
<option value="">-- Budget estimé --</option>
<option value="lt2k">&lt; 2000€</option>
<option value="2k-5k">2000€ - 5000€</option>
<option value="5k-10k">5000€ - 10000€</option>
<option value="gt10k">&gt; 10000€</option>
</select>
<div class="ms-field-error" id="err-budget">Veuillez indiquer une enveloppe budgétaire.</div>
</div>
<div class="ms-field-group">
<label for="ms-delay">Délai de réalisation souhaité</label>
<select class="ms-select" id="ms-delay" name="delay">
<option value="">-- Délai souhaité --</option>
<option value="asap">ASAP (Dès que possible)</option>
<option value="3m">Sous 3 mois</option>
<option value="6m">Sous 6 mois</option>
<option value="veille">Veille technologique / Pas de date fixée</option>
</select>
</div>
</div>
<div class="ms-field-group">
<label for="ms-source">Comment nous avez-vous connus ?</label>
<select class="ms-select" id="ms-source" name="source">
<option value="">-- Sélectionnez --</option>
<option value="google">Recherche Google</option>
<option value="social">Réseaux Sociaux</option>
<option value="bouche">Bouche-à-oreille / Recommandation</option>
<option value="pub">Publicité</option>
</select>
</div>
<div class="ms-rgpd">
<input id="ms-rgpd" name="rgpd" required="" type="checkbox"/>
<div class="ms-rgpd-text">
<label for="ms-rgpd">J'accepte que mes données soient traitées pour répondre à ma demande de devis conformément à la <a href="#"><?php $acf_val = get_field('politique_de_confidential'); echo $acf_val ? esc_html($acf_val) : 'Politique de Confidentialité'; ?></a>. <span class="req">*</span></label>
</div>
</div>
<div class="ms-field-error" id="err-rgpd">Vous devez accepter notre politique de confidentialité pour continuer.</div>
<div class="ms-form-nav">
<button class="ms-btn-prev" onclick="msGoTo(2)" type="button">← Retour</button>
<button class="ms-btn-submit" type="submit">Envoyer ma demande ✓</button>
</div>
</div>
</form>
<!-- Message de confirmation -->
<div class="ms-form-success" id="msFormSuccess">
<div class="ms-success-icon"><i class="fas fa-check"></i></div>
<h3><?php $acf_val = get_field('merci_pour_votre_confianc'); echo $acf_val ? esc_html($acf_val) : 'Merci pour votre confiance !'; ?></h3>
<p>Ces éléments nous permettent de préparer une étude personnalisée avant même notre premier échange.<br/><br/>
                            Nous revenons vers vous <strong><?php $acf_val = get_field('tr_s_rapidement'); echo $acf_val ? esc_html($acf_val) : 'très rapidement'; ?></strong> pour fixer un créneau de consultation de 15 minutes.</p>
</div>
</div>
<!-- Colonne infos contact -->
<aside class="contact-info-col">
<div class="contact-info-card">
<h3><?php $acf_val = get_field('parlons_de_votre_projet'); echo $acf_val ? esc_html($acf_val) : 'Parlons de votre projet'; ?></h3>
<div class="contact-info-item">
<div class="cii-icon"><i class="fas fa-phone-alt"></i></div>
<div class="cii-text">
<p><?php $acf_val = get_field('appelez_nous'); echo $acf_val ? esc_html($acf_val) : 'Appelez-nous'; ?></p>
<span><a href="tel:0184251681" style="color:#fff;text-decoration:none;"><?php $acf_val = get_field('01_84_25_16_81'); echo $acf_val ? esc_html($acf_val) : '01 84 25 16 81'; ?></a></span>
</div>
</div>
<div class="contact-info-item">
<div class="cii-icon"><i class="fas fa-envelope"></i></div>
<div class="cii-text">
<p><?php $acf_val = get_field('crivez_nous'); echo $acf_val ? esc_html($acf_val) : 'Écrivez-nous'; ?></p>
<span><a href="mailto:com1@e-digital.fr" style="color:#fff;text-decoration:none;"><?php $acf_val = get_field('com1_e_digital_fr'); echo $acf_val ? esc_html($acf_val) : 'com1@e-digital.fr'; ?></a></span>
</div>
</div>
<div class="contact-info-item">
<div class="cii-icon"><i class="fas fa-map-marker-alt"></i></div>
<div class="cii-text">
<p><?php $acf_val = get_field('paris_si_ge_social'); echo $acf_val ? esc_html($acf_val) : 'Paris — Siège social'; ?></p>
<span><?php $acf_val = get_field('23_rue_du_d_part_75014_p'); echo $acf_val ? esc_html($acf_val) : '23 rue du départ, 75014 Paris'; ?></span>
</div>
</div>
<div class="contact-info-item">
<div class="cii-icon"><i class="fas fa-building"></i></div>
<div class="cii-text">
<p><?php $acf_val = get_field('agence_yvelines'); echo $acf_val ? esc_html($acf_val) : 'Agence Yvelines'; ?></p>
<span><?php $acf_val = get_field('guyancourt_78280'); echo $acf_val ? esc_html($acf_val) : 'Guyancourt (78280)'; ?></span>
</div>
</div>
<div class="contact-info-item">
<div class="cii-icon"><i class="fas fa-clock"></i></div>
<div class="cii-text">
<p><?php $acf_val = get_field('horaires'); echo $acf_val ? esc_html($acf_val) : 'Horaires'; ?></p>
<span><?php $acf_val = get_field('lun_ven_8h_17h30'); echo $acf_val ? esc_html($acf_val) : 'Lun – Ven : 8H à 17H30'; ?></span>
</div>
</div>
<div class="contact-social-row">
<a class="contact-social-btn" href="https://www.facebook.com/profile.php?id=100068093956984" target="_blank">
<i class="fab fa-facebook-f"></i> Facebook
                                </a>
<a class="contact-social-btn" href="https://www.linkedin.com/company/e-digital-fr/?viewAsMember=true" target="_blank">
<i class="fab fa-linkedin-in"></i> LinkedIn
                                </a>
</div>
</div>
</aside>
</div>
</div>
</section>
<!--================= Contact Form Area End =================-->
</div>
</main>
<!--================= Footer Area Start =================-->
<?php get_footer(); 