<?php
/**
 * Template Name: E-Digital — Nos Services
 *
 * Template de page fidèle au HTML d'origine (services.html).
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
                                    <li class="breadcrumb-item active" aria-current="page">Nos Services</li>
                                </ol>
                            </nav>
                            <h1 class="ms-hero-title">Nos Services</h1>
                            <p class="ms-hero-subtitle">Des solutions sur-mesure pour donner vie à vos projets et propulser votre entreprise dans l'ère digitale.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!--================= Banner Area End =================-->

            <!--================= Services Area Start =================--><section class="project-area pt-150 pb-100">
                <div class="container">
                    <div class="e-con-inner mb-50 text-center" style="display: block; width: 100%;">
                        <h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; margin-top: 50px !important;"><span>
                                Une agence digitale globale capable de répondre à tous vos enjeux technologiques et marketing. </span></h2>
                    </div>
                    <div class="services-grid-wrap">
                        <div class="row">
                            <!-- Service 1: Création Web -->
                            <div class="col-md-4 col-sm-6 mb-5">
                                <article class="service-card" style="transition: transform 0.3s ease;">
                                    <a href="<?php echo esc_url( home_url( "/services/service-creation-web/" ) ); ?>" style="text-decoration: none; display: block;">
                                        <figure style="border-radius: 20px; overflow: hidden; margin-bottom: 25px;">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/service-web-hero.jpg" alt="Solution Numérique" style="width: 100%; aspect-ratio: 4/5; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </figure>
                                        <div class="service-card-content">
                                            <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 15px;">Solution Numérique</h3>
                                            <p style="color: #747474; font-size: 16px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                                Développement de sites vitrines et e-commerce ultra-performants. Un design premium et une ergonomie pensée pour convertir vos visiteurs en clients.
                                            </p>
                                        </div>
                                    </a>
                                </article>
                            </div>
                            
                            <!-- Service 2: Visibilité -->
                            <div class="col-md-4 col-sm-6 mb-5">
                                <article class="service-card" style="transition: transform 0.3s ease;">
                                    <a href="<?php echo esc_url( home_url( "/services/service-visibilite-seo/" ) ); ?>" style="text-decoration: none; display: block;">
                                        <figure style="border-radius: 20px; overflow: hidden; margin-bottom: 25px;">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-visibilite.png" alt="Audit Visibilité" style="width: 100%; aspect-ratio: 4/5; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </figure>
                                        <div class="service-card-content">
                                            <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 15px;">Audit Visibilité</h3>
                                            <p style="color: #747474; font-size: 16px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                                Analyse approfondie et optimisation de votre présence sur les moteurs de recherche. Générez un trafic qualifié et pérenne grâce au SEO.
                                            </p>
                                        </div>
                                    </a>
                                </article>
                            </div>

                            <!-- Service 3: Publicité -->
                            <div class="col-md-4 col-sm-6 mb-5">
                                <article class="service-card" style="transition: transform 0.3s ease;">
                                    <a href="<?php echo esc_url( home_url( "/services/service-visibilite-google-ads/" ) ); ?>" style="text-decoration: none; display: block;">
                                        <figure style="border-radius: 20px; overflow: hidden; margin-bottom: 25px;">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-ads.png" alt="Publicité Google et Meta" style="width: 100%; aspect-ratio: 4/5; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </figure>
                                        <div class="service-card-content">
                                            <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 15px;">Publicité Google et Meta</h3>
                                            <p style="color: #747474; font-size: 16px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                                Campagnes publicitaires ciblées sur Google Ads et les réseaux sociaux. Maximisez votre ROI avec des annonces ultra-performantes.
                                            </p>
                                        </div>
                                    </a>
                                </article>
                            </div>

                            <!-- Service 4: App Métier -->
                            <div class="col-md-4 col-sm-6 mb-5">
                                <article class="service-card" style="transition: transform 0.3s ease;">
                                    <a href="<?php echo esc_url( home_url( "/services/service-app-metier/" ) ); ?>" style="text-decoration: none; display: block;">
                                        <figure style="border-radius: 20px; overflow: hidden; margin-bottom: 25px;">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-app-metier.png" alt="Application Métier" style="width: 100%; aspect-ratio: 4/5; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </figure>
                                        <div class="service-card-content">
                                            <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 15px;">Application Métier</h3>
                                            <p style="color: #747474; font-size: 16px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                                Développement de logiciels sur-mesure pour automatiser et digitaliser vos processus internes. Des outils robustes adaptés à vous.
                                            </p>
                                        </div>
                                    </a>
                                </article>
                            </div>

                            <!-- Service 5: Branding -->
                            <div class="col-md-4 col-sm-6 mb-5">
                                <article class="service-card" style="transition: transform 0.3s ease;">
                                    <a href="<?php echo esc_url( home_url( "/services/service-branding/" ) ); ?>" style="text-decoration: none; display: block;">
                                        <figure style="border-radius: 20px; overflow: hidden; margin-bottom: 25px;">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-branding.png" alt="Branding & Design" style="width: 100%; aspect-ratio: 4/5; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </figure>
                                        <div class="service-card-content">
                                            <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 15px;">Branding & Design</h3>
                                            <p style="color: #747474; font-size: 16px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                                Création d'identités visuelles puissantes, logotypes et chartes mémorables. Conception d'interfaces UI/UX centrées utilisateur.
                                            </p>
                                        </div>
                                    </a>
                                </article>
                            </div>

                            <!-- Service 6: Maintenance -->
                            <div class="col-md-4 col-sm-6 mb-5">
                                <article class="service-card" style="transition: transform 0.3s ease;">
                                    <a href="<?php echo esc_url( home_url( "/services/service-maintenance/" ) ); ?>" style="text-decoration: none; display: block;">
                                        <figure style="border-radius: 20px; overflow: hidden; margin-bottom: 25px;">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/hero-maintenance.png" alt="Maintenance & Support" style="width: 100%; aspect-ratio: 4/5; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </figure>
                                        <div class="service-card-content">
                                            <h3 style="font-size: 22px; font-weight: 700; margin-bottom: 15px;">Maintenance & Support</h3>
                                            <p style="color: #747474; font-size: 16px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                                                Hébergement sécurisé, mises à jour critiques et support technique dédié. Garantissez la pérennité de vos actifs numériques.
                                            </p>
                                        </div>
                                    </a>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--================= Services Area End =================-->

            <!--================= Ticker Area Start =================-->
            <section class="project-area last">
                <div class="ms-text-ticker">
                    <div class="ms-tt-wrap s-d is-inview">
                        <ul class="ms-tt text-split scrollingText-two">
                            <li class="ms-tt__text">SITES <span>WEB</span> SUR MESURE&nbsp;</li>
                            <li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg" alt=""></li>
                            <li class="ms-tt__text">APPLICATIONS <span>MOBILES</span>&nbsp;</li>
                            <li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg" alt=""></li>
                            <li class="ms-tt__text">LOGICIELS <span>MÉTIER</span>&nbsp;</li>
                            <li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg" alt=""></li>
                            <li class="ms-tt__text">SOLUTION <span>SMMA</span>&nbsp;</li>
                            <li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg" alt=""></li>
                            <li class="ms-tt__text">SITES <span>E-COMMERCE</span>&nbsp;</li>
                            <li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg" alt=""></li>
                        </ul>
                        <ul class="ms-tt two text-split scrollingText-four">
                            <li class="ms-tt__text">SEO &amp; <span>STRATÉGIE</span> DIGITALE&nbsp;</li>
                            <li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg" alt=""></li>
                            <li class="ms-tt__text">DESIGN <span>PREMIUM</span>&nbsp;</li>
                            <li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg" alt=""></li>
                            <li class="ms-tt__text">ACCOMPAGNEMENT <span>DÉDIÉ</span>&nbsp;</li>
                            <li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg" alt=""></li>
                            <li class="ms-tt__text">INNOVATION <span>TECH</span>&nbsp;</li>
                            <li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg" alt=""></li>
                            <li class="ms-tt__text">EXPERTISE <span>WEB</span>&nbsp;</li>
                            <li class="ms-tt__text img"><img decoding="async" src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/circle-mokko.svg" alt=""></li>
                        </ul>
                    </div>
                </div>
            </section>
            <!--================= Ticker Area End =================-->

            <!--================= Newsletter Area Start =================-->
            <div class="container">
                <div class="newsletter-area">
                    <div class="newsletter-inner">
                        <h2 class="heading-title">Newsletter</h2>
                        <div class="form-area">
                            <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-116" method="post" data-id="116" data-name="Newsletter E-digital">
                                <div class="mc4wp-form-fields">
                                    <div class="ms-mc4wp--wrap">
                                        <p>Abonnez-vous pour recevoir nos idées inspirantes,<br> l'actualité de nos projets et nos innovations quotidiennes.</p>
                                        <div class="ms-mc4wp--action">
                                            <input class="form-control" type="email" name="EMAIL" placeholder="Votre adresse e-mail" required="">
                                            <button class="btn btn-default btn--md btn--primary" type="submit">
                                                <span class="ms-btn__text">
                                                    <svg class="ms-btt-i" enable-background="new 0 0 96 96" height="96px" version="1.1" viewBox="0 0 96 96" width="96px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0  c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195  c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0  c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104  c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159  c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0  L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z"></path>
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--================= Newsletter Area End =================-->

        </div>
    </main>

    <!--================= Footer Area Start Here =================-->
<?php
get_footer();
