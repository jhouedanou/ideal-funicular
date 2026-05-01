<?php
/**
 * Thème E-Digital — fonctions principales.
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'EDIGITAL_VERSION' ) ) {
	define( 'EDIGITAL_VERSION', '1.0.0' );
}

// Forcer le chargement des fonctions de plugins WordPress pour Elementor
require_once ABSPATH . 'wp-admin/includes/plugin.php';

/**
 * Déclare le support du thème et enregistre les emplacements de menu.
 */
function edigital_setup() {
	load_theme_textdomain( 'edigital', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	// Éditeur de blocs (Gutenberg).
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/style.css' );

	// Palette inspirée de l'identité E-Digital.
	add_theme_support( 'editor-color-palette', array(
		array( 'name' => __( 'Noir', 'edigital' ),  'slug' => 'noir',  'color' => '#000000' ),
		array( 'name' => __( 'Blanc', 'edigital' ), 'slug' => 'blanc', 'color' => '#ffffff' ),
		array( 'name' => __( 'Or', 'edigital' ),    'slug' => 'or',    'color' => '#c9a46b' ),
		array( 'name' => __( 'Gris', 'edigital' ),  'slug' => 'gris',  'color' => '#6b6b6b' ),
	) );

	// Support Elementor & Elementor Pro.
	add_theme_support( 'elementor' );
	add_theme_support( 'elementor-pro' );
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Menu principal', 'edigital' ),
		'footer'  => __( 'Menu pied de page', 'edigital' ),
	) );
}
add_action( 'after_setup_theme', 'edigital_setup' );

/**
 * Enregistre et charge les feuilles de style et scripts du thème.
 */
function edigital_enqueue_assets() {
	$theme_uri = get_template_directory_uri();
	$ver       = EDIGITAL_VERSION;

	// Polices Google (identique au site statique).
	wp_enqueue_style( 'edigital-google-fonts', 'https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Playfair+Display:ital,wght@0,700;1,700&family=Caveat:wght@700&family=Oswald:wght@700&family=Dancing+Script:wght@700&family=Unbounded:wght@700&family=Montserrat:wght@700&display=swap', array(), null );

	// Feuilles vendor.
	wp_enqueue_style( 'edigital-bootstrap',      $theme_uri . '/assets/css/vendor/bootstrap.min.css',     array(), $ver );
	wp_enqueue_style( 'edigital-fontawesome',    $theme_uri . '/assets/css/vendor/fontawesome-5.css',     array(), $ver );
	wp_enqueue_style( 'edigital-all-min',        $theme_uri . '/assets/css/vendor/all.min.css',           array(), $ver );
	wp_enqueue_style( 'edigital-magnific',       $theme_uri . '/assets/css/vendor/magnific-popup.css',    array(), $ver );
	wp_enqueue_style( 'edigital-plyr',           $theme_uri . '/assets/css/vendor/plyr.css',              array(), $ver );
	wp_enqueue_style( 'edigital-splitting',      $theme_uri . '/assets/css/vendor/splitting.css',         array(), $ver );
	wp_enqueue_style( 'edigital-socicon',        $theme_uri . '/assets/css/vendor/socicon.css',           array(), $ver );
	wp_enqueue_style( 'edigital-swiper',         $theme_uri . '/assets/css/vendor/swiper.min.css',        array(), $ver );
	wp_enqueue_style( 'edigital-custom-font',    $theme_uri . '/assets/fonts/custom-font.css',            array(), $ver );
	wp_enqueue_style( 'edigital-style',          $theme_uri . '/assets/css/style.css',                    array(), $ver );
	wp_enqueue_style( 'edigital-theme',          get_stylesheet_uri(),                                    array(), $ver );

	// Scripts — on reprend l'ordre du site statique. Ces fichiers sont bundlés dans assets/js/vendor.
	$vendor_scripts = array(
		'edigital-modernizr'   => 'assets/js/vendor/modernizr.js',
		'edigital-jquery'      => 'assets/js/vendor/jquery.min.js',
		'edigital-bootstrap'   => 'assets/js/vendor/bootstrap.min.js',
		'edigital-gsap'        => 'assets/js/vendor/gsap.min.js',
		'edigital-scrolltrig'  => 'assets/js/vendor/scrolltrigger.min.js',
		'edigital-scrollmagic' => 'assets/js/vendor/scrollmagic.js',
		'edigital-animate-sm'  => 'assets/js/vendor/animate-scrollmagic.js',
		'edigital-splittext'   => 'assets/js/vendor/splittext.js',
		'edigital-splitting'   => 'assets/js/vendor/splitting.min.js',
		'edigital-imgloaded'   => 'assets/js/vendor/imagesloaded.pkgd.min.js',
		'edigital-isotope'     => 'assets/js/vendor/isotope.pkgd.min.js',
		'edigital-justgal'     => 'assets/js/vendor/jquery.justifiedGallery.min.js',
		'edigital-jarallax'    => 'assets/js/vendor/jarallax.min.js',
		'edigital-jarallax-v'  => 'assets/js/vendor/jarallax-video.min.js',
		'edigital-lenis'       => 'assets/js/vendor/lenis.min.js',
		'edigital-magnific'    => 'assets/js/vendor/magnific-popup.js',
		'edigital-plyr'        => 'assets/js/vendor/plyr.js',
		'edigital-fslight'     => 'assets/js/vendor/fslightbox.js',
		'edigital-swiper'      => 'assets/js/vendor/swiper-bundle.min.js',
		'edigital-triple'      => 'assets/js/vendor/triple-slider.js',
		'edigital-videobg'     => 'assets/js/vendor/video-background.js',
		'edigital-smooth'      => 'assets/js/vendor/smooth-scroll.js',
		'edigital-material'    => 'assets/js/vendor/effect-material.min.js',
	);
	foreach ( $vendor_scripts as $handle => $rel ) {
		if ( file_exists( get_template_directory() . '/' . $rel ) ) {
			wp_enqueue_script( $handle, $theme_uri . '/' . $rel, array(), $ver, true );
		}
	}

	wp_enqueue_script( 'edigital-main', $theme_uri . '/assets/js/main.js', array( 'edigital-jquery' ), $ver, true );
}
add_action( 'wp_enqueue_scripts', 'edigital_enqueue_assets' );

