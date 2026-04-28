<?php
/**
 * Styles communs pour les blocs Gutenberg E-Digital (services, hero interne…).
 *
 * Ces styles étaient auparavant injectés en inline dans chaque page-service-*.php.
 * Ils sont désormais enqueued une seule fois pour toutes les pages utilisant les
 * blocs `edigital/service-*`, `edigital/services-hub`, `edigital/contact-info`,
 * `edigital/projets-intro` ou `edigital/technos-grid`.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'wp_enqueue_scripts', function () {
	$css = <<<CSS
/* === Hero interne (bandeau de page) === */
.ms-hero-internal {
	padding: 150px 0 100px;
	text-align: center;
	background-size: cover;
	background-position: center;
}
.ms-hero-title {
	color: #fff !important;
	font-size: 60px !important;
	font-weight: 700 !important;
	margin-bottom: 20px !important;
}
.ms-hero-subtitle {
	color: #cfcfcf !important;
	font-size: 20px !important;
	max-width: 800px;
	margin: 0 auto;
}
.ms-hero-internal .breadcrumb {
	background: transparent;
	padding: 0;
	margin-bottom: 20px;
	justify-content: center;
	list-style: none;
	display: flex;
}
.ms-hero-internal .breadcrumb-item + .breadcrumb-item::before {
	content: "/";
	color: #9e9e9e;
	padding: 0 10px;
}
.ms-hero-internal .breadcrumb-item a {
	color: #9e9e9e;
	text-decoration: none;
	transition: color 0.3s ease;
}
.ms-hero-internal .breadcrumb-item a:hover { color: #fff; }
.ms-hero-internal .breadcrumb-item.active { color: #fff; }

/* === Grille de cartes service === */
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
[data-theme="dark"] .service-text-card { background: #1a1a1a; }
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
[data-theme="dark"] .service-text-card p { color: #aaa; }
@media (max-width: 991px) {
	.service-text-grid { grid-template-columns: repeat(2, 1fr) !important; }
}
@media (max-width: 575px) {
	.service-text-grid { grid-template-columns: 1fr !important; }
}

/* === CTA Service === */
.service-cta {
	background: #111;
	color: #fff;
	padding: 80px 0;
	text-align: center;
}
.service-cta h2 {
	color: #fff;
	font-size: 2.4rem;
	margin-bottom: 20px;
}
.service-cta p {
	color: #cfcfcf;
	max-width: 700px;
	margin: 0 auto 32px;
	font-size: 1.05rem;
}
.service-cta .btn-cta {
	display: inline-block;
	background: #e31414;
	color: #fff;
	padding: 16px 36px;
	font-weight: 700;
	letter-spacing: 0.5px;
	text-decoration: none;
	border-radius: 6px;
	transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.service-cta .btn-cta:hover {
	transform: translateY(-2px);
	box-shadow: 0 12px 28px rgba(227,20,20,0.35);
}

/* === Hub Services (cartes images) === */
.services-grid-wrap .service-card { display: block; }
.services-grid-wrap .service-card a { text-decoration: none; color: inherit; }
.services-grid-wrap .service-card figure {
	margin: 0 0 25px;
	border-radius: 20px;
	overflow: hidden;
}
.services-grid-wrap .service-card figure img {
	width: 100%;
	aspect-ratio: 4/5;
	object-fit: cover;
	transition: transform 0.5s ease;
}
.services-grid-wrap .service-card:hover figure img { transform: scale(1.05); }
.services-grid-wrap .service-card-content h3 {
	font-size: 22px !important;
	font-weight: 700;
	margin-bottom: 10px;
}
.services-grid-wrap .service-card-content p {
	color: #747474;
	font-size: 16px;
	display: -webkit-box;
	-webkit-line-clamp: 3;
	-webkit-box-orient: vertical;
	overflow: hidden;
}

/* === Tech grid === */
.tech-card {
	background: #fff;
	padding: 40px;
	border-radius: 20px;
	transition: all 0.3s ease;
	box-shadow: 0 10px 30px rgba(0,0,0,0.05);
	text-align: center;
	display: flex;
	flex-direction: column;
	align-items: center;
	height: 100%;
}
.tech-card:hover {
	transform: translateY(-10px);
	box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}
.tech-card img {
	width: 80px;
	height: 80px;
	object-fit: contain;
	margin-bottom: 25px;
}
.tech-card h3 {
	font-size: 1.1rem;
	font-weight: 700;
	margin-bottom: 12px;
}
.tech-card p {
	color: #666;
	font-size: 14px;
	line-height: 1.6;
	margin: 0;
}
[data-theme="dark"] .tech-card { background: #1a1a1a; }
[data-theme="dark"] .tech-card p { color: #aaa; }

/* === Bloc contact-info (sidebar) === */
.edigital-contact-info {
	background: #f8f8f8;
	padding: 32px;
	border-radius: 16px;
}
.edigital-contact-info h4 {
	font-size: 0.85rem;
	text-transform: uppercase;
	letter-spacing: 1.5px;
	color: #e31414;
	margin: 0 0 8px;
}
.edigital-contact-info .ci-line {
	font-size: 1.15rem;
	font-weight: 600;
	margin: 0 0 20px;
}
[data-theme="dark"] .edigital-contact-info { background: #1a1a1a; }

/* === Office cards === */
.edigital-office-card { margin-bottom: 24px; }
.edigital-office-card h4 {
	font-size: 0.85rem;
	text-transform: uppercase;
	letter-spacing: 1.5px;
	color: #e31414;
	margin: 0 0 6px;
}
.edigital-office-card p { margin: 0; line-height: 1.6; }
CSS;

	wp_add_inline_style( 'edigital-style', $css );
}, 25 );
