<?php
/**
 * Script d'import des slides du template HTML vers le CPT "slide" WordPress.
 * Usage : wp eval-file import-slides.php
 *
 * Pré-requis : ACF activé, CPT "slide" enregistré, images uploadées dans la médiathèque.
 * Les images sont cherchées par nom de fichier dans la médiathèque. Si elles n'existent pas,
 * elles sont téléchargées depuis le dossier assets/ via le chemin local ou l'URL du site.
 */

defined( 'ABSPATH' ) || exit;

$slides = [
    [
        'title'      => 'Participe à la croissance',
        'type_media' => 'image',
        'image_file' => 'freepik__a-modern-corporate-digital-agency-environment-in-p__12968.png',
        'luminosite'  => 40,
        'titre'      => 'Participe à la<br>croissance',
        'sous_titre' => 'des TPE et PME',
        'btn_texte'  => 'Accéder à nos services',
        'btn_lien'   => '/services',
        'order'      => 1,
    ],
    [
        'title'      => "L'Agence E-digital – Budget maîtrisé",
        'type_media' => 'image',
        'image_file' => 'freepik__a-modern-corporate-tech-environment-focused-on-mob__3922.png',
        'luminosite'  => 40,
        'titre'      => "L'Agence<br>E-digital",
        'sous_titre' => 'Budget maîtrisé pour CMS, CRM, ERP, Prestashop',
        'btn_texte'  => 'Nos solutions',
        'btn_lien'   => '/services',
        'order'      => 2,
    ],
    [
        'title'      => "L'Agence E-digital – Intelligence Artificielle",
        'type_media' => 'image',
        'image_file' => 'ChatGPT Image 22 mars 2026, 17_10_12.png',
        'luminosite'  => 40,
        'titre'      => "L'Agence<br>E-digital",
        'sous_titre' => 'Budget maîtrisé pour CMS, CRM, ERP, Prestashop',
        'btn_texte'  => 'Nos solutions',
        'btn_lien'   => '/services',
        'order'      => 3,
    ],
    [
        'title'      => 'Des solutions pour votre succès',
        'type_media' => 'video',
        'video_url'  => 'assets/images/slider/freepik_create-a-video_seedance_720p_16-9_24fps_3921.mp4',
        'luminosite'  => 40,
        'titre'      => "Des solutions<br>pour votre succès",
        'sous_titre' => 'Conception et développement web innovant depuis 2003',
        'btn_texte'  => 'En savoir plus',
        'btn_lien'   => '#services',
        'order'      => 4,
    ],
];

// Chemin local des assets du template HTML (ajuster si nécessaire)
$assets_dir = dirname( __FILE__ ) . '/assets/images/slider/';

foreach ( $slides as $slide_data ) {

    // Éviter les doublons
    $existing = get_posts( [
        'post_type'   => 'slide',
        'title'       => $slide_data['title'],
        'post_status' => 'any',
        'numberposts' => 1,
    ] );
    if ( $existing ) {
        WP_CLI::log( "⏭  Slide déjà existante : {$slide_data['title']}" );
        continue;
    }

    $post_id = wp_insert_post( [
        'post_type'   => 'slide',
        'post_title'  => $slide_data['title'],
        'post_status' => 'publish',
        'menu_order'  => $slide_data['order'],
    ] );

    if ( is_wp_error( $post_id ) ) {
        WP_CLI::warning( "Erreur création slide : " . $post_id->get_error_message() );
        continue;
    }

    // Champs ACF (stockés en post meta — fonctionne avec ou sans ACF actif)
    $acf = function_exists( 'update_field' ) ? 'update_field' : 'update_post_meta';
    $acf( 'slide_type_media', $slide_data['type_media'], $post_id );
    $acf( 'slide_luminosite', $slide_data['luminosite'], $post_id );
    $acf( 'slide_titre',      $slide_data['titre'],      $post_id );
    $acf( 'slide_sous_titre', $slide_data['sous_titre'], $post_id );
    $acf( 'slide_btn_texte',  $slide_data['btn_texte'],  $post_id );
    $acf( 'slide_btn_lien',   $slide_data['btn_lien'],   $post_id );

    if ( $slide_data['type_media'] === 'image' ) {

        $filename   = $slide_data['image_file'];
        $attachment = get_posts( [
            'post_type'   => 'attachment',
            'post_status' => 'inherit',
            'meta_query'  => [ [
                'key'     => '_wp_attached_file',
                'value'   => $filename,
                'compare' => 'LIKE',
            ] ],
            'numberposts' => 1,
        ] );

        if ( $attachment ) {
            $att_id = $attachment[0]->ID;
            WP_CLI::log( "  Image trouvée en médiathèque : $filename (ID $att_id)" );
        } else {
            // Tenter d'importer depuis le dossier local
            $local_path = $assets_dir . $filename;
            if ( file_exists( $local_path ) ) {
                require_once ABSPATH . 'wp-admin/includes/file.php';
                require_once ABSPATH . 'wp-admin/includes/image.php';
                require_once ABSPATH . 'wp-admin/includes/media.php';

                $att_id = media_handle_sideload( [
                    'name'     => $filename,
                    'tmp_name' => $local_path,
                ], $post_id );

                if ( is_wp_error( $att_id ) ) {
                    WP_CLI::warning( "  Impossible d'importer l'image $filename : " . $att_id->get_error_message() );
                    $att_id = 0;
                } else {
                    WP_CLI::log( "  Image importée : $filename (ID $att_id)" );
                }
            } else {
                WP_CLI::warning( "  Image introuvable (médiathèque et local) : $filename" );
                $att_id = 0;
            }
        }

        if ( $att_id ) {
            $acf( 'slide_image', $att_id, $post_id );
        }

    } elseif ( $slide_data['type_media'] === 'video' ) {
        $acf( 'slide_video', $slide_data['video_url'], $post_id );
        WP_CLI::log( "  Vidéo référencée : {$slide_data['video_url']}" );
    }

    WP_CLI::success( "Slide créée (ID $post_id) : {$slide_data['title']}" );
}

WP_CLI::success( 'Import terminé.' );
