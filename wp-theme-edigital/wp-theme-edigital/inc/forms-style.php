<?php
/**
 * Styles inline minimalistes pour le formulaire de devis uniquement.
 *
 * Le formulaire newsletter conserve volontairement le markup et les classes
 * d'origine du thème (mc4wp-form, ms-mc4wp--wrap, ms-mc4wp--action) — donc
 * pas de CSS injecté pour lui. Seul un petit ajustement pour l'élément de
 * feedback AJAX est ajouté.
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function edigital_forms_inline_styles() {
	$css = <<<CSS
/* Feedback AJAX newsletter — discret, ne touche pas au layout d'origine */
.edigital-newsletter-feedback {
	min-height: 1.2em;
	margin: 10px 0 0;
	font-size: 13px;
	opacity: .85;
}

/* ===========================================================
   Devis (section ajoutée — pas d'équivalent dans le HTML statique)
   =========================================================== */
.edigital-quote-form {
	background: #fff;
	padding: 48px;
	border-radius: 24px;
	box-shadow: 0 30px 60px rgba(0,0,0,.08);
	font-family: inherit;
}
.edigital-quote-form__titre {
	font-size: 32px;
	font-weight: 700;
	margin: 0 0 8px;
	color: #111;
	text-align: center;
}
.edigital-quote-form__preselect {
	text-align: center;
	color: #555;
	margin: 0 0 28px;
	padding: 12px 18px;
	background: #faf5ec;
	border-left: 4px solid #c9a46b;
	border-radius: 6px;
}
.edigital-quote-form p {
	margin: 0 0 18px;
	display: flex;
	flex-direction: column;
}
.edigital-quote-form label {
	font-size: 13px;
	font-weight: 600;
	letter-spacing: 1px;
	text-transform: uppercase;
	color: #888;
	margin-bottom: 6px;
}
.edigital-quote-form input[type="text"],
.edigital-quote-form input[type="email"],
.edigital-quote-form input[type="tel"],
.edigital-quote-form select,
.edigital-quote-form textarea {
	width: 100%;
	border: 1px solid #e3e3e3;
	border-radius: 12px;
	padding: 14px 16px;
	font-size: 16px;
	color: #111;
	background: #fafafa;
	transition: border-color .25s ease, background .25s ease, box-shadow .25s ease;
	font-family: inherit;
}
.edigital-quote-form textarea { resize: vertical; min-height: 130px; }
.edigital-quote-form input:focus,
.edigital-quote-form select:focus,
.edigital-quote-form textarea:focus {
	outline: 0;
	border-color: #c9a46b;
	background: #fff;
	box-shadow: 0 0 0 3px rgba(201,164,107,.18);
}
.edigital-quote-form button[type="submit"] {
	background: #000;
	color: #fff;
	border: 0;
	border-radius: 50px;
	padding: 16px 36px;
	font-weight: 700;
	letter-spacing: 1px;
	text-transform: uppercase;
	cursor: pointer;
	transition: background .25s ease, transform .25s ease;
	margin-top: 8px;
	width: 100%;
}
.edigital-quote-form button[type="submit"]:hover {
	background: #c9a46b;
	color: #000;
	transform: translateY(-1px);
}
.edigital-quote-form__feedback {
	min-height: 1.4em;
	margin: 18px 0 0;
	font-size: 14px;
	text-align: center;
	color: #c9a46b;
}

@media (max-width: 640px) {
	.edigital-quote-form { padding: 28px 22px; border-radius: 18px; }
	.edigital-quote-form__titre { font-size: 26px; }
}
CSS;

	wp_add_inline_style( 'edigital-style', $css );
}
add_action( 'wp_enqueue_scripts', 'edigital_forms_inline_styles', 30 );