/**
 * Widgets (barre latérale blog).
 */
function edigital_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Barre latérale Blog', 'edigital' ),
		'id'            => 'sidebar-blog',
		'description'   => __( 'Affichée sur le blog et les articles.', 'edigital' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'edigital_widgets_init' );

/**
 * Raccourci pour afficher un bandeau « fil d'info » (marquee) réutilisé par
 * plusieurs pages de service. Permet aux éditeurs d'insérer le bandeau dans
 * Gutenberg via le bloc « Shortcode ».
 *
 * Usage : [edigital_marquee items="SITES WEB, APPLICATIONS MOBILES, LOGICIELS MÉTIER"]
 */
function edigital_marquee_shortcode( $atts ) {
	$atts  = shortcode_atts( array( 'items' => '' ), $atts, 'edigital_marquee' );
	$items = array_filter( array_map( 'trim', explode( ',', $atts['items'] ) ) );

	if ( empty( $items ) ) {
		return '';
	}

	$html  = '<div class="ms-marquee project-area pt-100 pb-100"><ul class="ms-marquee__list">';
	foreach ( $items as $item ) {
		$html .= '<li class="ms-marquee__item">' . esc_html( $item ) . '</li>';
	}
	$html .= '</ul></div>';

	return $html;
}
add_shortcode( 'edigital_marquee', 'edigital_marquee_shortcode' );

/**
 * Point de contact (formulaire simple) — reprend l'endpoint de `api/send.php`
 * pour conserver la compatibilité avec l'installation existante.
 *
 * Usage : [edigital_contact_form]
 */
