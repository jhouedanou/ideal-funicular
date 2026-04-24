<?php
/**
 * Template Name: E-Digital — Blog
 *
 * Template de page fidèle au HTML d'origine (blog.html).
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
                                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                                </ol>
                            </nav>
                            <h1 class="ms-hero-title">Notre Blog</h1>
                            <p class="ms-hero-subtitle">Actualités, conseils et tendances du monde digital pour propulser votre activité.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!--================= Banner Area End =================-->

            <!--================= Blog Area Start =================-->
            <section class="blog-post-area">
                <div class="container">
                    <div class="row">
                        <!-- Left Block: Most Read / Recent -->
                        <div class="col-lg-4">
                            <div class="ms-sidebar">
                                <aside class="ms_widget_recent_posts mb-50">
                                    <h4 class="mb-30" style="font-weight: 700; text-transform: uppercase;">Les plus lus</h4>
                                    <ul class="recent-post-list" style="list-style: none; padding: 0;">
                                        <!-- Recent Post 1 -->
                                        <li class="mb-20" style="display: flex; gap: 15px; align-items: flex-start;">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-mobile-dev.png" alt="" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                            <div>
                                                <a href="<?php echo esc_url( home_url( "/blog/" ) ); ?>" style="text-decoration: none; color: #000; font-weight: 600; display: block; line-height: 1.2;">Développement mobile : Les tendances 2024</a>
                                                <div style="font-size: 13px; color: #747474; margin-top: 5px; display: flex; align-items: center; gap: 10px;">
                                                    <span>04.07.2024</span>
                                                    <span><i class="far fa-eye"></i> 1.2k vues</span>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Recent Post 2 -->
                                        <li class="mb-20" style="display: flex; gap: 15px; align-items: flex-start;">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-smma.png" alt="" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                            <div>
                                                <a href="<?php echo esc_url( home_url( "/blog/" ) ); ?>" style="text-decoration: none; color: #000; font-weight: 600; display: block; line-height: 1.2;">Pourquoi le SMMA est indispensable</a>
                                                <div style="font-size: 13px; color: #747474; margin-top: 5px; display: flex; align-items: center; gap: 10px;">
                                                    <span>27.01.2026</span>
                                                    <span><i class="far fa-eye"></i> 856 vues</span>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Recent Post 3 -->
                                        <li class="mb-20" style="display: flex; gap: 15px; align-items: flex-start;">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-strategy.png" alt="" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                            <div>
                                                <a href="<?php echo esc_url( home_url( "/blog/" ) ); ?>" style="text-decoration: none; color: #000; font-weight: 600; display: block; line-height: 1.2;">SEO : Dominer les résultats de recherche</a>
                                                <div style="font-size: 13px; color: #747474; margin-top: 5px; display: flex; align-items: center; gap: 10px;">
                                                    <span>05.05.2024</span>
                                                    <span><i class="far fa-eye"></i> 2.4k vues</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </aside>

                                <aside class="widget_categories mb-50">
                                    <h4 class="mb-30" style="font-weight: 700; text-transform: uppercase;">Catégories</h4>
                                    <ul style="list-style: none; padding: 0;">
                                        <li class="mb-10"><a href="#" style="text-decoration: none; color: #000; display: flex; justify-content: space-between;">Design <span>(12)</span></a></li>
                                        <li class="mb-10"><a href="#" style="text-decoration: none; color: #000; display: flex; justify-content: space-between;">Technologie <span>(8)</span></a></li>
                                        <li class="mb-10"><a href="#" style="text-decoration: none; color: #000; display: flex; justify-content: space-between;">E-commerce <span>(15)</span></a></li>
                                        <li class="mb-10"><a href="#" style="text-decoration: none; color: #000; display: flex; justify-content: space-between;">Stratégie <span>(20)</span></a></li>
                                    </ul>
                                </aside>
                            </div>
                        </div>

                        <!-- Right Block: Blog Listing -->
                        <div class="col-lg-8">
                            <div class="ms-posts--wrap">
                                <div class="row ms-posts--card">
                                    <!-- Article 1 -->
                                    <article class="grid-item col-sm-12 col-md-6 post has-post-thumbnail">
                                        <a href="<?php echo esc_url( home_url( "/blog/" ) ); ?>" aria-label="Développement Mobile"></a>
                                        <figure class="ms-posts--card__media">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-mobile-dev.png" alt="Développement Mobile">
                                        </figure>
                                        <div class="post-content">
                                            <div class="post-meta-header">
                                                <div class="post-header--author">
                                                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png" alt="E-digital" style="width: 20px;">
                                                    <div class="post-meta__info">
                                                        <span class="post-meta__author">E-digital</span>
                                                        <span class="post-meta__date">04.07.2024</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-meta-cont">
                                                <div class="post-category">
                                                    <a href="#">Technologie</a>
                                                </div>
                                                <div class="post-header">
                                                    <a class="post-title" href="<?php echo esc_url( home_url( "/blog/" ) ); ?>">
                                                        <h3>Développement d'applications mobiles à Paris 📱</h3>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>

                                    <!-- Article 2 -->
                                    <article class="grid-item col-sm-12 col-md-6 post has-post-thumbnail">
                                        <a href="<?php echo esc_url( home_url( "/blog/" ) ); ?>" aria-label="Marketing Social"></a>
                                        <figure class="ms-posts--card__media">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-smma.png" alt="SMMA">
                                        </figure>
                                        <div class="post-content">
                                            <div class="post-meta-header">
                                                <div class="post-header--author">
                                                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png" alt="E-digital" style="width: 20px;">
                                                    <div class="post-meta__info">
                                                        <span class="post-meta__author">E-digital</span>
                                                        <span class="post-meta__date">27.01.2026</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-meta-cont">
                                                <div class="post-category">
                                                    <a href="#">Stratégie</a>
                                                </div>
                                                <div class="post-header">
                                                    <a class="post-title" href="<?php echo esc_url( home_url( "/blog/" ) ); ?>">
                                                        <h3>Agence Marketing des Médias Sociaux : Les Clés du Succès</h3>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>

                                    <!-- Article 3 -->
                                    <article class="grid-item col-sm-12 col-md-6 post has-post-thumbnail">
                                        <a href="<?php echo esc_url( home_url( "/blog/" ) ); ?>" aria-label="Création Web"></a>
                                        <figure class="ms-posts--card__media">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-web-creation.png" alt="Web Design">
                                        </figure>
                                        <div class="post-content">
                                            <div class="post-meta-header">
                                                <div class="post-header--author">
                                                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png" alt="E-digital" style="width: 20px;">
                                                    <div class="post-meta__info">
                                                        <span class="post-meta__author">E-digital</span>
                                                        <span class="post-meta__date">07.01.2026</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-meta-cont">
                                                <div class="post-category">
                                                    <a href="#">Design</a>
                                                </div>
                                                <div class="post-header">
                                                    <a class="post-title" href="<?php echo esc_url( home_url( "/blog/" ) ); ?>">
                                                        <h3>Création de Site Internet : Donnez Vie à Vos Idées</h3>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>

                                    <!-- Article 4 -->
                                    <article class="grid-item col-sm-12 col-md-6 post has-post-thumbnail">
                                        <a href="<?php echo esc_url( home_url( "/blog/" ) ); ?>" aria-label="Apps Spécifiques"></a>
                                        <figure class="ms-posts--card__media">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-custom-app.png" alt="Software">
                                        </figure>
                                        <div class="post-content">
                                            <div class="post-meta-header">
                                                <div class="post-header--author">
                                                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png" alt="E-digital" style="width: 20px;">
                                                    <div class="post-meta__info">
                                                        <span class="post-meta__author">E-digital</span>
                                                        <span class="post-meta__date">03.03.2025</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-meta-cont">
                                                <div class="post-category">
                                                    <a href="#">Développement</a>
                                                </div>
                                                <div class="post-header">
                                                    <a class="post-title" href="<?php echo esc_url( home_url( "/blog/" ) ); ?>">
                                                        <h3>Création Application Spécifique : Pourquoi le sur-mesure ?</h3>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>

                                    <!-- Article 5 -->
                                    <article class="grid-item col-sm-12 col-md-6 post has-post-thumbnail">
                                        <a href="<?php echo esc_url( home_url( "/blog/" ) ); ?>" aria-label="E-commerce"></a>
                                        <figure class="ms-posts--card__media">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-ecommerce.png" alt="E-commerce">
                                        </figure>
                                        <div class="post-content">
                                            <div class="post-meta-header">
                                                <div class="post-header--author">
                                                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png" alt="E-digital" style="width: 20px;">
                                                    <div class="post-meta__info">
                                                        <span class="post-meta__author">E-digital</span>
                                                        <span class="post-meta__date">12.12.2024</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-meta-cont">
                                                <div class="post-category">
                                                    <a href="#">E-commerce</a>
                                                </div>
                                                <div class="post-header">
                                                    <a class="post-title" href="<?php echo esc_url( home_url( "/blog/" ) ); ?>">
                                                        <h3>Vendre en Ligne : Les Erreurs à Éviter en 2024</h3>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>

                                    <!-- Article 6 -->
                                    <article class="grid-item col-sm-12 col-md-6 post has-post-thumbnail">
                                        <a href="<?php echo esc_url( home_url( "/blog/" ) ); ?>" aria-label="SEO Stratégie"></a>
                                        <figure class="ms-posts--card__media">
                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-strategy.png" alt="SEO">
                                        </figure>
                                        <div class="post-content">
                                            <div class="post-meta-header">
                                                <div class="post-header--author">
                                                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/fav-icone.png" alt="E-digital" style="width: 20px;">
                                                    <div class="post-meta__info">
                                                        <span class="post-meta__author">E-digital</span>
                                                        <span class="post-meta__date">05.05.2024</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-meta-cont">
                                                <div class="post-category">
                                                    <a href="#">SEO</a>
                                                </div>
                                                <div class="post-header">
                                                    <a class="post-title" href="<?php echo esc_url( home_url( "/blog/" ) ); ?>">
                                                        <h3>Accompagnement Stratégique pour votre Croissance</h3>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>

                                <!-- Pagination -->
                                <nav class="pagination" style="margin-top: 100px !important;" aria-label="Pagination">
                                    <ol class="pagination__list">
                                        <li class="page-item active"><a href="#" class="pagination__item">1</a></li>
                                        <li><a href="#" class="pagination__item">2</a></li>
                                        <li><a href="#" class="pagination__item">3</a></li>
                                        <li class="page-item next"><a href="#">Suivant</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--================= Blog Area End =================-->

            <!--================= Newsletter Area Start =================-->
            <div class="container pb-100">
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
