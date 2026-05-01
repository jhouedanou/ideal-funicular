<?php
/**
 * Formulaire de contact multi-étapes — Page Contact WP.
 *
 * Fidèle visuellement à contact.html :
 *   Étape 1 — Identité & Contact
 *   Étape 2 — Votre Projet (type, description, PDF)
 *   Étape 3 — Budget & Validation
 *
 * Soumission AJAX → action `edigital_contact_submit`.
 * Destinataire principal : com1@e-digital.fr
 * Copie (CC)             : jhouedanou@gmail.com
 *
 * Fonctions publiques :
 *   edigital_contact_form_html()    → formulaire 3 étapes
 *   edigital_contact_sidebar_html() → colonne infos / réseaux
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ---------------------------------------------------------------------------
// Assets — CSS inline + JS multi-étapes
// ---------------------------------------------------------------------------

add_action( 'wp_enqueue_scripts', 'edigital_contact_enqueue_assets' );

function edigital_contact_enqueue_assets() {
	// On n'injecte les styles/scripts que sur la page contact.
	if ( ! is_page( 'contact' ) ) {
		return;
	}

	$css = '
:root {
	--ms-primary: #ff0000;
	--ms-dark:    #0a0a0a;
	--ms-gray:    #f5f5f5;
	--ms-border:  #e0e0e0;
	--ms-text-d:  #333;
	--ms-text-l:  #777;
}

/* Hero marquee contact */
.marquee-area.contact {
	padding-top: 151px;
	background: #000 center center / cover no-repeat;
	position: relative;
}
.marquee-area.contact::before {
	content: "";
	position: absolute;
	inset: 0;
	background: rgba(0,0,0,.55);
	z-index: 0;
}
.marquee-area.contact .marquee-inner { position: relative; z-index: 1; }
.ms-tt__text { color: #fff !important; font-weight: 700; text-transform: uppercase; }

/* Layout */
.contact-multistep-section { padding: 80px 0; background: #fff; }
.contact-layout {
	display: grid;
	grid-template-columns: 1fr 380px;
	gap: 60px;
	max-width: 1200px;
	margin: 0 auto;
	position: relative;
}
@media (max-width: 991px) { .contact-layout { grid-template-columns: 1fr; } }

/* Progress bar */
.ms-step-progress {
	display: flex;
	justify-content: space-between;
	margin-bottom: 40px;
	position: relative;
}
.ms-step-progress::before {
	content: "";
	position: absolute;
	top: 50%;
	left: 0;
	transform: translateY(-50%);
	width: 100%;
	height: 2px;
	background: var(--ms-border);
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
	font-family: "Unbounded", sans-serif;
}
.ms-step-bubble {
	width: 40px;
	height: 40px;
	border-radius: 50%;
	background: #fff;
	border: 2px solid var(--ms-border);
	display: flex;
	align-items: center;
	justify-content: center;
	margin-bottom: 8px;
	transition: all .3s ease;
}
.ms-step-item.active                { color: var(--ms-primary); }
.ms-step-item.active .ms-step-bubble { border-color: var(--ms-primary); background: var(--ms-primary); color: #fff; }
.ms-step-item.done                  { color: var(--ms-text-d); }
.ms-step-item.done .ms-step-bubble  { border-color: var(--ms-text-d); background: var(--ms-text-d); color: #fff; }

/* Panels */
.ms-step-panel {
	background: #fff;
	padding: 40px;
	border: 1px solid var(--ms-border);
	border-radius: 8px;
	box-shadow: 0 10px 30px rgba(0,0,0,.03);
	animation: msFadeIn .4s ease forwards;
}
@keyframes msFadeIn {
	from { opacity: 0; transform: translateY(10px); }
	to   { opacity: 1; transform: translateY(0); }
}
.ms-step-title    { font-family: "Unbounded", sans-serif; font-size: 1.8rem; margin-bottom: 5px; color: var(--ms-dark); }
.ms-step-subtitle { color: var(--ms-text-l); margin-bottom: 30px; font-size: 1rem; }

/* Champs */
.ms-field-group { margin-bottom: 25px; position: relative; }
.ms-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
@media (max-width: 768px) { .ms-row-2 { grid-template-columns: 1fr; } }
.ms-field-group label  { display: block; margin-bottom: 8px; font-weight: 600; color: var(--ms-dark); }
.req { color: var(--ms-primary); }
.ms-input, .ms-select, .ms-textarea {
	width: 100%;
	padding: 15px;
	border: 1px solid var(--ms-border);
	border-radius: 4px;
	background: var(--ms-gray);
	font-family: "Montserrat", sans-serif;
	font-size: 1rem;
	transition: all .3s;
}
.ms-input:focus, .ms-select:focus, .ms-textarea:focus {
	outline: none;
	border-color: var(--ms-dark);
	background: #fff;
}
.ms-input.error, .ms-select.error, .ms-textarea.error {
	border-color: var(--ms-primary);
	background: #fffafa;
}
.ms-textarea { min-height: 120px; resize: vertical; }
.ms-field-error { color: var(--ms-primary); font-size: .85rem; margin-top: 5px; display: none; }
.ms-field-error.visible { display: block; }

/* Upload */
.ms-upload-label {
	display: flex;
	align-items: center;
	justify-content: center;
	gap: 15px;
	padding: 20px;
	border: 2px dashed var(--ms-border);
	border-radius: 4px;
	cursor: pointer;
	transition: all .3s;
	background: #fff;
	color: var(--ms-text-l);
}
.ms-upload-label:hover             { border-color: var(--ms-dark); color: var(--ms-dark); }
.ms-upload-label input[type="file"]{ display: none; }
.ms-upload-icon { font-size: 1.5rem; }
.ms-upload-name { margin-top: 10px; font-size: .9rem; font-weight: 600; color: var(--ms-primary); }

/* RGPD */
.ms-rgpd {
	display: flex;
	gap: 15px;
	align-items: flex-start;
	margin: 30px 0;
	font-size: .9rem;
	color: var(--ms-text-l);
}
.ms-rgpd input { margin-top: 4px; }

/* Boutons nav */
.ms-form-nav {
	display: flex;
	justify-content: space-between;
	align-items: center;
	margin-top: 30px;
	border-top: 1px solid var(--ms-border);
	padding-top: 30px;
}
.ms-btn-next, .ms-btn-submit {
	background: var(--ms-primary);
	color: #fff;
	border: none;
	padding: 15px 30px;
	font-weight: 700;
	text-transform: uppercase;
	letter-spacing: 1px;
	font-size: .9rem;
	border-radius: 50px;
	cursor: pointer;
	transition: all .3s;
	margin-left: auto;
}
.ms-btn-next:hover, .ms-btn-submit:hover { background: #d00000; transform: translateY(-2px); }
.ms-btn-prev {
	background: transparent;
	color: var(--ms-text-d);
	border: 1px solid var(--ms-border);
	padding: 14px 25px;
	font-weight: 600;
	font-size: .9rem;
	border-radius: 50px;
	cursor: pointer;
	transition: all .3s;
}
.ms-btn-prev:hover { background: var(--ms-gray); }

/* Succès */
.ms-form-success {
	display: none;
	text-align: center;
	padding: 60px 40px;
	background: #fff;
	border: 1px solid var(--ms-border);
	border-radius: 8px;
}
.ms-form-success.visible { display: block; animation: msFadeIn .5s ease; }
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
.ms-form-success h3 { font-family: "Unbounded", sans-serif; margin-bottom: 20px; }
.ms-form-success p  { font-size: 1.1rem; color: var(--ms-text-l); }

/* Sidebar */
.contact-info-col  { position: sticky; top: 120px; }
.contact-info-card {
	background: var(--ms-dark);
	color: #fff;
	padding: 40px;
	border-radius: 8px;
	box-shadow: 0 15px 40px rgba(0,0,0,.1);
}
.contact-info-card h3 {
	font-family: "Unbounded", sans-serif;
	color: #fff;
	margin-bottom: 30px;
	font-size: 1.5rem;
	border-bottom: 1px solid rgba(255,255,255,.1);
	padding-bottom: 20px;
}
.contact-info-item { display: flex; gap: 20px; margin-bottom: 25px; }
.cii-icon { color: var(--ms-primary); font-size: 1.2rem; margin-top: 3px; }
.cii-text p {
	color: rgba(255,255,255,.6);
	font-size: .85rem;
	text-transform: uppercase;
	font-weight: 700;
	margin: 0 0 5px 0;
	letter-spacing: 1px;
}
.cii-text span { color: #fff; font-size: 1.1rem; font-weight: 500; }
.contact-social-row {
	display: flex;
	gap: 10px;
	margin-top: 40px;
	padding-top: 30px;
	border-top: 1px solid rgba(255,255,255,.1);
}
.contact-social-btn {
	display: flex;
	align-items: center;
	justify-content: center;
	background: rgba(255,255,255,.1);
	color: #fff;
	border-radius: 50px;
	padding: 10px 20px;
	gap: 8px;
	transition: all .3s;
	text-decoration: none;
	font-size: .9rem;
	font-weight: 600;
}
.contact-social-btn:hover { background: var(--ms-primary); color: #fff; transform: translateY(-3px); }
';

	wp_add_inline_style( 'edigital-style', $css );

	$nonce = wp_create_nonce( 'edigital_contact' );
	$ajax  = admin_url( 'admin-ajax.php' );

	$js = '
(function () {
	var currentStep = 1;

	window.msGoTo = function (step) {
		if (step > currentStep && !msValidateStep(currentStep)) return;
		document.getElementById("msStep" + currentStep).style.display = "none";
		document.querySelectorAll(".ms-step-item").forEach(function (item) {
			item.classList.remove("active", "done");
			var s = parseInt(item.getAttribute("data-step"));
			if (s < step)  item.classList.add("done");
			if (s === step) item.classList.add("active");
		});
		currentStep = step;
		document.getElementById("msStep" + step).style.display = "block";
		var sec = document.querySelector(".contact-multistep-section");
		if (sec) window.scrollTo({ top: sec.offsetTop - 100, behavior: "smooth" });
	};

	function msValidateStep(step) {
		var ok = true;
		if (step === 1) {
			ok = msCheck("ms-firstname", "err-firstname", function(v){ return v.trim().length >= 2; }) && ok;
			ok = msCheck("ms-lastname",  "err-lastname",  function(v){ return v.trim().length >= 2; }) && ok;
			ok = msCheck("ms-email",     "err-email",     function(v){ return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }) && ok;
			ok = msCheck("ms-phone",     "err-phone",     function(v){ return /^[\d\s\+\-\(\)\.]{6,20}$/.test(v.trim()); }) && ok;
			ok = msCheck("ms-company",   "err-company",   function(v){ return v.trim().length >= 2; }) && ok;
		}
		if (step === 2) {
			ok = msCheck("ms-service",     "err-service",     function(v){ return v !== ""; }) && ok;
			ok = msCheck("ms-description", "err-description", function(v){ return v.trim().length >= 10; }) && ok;
		}
		if (step === 3) {
			ok = msCheck("ms-budget", "err-budget", function(v){ return v !== ""; }) && ok;
			var rgpd    = document.getElementById("ms-rgpd");
			var rgpdErr = document.getElementById("err-rgpd");
			if (rgpd && !rgpd.checked) { if(rgpdErr) rgpdErr.classList.add("visible"); ok = false; }
			else if (rgpdErr)           { rgpdErr.classList.remove("visible"); }
		}
		return ok;
	}

	function msCheck(id, errId, fn) {
		var el  = document.getElementById(id);
		var err = document.getElementById(errId);
		if (!el || !err) return true;
		var valid = fn(el.value);
		el.classList.toggle("error", !valid);
		err.classList.toggle("visible", !valid);
		return valid;
	}

	["ms-firstname","ms-lastname","ms-email","ms-phone","ms-company","ms-service","ms-description","ms-budget"].forEach(function (id) {
		var el = document.getElementById(id);
		if (!el) return;
		el.addEventListener("input", function () {
			el.classList.remove("error");
			var err = document.getElementById("err-" + id.replace("ms-",""));
			if (err) err.classList.remove("visible");
		});
	});

	window.msUpdateFileName = function (input) {
		var nameEl = document.getElementById("ms-file-name");
		if (nameEl && input.files && input.files[0]) {
			nameEl.textContent = "📎 " + input.files[0].name;
			nameEl.style.display = "block";
		}
	};

	var form = document.getElementById("msContactForm");
	if (form) {
		form.addEventListener("submit", function (e) {
			e.preventDefault();
			if (!msValidateStep(3)) return;
			var btn = form.querySelector(".ms-btn-submit");
			if (btn) { btn.disabled = true; btn.textContent = "Envoi en cours…"; }
			var data = new FormData(form);
			data.append("action", "edigital_contact_submit");
			data.append("nonce",  "' . esc_js( $nonce ) . '");
			fetch("' . esc_js( $ajax ) . '", { method: "POST", body: data, credentials: "same-origin" })
				.then(function (r) { return r.json().catch(function () { return { success: false, data: { message: "Réponse serveur invalide." } }; }); })
				.then(function (res) {
					if (res && res.success) {
						form.style.display = "none";
						var bar = document.querySelector(".ms-step-progress");
						if (bar) bar.style.display = "none";
						document.getElementById("msFormSuccess").classList.add("visible");
					} else {
						var msg = (res.data && res.data.message) ? res.data.message : "Une erreur est survenue.";
						alert(msg);
						if (btn) { btn.disabled = false; btn.textContent = "Envoyer ma demande ✓"; }
					}
				})
				.catch(function () {
					alert("Erreur réseau, veuillez réessayer.");
					if (btn) { btn.disabled = false; btn.textContent = "Envoyer ma demande ✓"; }
				});
		});
	}
})();
';

	wp_add_inline_script( 'edigital-main', $js );
}

// ---------------------------------------------------------------------------
// AJAX handler — formulaire contact
// ---------------------------------------------------------------------------

add_action( 'wp_ajax_edigital_contact_submit',        'edigital_contact_handle_ajax' );
add_action( 'wp_ajax_nopriv_edigital_contact_submit', 'edigital_contact_handle_ajax' );

function edigital_contact_handle_ajax() {
	check_ajax_referer( 'edigital_contact', 'nonce' );

	$data = array(
		'firstname'   => isset( $_POST['firstname'] )   ? sanitize_text_field( wp_unslash( $_POST['firstname'] ) )   : '',
		'lastname'    => isset( $_POST['lastname'] )    ? sanitize_text_field( wp_unslash( $_POST['lastname'] ) )    : '',
		'email'       => isset( $_POST['email'] )       ? sanitize_email( wp_unslash( $_POST['email'] ) )             : '',
		'phone'       => isset( $_POST['phone'] )       ? sanitize_text_field( wp_unslash( $_POST['phone'] ) )       : '',
		'company'     => isset( $_POST['company'] )     ? sanitize_text_field( wp_unslash( $_POST['company'] ) )     : '',
		'url'         => isset( $_POST['url'] )         ? esc_url_raw( wp_unslash( $_POST['url'] ) )                 : '',
		'service'     => isset( $_POST['service'] )     ? sanitize_text_field( wp_unslash( $_POST['service'] ) )     : '',
		'description' => isset( $_POST['description'] ) ? sanitize_textarea_field( wp_unslash( $_POST['description'] ) ) : '',
		'budget'      => isset( $_POST['budget'] )      ? sanitize_text_field( wp_unslash( $_POST['budget'] ) )      : '',
		'delay'       => isset( $_POST['delay'] )       ? sanitize_text_field( wp_unslash( $_POST['delay'] ) )       : '',
		'source'      => isset( $_POST['source'] )      ? sanitize_text_field( wp_unslash( $_POST['source'] ) )      : '',
		'rgpd'        => ! empty( $_POST['rgpd'] ) ? 'Oui' : 'Non',
	);

	$required = array( 'firstname', 'lastname', 'email', 'phone', 'company', 'service', 'description', 'budget' );
	foreach ( $required as $field ) {
		if ( '' === $data[ $field ] ) {
			wp_send_json_error( array( 'message' => sprintf( __( 'Champ manquant : %s', 'edigital' ), $field ) ), 422 );
		}
	}
	if ( ! is_email( $data['email'] ) ) {
		wp_send_json_error( array( 'message' => __( 'Adresse e-mail invalide.', 'edigital' ) ), 422 );
	}

	// Gestion du fichier PDF (cahier des charges, optionnel).
	// Les clés string de l'array sont utilisées par PHPMailer comme nom
	// d'affichage de la pièce jointe — sinon PHPMailer prend le basename
	// du chemin temporaire (genre « phpXXXX »).
	$attachment = array();
	if ( ! empty( $_FILES['cahier_charges']['tmp_name'] ) ) {
		$file = $_FILES['cahier_charges'];
		if ( UPLOAD_ERR_OK !== (int) $file['error'] ) {
			wp_send_json_error( array( 'message' => __( 'Échec de l\'upload du fichier.', 'edigital' ) ), 422 );
		}
		// Limiter au type PDF uniquement (extension + signature finfo).
		$ftype = wp_check_filetype( basename( $file['name'] ), array( 'pdf' => 'application/pdf' ) );
		if ( 'application/pdf' !== $ftype['type'] ) {
			wp_send_json_error( array( 'message' => __( 'Seul le format PDF est accepté.', 'edigital' ) ), 422 );
		}
		if ( function_exists( 'finfo_file' ) ) {
			$finfo = finfo_open( FILEINFO_MIME_TYPE );
			$mime  = $finfo ? finfo_file( $finfo, $file['tmp_name'] ) : '';
			if ( $finfo ) { finfo_close( $finfo ); }
			if ( 'application/pdf' !== $mime ) {
				wp_send_json_error( array( 'message' => __( 'Le contenu du fichier ne correspond pas à un PDF.', 'edigital' ) ), 422 );
			}
		}
		// Taille max 5 Mo.
		if ( $file['size'] > 5 * 1024 * 1024 ) {
			wp_send_json_error( array( 'message' => __( 'Le fichier ne doit pas dépasser 5 Mo.', 'edigital' ) ), 422 );
		}
		// Nom d'affichage propre : on assainit le nom utilisateur.
		$display_name = sanitize_file_name( basename( $file['name'] ) ) ?: 'cahier-des-charges.pdf';

		// PHPMailer détecte le MIME via l'extension du chemin source ; le
		// tmp_name PHP n'en a pas → on copie vers un fichier .pdf temporaire.
		require_once ABSPATH . 'wp-admin/includes/file.php';
		$tmp_pdf = wp_tempnam( $display_name );
		if ( $tmp_pdf && @copy( $file['tmp_name'], $tmp_pdf ) ) {
			$attachment = array( $display_name => $tmp_pdf );
			// Cleanup une fois la requête terminée (réponse JSON déjà envoyée).
			$shutdown_cleanup = function () use ( $tmp_pdf ) {
				if ( file_exists( $tmp_pdf ) ) { @unlink( $tmp_pdf ); }
			};
			add_action( 'shutdown', $shutdown_cleanup );
		} else {
			$attachment = array( $display_name => $file['tmp_name'] );
		}
	}

	$services_labels = array(
		'creation'       => 'Création solution numérique',
		'audit_visibilite' => 'Audit visibilité',
		'publicite'      => 'Publicité Google et Meta',
		'maintenance'    => 'Maintenance',
		'autres'         => 'Autres',
	);
	$service_label = isset( $services_labels[ $data['service'] ] ) ? $services_labels[ $data['service'] ] : $data['service'];

	$budgets_labels = array(
		'lt2k'   => 'Moins de 2 000 €',
		'2k-5k'  => '2 000 € – 5 000 €',
		'5k-10k' => '5 000 € – 10 000 €',
		'gt10k'  => 'Plus de 10 000 €',
	);
	$budget_label = isset( $budgets_labels[ $data['budget'] ] ) ? $budgets_labels[ $data['budget'] ] : $data['budget'];

	$delays_labels = array(
		'asap'  => 'ASAP (dès que possible)',
		'3m'    => 'Sous 3 mois',
		'6m'    => 'Sous 6 mois',
		'veille'=> 'Veille / pas de date fixée',
	);
	$delay_label = isset( $delays_labels[ $data['delay'] ] ) ? $delays_labels[ $data['delay'] ] : $data['delay'];

	$sources_labels = array(
		'google' => 'Recherche Google',
		'social' => 'Réseaux Sociaux',
		'bouche' => 'Bouche-à-oreille',
		'pub'    => 'Publicité',
	);
	$source_label = isset( $sources_labels[ $data['source'] ] ) ? $sources_labels[ $data['source'] ] : $data['source'];

	$subject = sprintf( '[Devis] %s %s — %s', $data['firstname'], $data['lastname'], $service_label );

	$body  = '<html><body style="font-family:Arial,sans-serif;color:#333;">';
	$body .= '<h2 style="color:#ff0000;">Nouvelle demande de devis — E-Digital</h2>';
	$body .= '<table cellpadding="8" cellspacing="0" style="border-collapse:collapse;width:100%;max-width:600px;">';
	$rows  = array(
		'Prénom'       => $data['firstname'],
		'Nom'          => $data['lastname'],
		'Email'        => '<a href="mailto:' . esc_attr( $data['email'] ) . '">' . esc_html( $data['email'] ) . '</a>',
		'Téléphone'    => $data['phone'],
		'Entreprise'   => $data['company'],
		'Site actuel'  => $data['url'] ? '<a href="' . esc_url( $data['url'] ) . '">' . esc_html( $data['url'] ) . '</a>' : '—',
		'Prestation'   => $service_label,
		'Budget'       => $budget_label,
		'Délai'        => $delay_label ?: '—',
		'Source'       => $source_label ?: '—',
		'RGPD'         => $data['rgpd'],
	);
	$odd = true;
	foreach ( $rows as $label => $val ) {
		$bg    = $odd ? '#f9f9f9' : '#fff';
		$body .= '<tr style="background:' . $bg . ';">';
		$body .= '<td style="padding:10px;border:1px solid #e0e0e0;font-weight:700;width:35%;">' . esc_html( $label ) . '</td>';
		$body .= '<td style="padding:10px;border:1px solid #e0e0e0;">' . $val . '</td>';
		$body .= '</tr>';
		$odd   = ! $odd;
	}
	$body .= '</table>';
	$body .= '<h3 style="margin-top:30px;">Description du projet</h3>';
	$body .= '<p style="background:#f5f5f5;padding:20px;border-left:4px solid #ff0000;">' . nl2br( esc_html( $data['description'] ) ) . '</p>';
	$body .= '<p style="color:#888;font-size:.85rem;margin-top:30px;">Envoyé le ' . esc_html( wp_date( 'd/m/Y à H:i:s' ) ) . '</p>';
	$body .= '</body></html>';

	$to      = 'com1@e-digital.fr';
	$cc      = 'jhouedanou@gmail.com';
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From: E-Digital <no-reply@e-digital.fr>',
		'Reply-To: ' . $data['firstname'] . ' ' . $data['lastname'] . ' <' . $data['email'] . '>',
		'Cc: ' . $cc,
	);

	// Capture l'erreur PHPMailer pour la loguer (sinon échec silencieux).
	$mail_error = '';
	$err_capture = function ( $wp_err ) use ( &$mail_error ) {
		if ( $wp_err instanceof WP_Error ) {
			$mail_error = $wp_err->get_error_message();
		}
	};
	add_action( 'wp_mail_failed', $err_capture );

	$sent = wp_mail( $to, $subject, $body, $headers, $attachment );

	remove_action( 'wp_mail_failed', $err_capture );

	if ( ! $sent ) {
		error_log( sprintf(
			'[edigital_contact] wp_mail FAILED — to=%s subject=%s error=%s',
			$to, $subject, $mail_error ?: 'unknown'
		) );
		wp_send_json_error( array( 'message' => __( 'Échec de l\'envoi. Réessayez plus tard.', 'edigital' ) ), 500 );
	}

	wp_send_json_success( array( 'message' => __( 'Merci, nous revenons vers vous très rapidement.', 'edigital' ) ) );
}

// ---------------------------------------------------------------------------
// HTML : formulaire 3 étapes
// ---------------------------------------------------------------------------

function edigital_contact_form_html() {
	$preselect = isset( $_GET['service'] ) ? sanitize_text_field( wp_unslash( $_GET['service'] ) ) : '';
	ob_start();
	?>
	<!-- Barre de progression -->
	<div class="ms-step-progress" id="msStepProgress">
		<div class="ms-step-item active" data-step="1">
			<div class="ms-step-bubble">1</div>
			<div class="ms-step-label"><?php esc_html_e( 'Qui êtes-vous ?', 'edigital' ); ?></div>
		</div>
		<div class="ms-step-item" data-step="2">
			<div class="ms-step-bubble">2</div>
			<div class="ms-step-label"><?php esc_html_e( 'Votre projet', 'edigital' ); ?></div>
		</div>
		<div class="ms-step-item" data-step="3">
			<div class="ms-step-bubble">3</div>
			<div class="ms-step-label"><?php esc_html_e( 'Budget & Validation', 'edigital' ); ?></div>
		</div>
	</div>

	<form id="msContactForm" novalidate enctype="multipart/form-data">

		<!-- ===== ÉTAPE 1 : Identité & Contact ===== -->
		<div class="ms-step-panel" id="msStep1">
			<h2 class="ms-step-title"><?php esc_html_e( 'Identité & Contact', 'edigital' ); ?></h2>
			<p class="ms-step-subtitle"><?php esc_html_e( 'Parlez-nous de vous pour que nous puissions vous identifier.', 'edigital' ); ?></p>

			<div class="ms-row-2">
				<div class="ms-field-group">
					<label for="ms-firstname"><?php esc_html_e( 'Prénom', 'edigital' ); ?> <span class="req">*</span></label>
					<input type="text" id="ms-firstname" name="firstname" class="ms-input" placeholder="Jean" required>
					<div class="ms-field-error" id="err-firstname"><?php esc_html_e( 'Veuillez saisir votre prénom.', 'edigital' ); ?></div>
				</div>
				<div class="ms-field-group">
					<label for="ms-lastname"><?php esc_html_e( 'Nom', 'edigital' ); ?> <span class="req">*</span></label>
					<input type="text" id="ms-lastname" name="lastname" class="ms-input" placeholder="Dupont" required>
					<div class="ms-field-error" id="err-lastname"><?php esc_html_e( 'Veuillez saisir votre nom.', 'edigital' ); ?></div>
				</div>
			</div>

			<div class="ms-row-2">
				<div class="ms-field-group">
					<label for="ms-email"><?php esc_html_e( 'Adresse e-mail professionnelle', 'edigital' ); ?> <span class="req">*</span></label>
					<input type="email" id="ms-email" name="email" class="ms-input" placeholder="jean@société.fr" required>
					<div class="ms-field-error" id="err-email"><?php esc_html_e( 'Veuillez entrer une adresse e-mail valide.', 'edigital' ); ?></div>
				</div>
				<div class="ms-field-group">
					<label for="ms-phone"><?php esc_html_e( 'Numéro de téléphone', 'edigital' ); ?> <span class="req">*</span></label>
					<input type="tel" id="ms-phone" name="phone" class="ms-input" placeholder="01 84 25 16 81" required>
					<div class="ms-field-error" id="err-phone"><?php esc_html_e( 'Veuillez entrer un numéro de téléphone valide.', 'edigital' ); ?></div>
				</div>
			</div>

			<div class="ms-row-2">
				<div class="ms-field-group">
					<label for="ms-company"><?php esc_html_e( "Nom de l'entreprise", 'edigital' ); ?> <span class="req">*</span></label>
					<input type="text" id="ms-company" name="company" class="ms-input" placeholder="Votre entreprise" required>
					<div class="ms-field-error" id="err-company"><?php esc_html_e( "Le nom de l'entreprise est requis.", 'edigital' ); ?></div>
				</div>
				<div class="ms-field-group">
					<label for="ms-url"><?php esc_html_e( 'URL du site actuel', 'edigital' ); ?> <span style="color:#aaa;font-weight:400;font-size:.75rem;">(optionnel)</span></label>
					<input type="url" id="ms-url" name="url" class="ms-input" placeholder="https://www.votre-site.fr">
				</div>
			</div>

			<div class="ms-form-nav">
				<span></span>
				<button type="button" class="ms-btn-next" onclick="msGoTo(2)"><?php esc_html_e( 'Continuer →', 'edigital' ); ?></button>
			</div>
		</div>

		<!-- ===== ÉTAPE 2 : Votre Projet ===== -->
		<div class="ms-step-panel" id="msStep2" style="display:none;">
			<h2 class="ms-step-title"><?php esc_html_e( 'Votre Projet', 'edigital' ); ?></h2>
			<p class="ms-step-subtitle"><?php esc_html_e( "Décrivez votre projet pour nous permettre de préparer une étude personnalisée.", 'edigital' ); ?></p>

			<div class="ms-field-group">
				<label for="ms-service"><?php esc_html_e( 'Type de prestation', 'edigital' ); ?> <span class="req">*</span></label>
				<select id="ms-service" name="service" class="ms-select" required>
					<option value=""><?php esc_html_e( '-- Sélectionnez une prestation --', 'edigital' ); ?></option>
					<?php
					$services = array(
						'creation'        => __( 'Création solution numérique', 'edigital' ),
						'audit_visibilite' => __( 'Audit visibilité', 'edigital' ),
						'publicite'       => __( 'Publicité Google et Meta', 'edigital' ),
						'maintenance'     => __( 'Maintenance', 'edigital' ),
						'autres'          => __( 'Autres', 'edigital' ),
					);
					foreach ( $services as $slug => $label ) :
					?>
					<option value="<?php echo esc_attr( $slug ); ?>"<?php selected( $preselect, $slug ); ?>>
						<?php echo esc_html( $label ); ?>
					</option>
					<?php endforeach; ?>
				</select>
				<div class="ms-field-error" id="err-service"><?php esc_html_e( 'Veuillez sélectionner un type de prestation.', 'edigital' ); ?></div>
			</div>

			<div class="ms-field-group">
				<label for="ms-description"><?php esc_html_e( 'Description du projet', 'edigital' ); ?> <span class="req">*</span></label>
				<textarea id="ms-description" name="description" class="ms-textarea" placeholder="<?php esc_attr_e( 'Décrivez votre projet ici...', 'edigital' ); ?>" required></textarea>
				<div class="ms-field-error" id="err-description"><?php esc_html_e( 'Veuillez décrire brièvement votre projet.', 'edigital' ); ?></div>
			</div>

			<div class="ms-field-group">
				<label><?php esc_html_e( 'Ajouter un PDF', 'edigital' ); ?> <span style="color:#aaa;font-weight:400;font-size:.75rem;">(Cahier des charges — Optionnel)</span></label>
				<label class="ms-upload-label" for="ms-file">
					<input type="file" id="ms-file" name="cahier_charges" accept=".pdf" onchange="msUpdateFileName(this)">
					<span class="ms-upload-icon"><i class="fas fa-file-upload"></i></span>
					<span class="ms-upload-text"><?php esc_html_e( 'Déposez votre fichier PDF ou cliquez pour parcourir', 'edigital' ); ?></span>
				</label>
				<div class="ms-upload-name" id="ms-file-name" style="display:none;"></div>
			</div>

			<div class="ms-form-nav">
				<button type="button" class="ms-btn-prev" onclick="msGoTo(1)">← <?php esc_html_e( 'Retour', 'edigital' ); ?></button>
				<button type="button" class="ms-btn-next" onclick="msGoTo(3)"><?php esc_html_e( 'Continuer →', 'edigital' ); ?></button>
			</div>
		</div>

		<!-- ===== ÉTAPE 3 : Budget & Validation ===== -->
		<div class="ms-step-panel" id="msStep3" style="display:none;">
			<h2 class="ms-step-title"><?php esc_html_e( 'Budget & Validation', 'edigital' ); ?></h2>
			<p class="ms-step-subtitle"><?php esc_html_e( 'Ces informations nous aident à personnaliser notre proposition commerciale.', 'edigital' ); ?></p>

			<div class="ms-row-2">
				<div class="ms-field-group">
					<label for="ms-budget"><?php esc_html_e( 'Budget estimé', 'edigital' ); ?> <span class="req">*</span></label>
					<select id="ms-budget" name="budget" class="ms-select" required>
						<option value=""><?php esc_html_e( '-- Budget estimé --', 'edigital' ); ?></option>
						<option value="lt2k"><?php esc_html_e( '< 2 000 €', 'edigital' ); ?></option>
						<option value="2k-5k">2 000 € – 5 000 €</option>
						<option value="5k-10k">5 000 € – 10 000 €</option>
						<option value="gt10k"><?php esc_html_e( '> 10 000 €', 'edigital' ); ?></option>
					</select>
					<div class="ms-field-error" id="err-budget"><?php esc_html_e( 'Veuillez indiquer une enveloppe budgétaire.', 'edigital' ); ?></div>
				</div>
				<div class="ms-field-group">
					<label for="ms-delay"><?php esc_html_e( 'Délai de réalisation souhaité', 'edigital' ); ?></label>
					<select id="ms-delay" name="delay" class="ms-select">
						<option value=""><?php esc_html_e( '-- Délai souhaité --', 'edigital' ); ?></option>
						<option value="asap"><?php esc_html_e( 'ASAP (dès que possible)', 'edigital' ); ?></option>
						<option value="3m"><?php esc_html_e( 'Sous 3 mois', 'edigital' ); ?></option>
						<option value="6m"><?php esc_html_e( 'Sous 6 mois', 'edigital' ); ?></option>
						<option value="veille"><?php esc_html_e( 'Veille / pas de date fixée', 'edigital' ); ?></option>
					</select>
				</div>
			</div>

			<div class="ms-field-group">
				<label for="ms-source"><?php esc_html_e( 'Comment nous avez-vous connus ?', 'edigital' ); ?></label>
				<select id="ms-source" name="source" class="ms-select">
					<option value=""><?php esc_html_e( '-- Sélectionnez --', 'edigital' ); ?></option>
					<option value="google"><?php esc_html_e( 'Recherche Google', 'edigital' ); ?></option>
					<option value="social"><?php esc_html_e( 'Réseaux Sociaux', 'edigital' ); ?></option>
					<option value="bouche"><?php esc_html_e( 'Bouche-à-oreille / Recommandation', 'edigital' ); ?></option>
					<option value="pub"><?php esc_html_e( 'Publicité', 'edigital' ); ?></option>
				</select>
			</div>

			<div class="ms-rgpd">
				<input type="checkbox" id="ms-rgpd" name="rgpd" required>
				<div class="ms-rgpd-text">
					<label for="ms-rgpd">
						<?php esc_html_e( "J'accepte que mes données soient traitées pour répondre à ma demande de devis conformément à la", 'edigital' ); ?>
						<a href="<?php echo esc_url( home_url( '/politique-de-confidentialite/' ) ); ?>"><?php esc_html_e( 'Politique de Confidentialité', 'edigital' ); ?></a>.
						<span class="req">*</span>
					</label>
				</div>
			</div>
			<div class="ms-field-error" id="err-rgpd"><?php esc_html_e( 'Vous devez accepter notre politique de confidentialité pour continuer.', 'edigital' ); ?></div>

			<div class="ms-form-nav">
				<button type="button" class="ms-btn-prev" onclick="msGoTo(2)">← <?php esc_html_e( 'Retour', 'edigital' ); ?></button>
				<button type="submit" class="ms-btn-submit"><?php esc_html_e( 'Envoyer ma demande ✓', 'edigital' ); ?></button>
			</div>
		</div>

	</form>

	<!-- Message de confirmation -->
	<div class="ms-form-success" id="msFormSuccess">
		<div class="ms-success-icon"><i class="fas fa-check"></i></div>
		<h3><?php esc_html_e( 'Merci pour votre confiance !', 'edigital' ); ?></h3>
		<p><?php echo wp_kses(
			__( 'Ces éléments nous permettent de préparer une étude personnalisée avant même notre premier échange.<br><br>Nous revenons vers vous <strong>très rapidement</strong> pour fixer un créneau de consultation de 15 minutes.', 'edigital' ),
			array( 'br' => array(), 'strong' => array() )
		); ?></p>
	</div>
	<?php
	return ob_get_clean();
}

// ---------------------------------------------------------------------------
// HTML : colonne infos / réseaux sociaux
// ---------------------------------------------------------------------------

function edigital_contact_sidebar_html() {
	ob_start();
	?>
	<div class="contact-info-card">
		<h3><?php esc_html_e( 'Parlons de votre projet', 'edigital' ); ?></h3>

		<div class="contact-info-item">
			<div class="cii-icon"><i class="fas fa-phone-alt"></i></div>
			<div class="cii-text">
				<p><?php esc_html_e( 'Appelez-nous', 'edigital' ); ?></p>
				<span><a href="tel:0184251681" style="color:#fff;text-decoration:none;">01 84 25 16 81</a></span>
			</div>
		</div>

		<div class="contact-info-item">
			<div class="cii-icon"><i class="fas fa-envelope"></i></div>
			<div class="cii-text">
				<p><?php esc_html_e( 'Écrivez-nous', 'edigital' ); ?></p>
				<span><a href="mailto:com1@e-digital.fr" style="color:#fff;text-decoration:none;">com1@e-digital.fr</a></span>
			</div>
		</div>

		<div class="contact-info-item">
			<div class="cii-icon"><i class="fas fa-map-marker-alt"></i></div>
			<div class="cii-text">
				<p><?php esc_html_e( 'Paris — Siège social', 'edigital' ); ?></p>
				<span>23 rue du départ, 75014 Paris</span>
			</div>
		</div>

		<div class="contact-info-item">
			<div class="cii-icon"><i class="fas fa-building"></i></div>
			<div class="cii-text">
				<p><?php esc_html_e( 'Agence Yvelines', 'edigital' ); ?></p>
				<span>Guyancourt (78280)</span>
			</div>
		</div>

		<div class="contact-info-item">
			<div class="cii-icon"><i class="fas fa-clock"></i></div>
			<div class="cii-text">
				<p><?php esc_html_e( 'Horaires', 'edigital' ); ?></p>
				<span><?php esc_html_e( 'Lun – Ven : 8H à 17H30', 'edigital' ); ?></span>
			</div>
		</div>

		<div class="contact-social-row">
			<a href="https://www.facebook.com/profile.php?id=100068093956984" target="_blank" rel="noopener noreferrer" class="contact-social-btn">
				<i class="fab fa-facebook-f"></i> Facebook
			</a>
			<a href="https://www.linkedin.com/company/e-digital-fr/?viewAsMember=true" target="_blank" rel="noopener noreferrer" class="contact-social-btn">
				<i class="fab fa-linkedin-in"></i> LinkedIn
			</a>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
