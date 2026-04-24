<?php
/**
 * Template Name: E-Digital — Nos Technologies
 *
 * Template de page fidèle au HTML d'origine (nos-technologies.html).
 * Généré automatiquement par sql/build-theme.py — ne pas éditer directement.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>
<div class="ms-page-content">
            <!--================= Banner Area Start =================-->
            <section class="ms-hero-internal">
                <div class="container">
                    <div class="ms-hc">
                        <div class="ms-hc--inner">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( "/" ) ); ?>">Accueil</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Nos Technologies</li>
                                </ol>
                            </nav>
                            <h1 class="ms-hero-title">Nos Technologies</h1>
                            <p class="ms-hero-subtitle">Nous maîtrisons les outils les plus performants pour donner vie à vos projets les plus ambitieux.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!--================= Banner Area End =================-->

            <!--================= Tech Grid Start =================-->
            <div class="services-area-2 pt-100 pb-100">
                <div class="container">
                    <div class="row">
                        <!-- Flutter -->
                        <div class="col-lg-4 col-md-6">
                            <div class="tech-card">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg" alt="Flutter">
                                <h3>Flutter</h3>
                                <p>Développement mobile multiplateforme haute performance pour iOS et Android avec un code unique.</p>
                            </div>
                        </div>
                        <!-- React Native -->
                        <div class="col-lg-4 col-md-6">
                            <div class="tech-card">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" alt="React Native">
                                <h3>React Native</h3>
                                <p>Applications mobiles natives puissantes utilisant la flexibilité et la rapidité de React.</p>
                            </div>
                        </div>
                        <!-- WordPress -->
                        <div class="col-lg-4 col-md-6">
                            <div class="tech-card">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/wordpress/wordpress-plain.svg" alt="WordPress">
                                <h3>WordPress</h3>
                                <p>Création de sites vitrines et blogs dynamiques, optimisés pour un référencement naturel maximal.</p>
                            </div>
                        </div>
                        <!-- Prestashop -->
                        <div class="col-lg-4 col-md-6">
                            <div class="tech-card">
                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-ecommerce.png" alt="Prestashop"> <!-- Placeholder for Prestashop icon -->
                                <h3>Prestashop</h3>
                                <p>Solutions e-commerce robustes et évolutives pour gérer vos ventes en ligne en toute simplicité.</p>
                            </div>
                        </div>
                        <!-- Laravel / PHP -->
                        <div class="col-lg-4 col-md-6">
                            <div class="tech-card">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" alt="Laravel">
                                <h3>Laravel</h3>
                                <p>Développement de plateformes web complexes et de logiciels métiers sécurisés sur mesure.</p>
                            </div>
                        </div>
                        <!-- Python / AI -->
                        <div class="col-lg-4 col-md-6">
                            <div class="tech-card">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg" alt="Python & AI">
                                <h3>Python & IA</h3>
                                <p>Automatisation intelligente et intégration de solutions d'intelligence artificielle avancées.</p>
                            </div>
                        </div>
                        <!-- React / Next.js -->
                        <div class="col-lg-4 col-md-6">
                            <div class="tech-card">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nextjs/nextjs-original.svg" alt="Next.js">
                                <h3>Next.js</h3>
                                <p>Interfaces utilisateur ultra-rapides et optimisées pour le SEO avec les dernières innovations React.</p>
                            </div>
                        </div>
                        <!-- Tailwind CSS -->
                        <div class="col-lg-4 col-md-6">
                            <div class="tech-card">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg" alt="Tailwind CSS">
                                <h3>Tailwind CSS</h3>
                                <p>Design moderne, réactif et épuré pour une expérience utilisateur exceptionnelle sur tous les écrans.</p>
                            </div>
                        </div>
                        <!-- Node.js -->
                        <div class="col-lg-4 col-md-6">
                            <div class="tech-card">
                                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" alt="Node.js">
                                <h3>Node.js</h3>
                                <p>Backend temps réel ultra-rapide pour des applications web modernes et scalables.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================= Tech Grid End =================-->
        </div>
    </main>

    <!--================= Footer Area Start Here =================-->
<?php
get_footer();