function edigital_contact_form_shortcode() {
	ob_start();
	?>
	<form class="edigital-contact-form" action="<?php echo esc_url( get_template_directory_uri() . '/api/send.php' ); ?>" method="post" enctype="multipart/form-data">
		<?php wp_nonce_field( 'edigital_contact', 'edigital_contact_nonce' ); ?>
		<p><label><?php esc_html_e( 'Votre nom', 'edigital' ); ?><input type="text" name="nom" required></label></p>
		<p><label><?php esc_html_e( 'Votre email', 'edigital' ); ?><input type="email" name="email" required></label></p>
		<p><label><?php esc_html_e( 'Votre message', 'edigital' ); ?><textarea name="message" rows="5" required></textarea></label></p>
		<p><button type="submit" class="ms-btn ms-btn--primary"><?php esc_html_e( 'Envoyer', 'edigital' ); ?></button></p>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'edigital_contact_form', 'edigital_contact_form_shortcode' );

/**
 * Modules du thème — chargés dans cet ordre :
 *   1. acf-helpers     : fallbacks pour get_field/update_field si ACF inactif.
 *   2. custom-post-types : CPT (slide, projet, actualite) + taxonomies.
 *   3. template-tags   : helpers d'affichage.
 *   4. acf-registry    : (optionnel) registre ACF auto-généré.
 *   5. newsletter-api  : intégration Brevo + shortcode [edigital_newsletter].
 *   6. quote-form      : formulaire de devis + shortcode [edigital_devis].
 *   7. expertise-filter: filtrage de l'archive Projets via ?expertise=slug.
 *   8. loops           : boucles WP_Query réutilisables (actualités, projets liés).
 *   9. blocks          : enregistrement des blocs Gutenberg E-Digital (build/).
 */
require_once get_template_directory() . '/inc/acf-helpers.php';
require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/slide-metabox.php';
require_once get_template_directory() . '/inc/projet-metabox.php';
require_once get_template_directory() . '/inc/template-tags.php';
if ( file_exists( get_template_directory() . '/inc/acf-registry.php' ) ) {
    require_once get_template_directory() . '/inc/acf-registry.php';
}
require_once get_template_directory() . '/inc/newsletter-api.php';
require_once get_template_directory() . '/inc/contact-form.php';
require_once get_template_directory() . '/inc/quote-form.php';
require_once get_template_directory() . '/inc/expertise-filter.php';
require_once get_template_directory() . '/inc/loops.php';
require_once get_template_directory() . '/inc/forms-style.php';
require_once get_template_directory() . '/inc/blocks.php';
require_once get_template_directory() . '/inc/services-styles.php';

/**
 * Après activation du thème, si un menu « edigital-primary » existe (créé par
 * l'import SQL), on l'assigne automatiquement à l'emplacement « primary » si
 * aucun menu n'y est déjà associé.
 */
