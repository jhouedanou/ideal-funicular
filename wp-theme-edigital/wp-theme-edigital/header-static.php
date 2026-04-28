<?php
/**
 * Partial — en-tête statique E-Digital.
 * Généré automatiquement par sql/build-theme.py à partir de index.html.
 * Ne pas éditer directement.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div id="top" class="home"></div>
    <div class="main-header js-main-header auto-hide-header ms-nb--transparent full-width ms-nb--white menu-center"
        id="ms-header">
        <div class="main-header__layout top">
            <div class="main-header__inner">
                <div class="main-header__logo">
                    <div class="logo-dark">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/Logo  E DIGITAL copie.png" alt="E-digital - Agence Web & Mobile">
                        </a>
                    </div>
                    <div class="logo-light">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/Logo  E DIGITAL copie.png" alt="E-digital - Agence Web & Mobile">
                        </a>
                    </div>
                </div>
                <nav class="main-header__nav js-main-header__nav main-header__default" id="main-header-nav">
                    <ul id="primary-menu-default" class="navbar-nav">
                        <li class="menu-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>Accueil</span></a></li>
                        <li class="menu-item"><a href="<?php echo esc_url( home_url( '/nos-technologies/' ) ); ?>"><span>Nos Technologies</span></a></li>
                        <li class="menu-item menu-item-has-children">
                            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" title="Services"><span>Services</span></a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="<?php echo esc_url( home_url( '/services/service-creation-web/' ) ); ?>">Création Solution Numérique</a></li>
                                <li class="menu-item"><a href="<?php echo esc_url( home_url( '/services/service-visibilite-seo/' ) ); ?>">Visibilité</a></li>
                                <li class="menu-item"><a href="<?php echo esc_url( home_url( '/services/service-visibilite-google-ads/' ) ); ?>">Publicité Google et Meta</a>
                                </li>
                                
                                <li class="menu-item"><a href="<?php echo esc_url( home_url( '/services/service-app-metier/' ) ); ?>">Application Métier</a></li>
                                <li class="menu-item"><a href="<?php echo esc_url( home_url( '/services/service-branding/' ) ); ?>">Branding & Design</a></li>
                                <li class="menu-item"><a href="<?php echo esc_url( home_url( '/services/service-maintenance/' ) ); ?>">Maintenance & Support</a></li>
                            </ul>
                        </li>
                        <li class="menu-item"><a href="<?php echo esc_url( home_url( '/nos-projets/' ) ); ?>"><span>Nos Projets</span></a></li>
                        <li class="menu-item"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><span>Blog</span></a></li>
                        <li class="menu-item"><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><span>Contact</span></a></li>
                    </ul>
                </nav>

                <div class="main-header__widgets">
                    <div class="main-header--widgets">
                        <div class="ms_theme_mode ms-h_w">
                            <div class="ms_tm--inner">
                                <div class="theme-toggle" id="theme-toggle">
                                    <input type="checkbox" id="switcher" class="check" checked="">
                                    <svg class="sun-and-moon" aria-hidden="true" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <mask class="moon" id="moon-mask">
                                            <rect x="0" y="0" width="100%" height="100%" fill="white"></rect>
                                            <circle cx="24" cy="10" r="6" fill="black"></circle>
                                        </mask>
                                        <circle class="sun" cx="12" cy="12" r="6" mask="url(#moon-mask)"
                                            fill="currentColor"></circle>
                                        <g class="sun-beams" stroke="currentColor">
                                            <line x1="12" y1="1" x2="12" y2="3"></line>
                                            <line x1="12" y1="21" x2="12" y2="23"></line>
                                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                                            <line x1="1" y1="12" x2="3" y2="12"></line>
                                            <line x1="21" y1="12" x2="23" y2="12"></line>
                                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="header__search-icon ms-h_w">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                    stroke="#4F5663" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path d="M21 21L16.65 16.65" stroke="#4F5663" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </svg>
                        </div>

                        <div class="header__search-modal data-scroll-section">

                            <button class="header__search--close-btn">
                                <svg class="icon icon--sm" viewBox="0 0 24 24">
                                    <title>E-Digital - Agence de création de site internet et application mobile</title>
                                    <g fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="3" y1="3" x2="21" y2="21"></line>
                                        <line x1="21" y1="3" x2="3" y2="21"></line>
                                    </g>
                                </svg>
                            </button>

                            <div class="header__search--inner">

                                <form role="search" method="get" class="searchform" action="#">
                                    <div class="ms-search-widget">
                                        <input type="search" placeholder="Rechercher..." value="" name="s"
                                            class="search-field" required>
                                        <button aria-label="Search" class="ms-search--btn" type="submit"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>


                <button class="main-header__nav-trigger js-main-header__nav-trigger menu-default"
                    aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="main-header-nav">
                    <i class="main-header__nav-trigger-icon" aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>
    <!--================= Header End Here =================-->
    <!--================= Header One End =================-->
    <!--================= Mobile Menu Start Here =================-->

    <!--================= Mobile Menu Start Here =================-->
