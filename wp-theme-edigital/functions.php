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

require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Inclusion du registre ACF regénéré automatiquement
 */
if ( file_exists( get_template_directory() . '/inc/acf-registry.php' ) ) {
    require_once get_template_directory() . '/inc/acf-registry.php';
}

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
 * Register Custom Post Type: Projets
 */
function edigital_register_cpt_projet() {
     = array(
        'name'                  => _x( 'Projets', 'Post Type General Name', 'edigital' ),
        'singular_name'         => _x( 'Projet', 'Post Type Singular Name', 'edigital' ),
        'menu_name'             => __( 'Projets', 'edigital' ),
        'name_admin_bar'        => __( 'Projet', 'edigital' ),
        'all_items'             => __( 'Tous les projets', 'edigital' ),
        'add_new_item'          => __( 'Ajouter un nouveau projet', 'edigital' ),
        'add_new'               => __( 'Ajouter', 'edigital' ),
        'new_item'              => __( 'Nouveau projet', 'edigital' ),
        'edit_item'             => __( 'Modifier le projet', 'edigital' ),
        'update_item'           => __( 'Mettre à jour le projet', 'edigital' ),
        'view_item'             => __( 'Voir le projet', 'edigital' ),
        'search_items'          => __( 'Rechercher un projet', 'edigital' ),
    );
     = array(
        'label'                 => __( 'Projet', 'edigital' ),
        'description'           => __( 'Portfolio de nos projets', 'edigital' ),
        'labels'                => ,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'nos-projets',
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'projet',  );
}
add_action( 'init', 'edigital_register_cpt_projet', 0 );