function edigital_auto_assign_menu() {
	$menu = wp_get_nav_menu_object( 'edigital-primary' );
	if ( ! $menu ) {
		return;
	}

	$locations = get_theme_mod( 'nav_menu_locations', array() );
	if ( empty( $locations['primary'] ) ) {
		$locations['primary'] = (int) $menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}
add_action( 'after_switch_theme', 'edigital_auto_assign_menu' );

/**
 * ---------------------------------------------------------------------------
 * Compatibilité Elementor
 * ---------------------------------------------------------------------------
 *
 * Le thème est 100% éditable via Elementor sur toutes les pages.
 *
 * Emplacements disponibles (templates de page) :
 *   - "Elementor Canvas"     (elementor-canvas.php)     → page 100% vierge,
 *                                                         pas de header/footer
 *                                                         du thème. Idéal pour
 *                                                         landing pages ou
 *                                                         éditions totales avec
 *                                                         Elementor Pro (Theme
 *                                                         Builder).
 *   - "Elementor Full Width" (elementor-full-width.php) → header + footer du
 *                                                         thème, contenu sans
 *                                                         container / sidebar.
 *   - Templates par défaut (templates/page-*.php)       → fidélité HTML statique.
 */

/**
 * Déclare les emplacements Elementor Pro Theme Builder (header / footer).
 */
function edigital_register_elementor_locations( $elementor_theme_manager ) {
	$elementor_theme_manager->register_all_core_location();
}
add_action( 'elementor/theme/register_locations', 'edigital_register_elementor_locations' );

/**
 * Bascule automatiquement les pages éditées via Elementor sur un template
 * compatible (elementor-full-width.php), qui appelle the_content() — sinon
 * Elementor affiche l'erreur « Sorry, the content area was not found ».
 *
 * Les templates fidèles du HTML statique (templates/page-*.php) ne rendent
 * pas the_content(), donc quand une page passe en mode Elementor on doit
 * forcer un template qui rend le contenu. L'utilisateur peut toujours
 * sélectionner manuellement « Elementor Canvas » depuis l'admin pour un
 * rendu 100% vierge ; dans ce cas on respecte son choix.
 */
function edigital_elementor_force_template( $template ) {
	if ( ! function_exists( 'is_singular' ) || ! is_singular() ) {
		return $template;
	}
	if ( ! class_exists( '\Elementor\Plugin' ) ) {
		return $template;
	}

	$post_id = get_queried_object_id();
	if ( ! $post_id ) {
		return $template;
	}

	// On route vers un template compatible dans deux cas :
	//   1. On est DANS l'éditeur Elementor (preview ou action=elementor) — il faut
	//      un template avec the_content() pour qu'Elementor puisse s'injecter.
	//   2. Côté front, la page a du contenu Elementor réel (_elementor_data
	//      non vide). Le simple marqueur _elementor_edit_mode=builder ne suffit
	//      pas : Elementor le pose dès qu'on clique "Éditer" même si on n'a
	//      rien sauvegardé.
	$is_preview  = isset( $_GET['elementor-preview'] );
	$is_edit_req = isset( $_GET['action'] ) && 'elementor' === $_GET['action'];
	$has_content = false;
	if ( ! $is_preview && ! $is_edit_req ) {
		$data = get_post_meta( $post_id, '_elementor_data', true );
		if ( is_string( $data ) && '' !== trim( $data ) && '[]' !== trim( $data ) ) {
			$has_content = true;
		}
	}

	if ( ! $is_preview && ! $is_edit_req && ! $has_content ) {
		return $template;
	}

	// Si l'utilisateur a explicitement choisi un template Elementor -> on respecte.
	$chosen = get_page_template_slug( $post_id );
	if ( $chosen && false !== strpos( $chosen, 'elementor' ) ) {
		return $template;
	}

	// Sinon, on force le template Elementor Full Width.
	$forced = locate_template( 'elementor-full-width.php' );
	if ( $forced ) {
		return $forced;
	}
	return $template;
}
add_filter( 'template_include', 'edigital_elementor_force_template', 99 );

/**
 * Ajoute un bouton « Éditer avec Elementor » dans la barre d'admin.
 * Désactive les actions incompatibles du Customizer pour les pages gérées par
 * Elementor (utile quand on ajoute le Theme Builder).
 */
function edigital_elementor_body_class( $classes ) {
	if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
		return $classes;
	}
	if ( is_singular() ) {
		$classes[] = 'edigital-elementor-compatible';
	}
	return $classes;
}
add_filter( 'body_class', 'edigital_elementor_body_class' );

/**
 * Enregistre les assets E-Digital comme dépendances des widgets Elementor
 * custom éventuels. Cela permet à un développeur d'étendre Elementor en
 * réutilisant les styles Mokko.
 */
function edigital_elementor_enqueue_frontend_assets() {
	if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
		return;
	}
	// Les assets sont déjà chargés via edigital_enqueue_assets(). On ne fait
	// qu'exposer le handle pour les widgets custom.
}
add_action( 'elementor/frontend/before_enqueue_scripts', 'edigital_elementor_enqueue_frontend_assets' );

/**
 * Augmente la limite mémoire recommandée par Elementor (affiché dans System Info).
 */
function edigital_elementor_requirements() {
	if ( function_exists( 'wp_raise_memory_limit' ) ) {
		wp_raise_memory_limit( 'admin' );
	}
}
add_action( 'admin_init', 'edigital_elementor_requirements' );

