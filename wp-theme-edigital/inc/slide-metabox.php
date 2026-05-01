<?php
/**
 * Metabox native pour le CPT « slide » — affiché uniquement si ACF n'est pas actif.
 *
 * Champs gérés (format compatible avec acf-registry.php) :
 *   slide_titre       (string, <br> autorisé)
 *   slide_sous_titre  (string)
 *   slide_type_media  (image | video)
 *   slide_image       (array : id, url, alt  — même format que ACF return_format=array)
 *   slide_video       (array : id, url        — même format que ACF return_format=array)
 *   slide_luminosite  (float 0–1)
 *   slide_btn_texte   (string)
 *   slide_btn_lien    (URL)
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── Enregistrement de la metabox ──────────────────────────────────────────

add_action( 'add_meta_boxes', 'edigital_slide_register_metabox' );
function edigital_slide_register_metabox() {
	// Laisser ACF gérer si le plugin est actif
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	add_meta_box(
		'edigital_slide_content',
		__( 'Contenu de la slide', 'edigital' ),
		'edigital_slide_metabox_cb',
		'slide',
		'normal',
		'high'
	);
}

// ─── Enqueue scripts (media uploader) ──────────────────────────────────────

add_action( 'admin_enqueue_scripts', 'edigital_slide_enqueue_media_scripts' );
function edigital_slide_enqueue_media_scripts( $hook ) {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	$screen = get_current_screen();
	if ( ! $screen || 'slide' !== $screen->post_type ) {
		return;
	}
	wp_enqueue_media();
}

// ─── Rendu de la metabox ────────────────────────────────────────────────────

function edigital_slide_metabox_cb( WP_Post $post ) {
	wp_nonce_field( 'edigital_slide_save_' . $post->ID, 'edigital_slide_nonce' );

	$type_media = get_post_meta( $post->ID, 'slide_type_media', true ) ?: 'image';
	$image      = get_post_meta( $post->ID, 'slide_image',      true );
	$video      = get_post_meta( $post->ID, 'slide_video',      true );
	$luminosite = get_post_meta( $post->ID, 'slide_luminosite', true );
	$luminosite = ( '' !== $luminosite ) ? floatval( $luminosite ) : 0.4;
	$titre      = get_post_meta( $post->ID, 'slide_titre',      true );
	$sous_titre = get_post_meta( $post->ID, 'slide_sous_titre', true );
	$btn_texte  = get_post_meta( $post->ID, 'slide_btn_texte',  true );
	$btn_lien   = get_post_meta( $post->ID, 'slide_btn_lien',   true );

	$image_id  = is_array( $image ) ? intval( $image['id'] ?? 0 )  : 0;
	$image_url = is_array( $image ) ? ( $image['url'] ?? '' )       : '';
	$video_id  = is_array( $video ) ? intval( $video['id'] ?? 0 )  : 0;
	$video_url = is_array( $video ) ? ( $video['url'] ?? '' )       : '';

	$is_video = 'video' === $type_media;
	?>
	<style>
		#edigital_slide_content .edigital-mb { display:grid; grid-template-columns:1fr 1fr; gap:16px 28px; }
		#edigital_slide_content .full        { grid-column:1/-1; }
		#edigital_slide_content label        { display:block; font-weight:600; margin-bottom:4px; }
		#edigital_slide_content label small  { font-weight:400; }
		#edigital_slide_content input[type=text],
		#edigital_slide_content input[type=url],
		#edigital_slide_content input[type=number],
		#edigital_slide_content select       { width:100%; }
		.edsm-preview-img  { margin-top:8px; max-width:100%; max-height:130px; display:block; border-radius:4px; object-fit:cover; }
		.edsm-video-label  { margin-top:8px; font-style:italic; font-size:13px; }
	</style>

	<div class="edigital-mb" id="edsm-wrap">

		<!-- Titre -->
		<div class="full">
			<label for="edsm_titre">
				<?php esc_html_e( 'Titre principal', 'edigital' ); ?>
				<small> — accepte <code>&lt;br/&gt;</code> pour forcer un retour à la ligne</small>
			</label>
			<input type="text" id="edsm_titre" name="slide_titre"
				value="<?php echo esc_attr( $titre ); ?>" />
		</div>

		<!-- Sous-titre -->
		<div class="full">
			<label for="edsm_sous_titre"><?php esc_html_e( 'Sous-titre / accroche', 'edigital' ); ?></label>
			<input type="text" id="edsm_sous_titre" name="slide_sous_titre"
				value="<?php echo esc_attr( $sous_titre ); ?>" />
		</div>

		<!-- Type de média -->
		<div>
			<label for="edsm_type_media"><?php esc_html_e( 'Type de fond', 'edigital' ); ?></label>
			<select id="edsm_type_media" name="slide_type_media">
				<option value="image" <?php selected( $type_media, 'image' ); ?>><?php esc_html_e( 'Image', 'edigital' ); ?></option>
				<option value="video" <?php selected( $type_media, 'video' ); ?>><?php esc_html_e( 'Vidéo (MP4 / WebM)', 'edigital' ); ?></option>
			</select>
		</div>

		<!-- Luminosité -->
		<div>
			<label for="edsm_luminosite">
				<?php esc_html_e( 'Luminosité du fond', 'edigital' ); ?>
				<small> (0 = noir, 1 = original)</small>
			</label>
			<input type="number" id="edsm_luminosite" name="slide_luminosite"
				value="<?php echo esc_attr( $luminosite ); ?>"
				min="0" max="1" step="0.05" />
		</div>

		<!-- Image de fond -->
		<div id="edsm-image-block"<?php echo $is_video ? ' style="display:none"' : ''; ?>>
			<label><?php esc_html_e( 'Image de fond', 'edigital' ); ?></label>
			<input type="hidden" id="edsm_image_id"  name="slide_image_id"  value="<?php echo esc_attr( $image_id ); ?>" />
			<input type="hidden" id="edsm_image_url" name="slide_image_url" value="<?php echo esc_url( $image_url ); ?>" />
			<?php if ( $image_url ) : ?>
				<img id="edsm-img-preview" class="edsm-preview-img"
					src="<?php echo esc_url( $image_url ); ?>" alt="" />
			<?php else : ?>
				<img id="edsm-img-preview" class="edsm-preview-img" src="" alt=""
					style="display:none" />
			<?php endif; ?>
			<br>
			<button type="button" class="button" id="edsm-img-choose">
				<?php esc_html_e( 'Choisir une image', 'edigital' ); ?>
			</button>
			<button type="button" class="button" id="edsm-img-remove"
				<?php echo ! $image_url ? 'style="display:none"' : ''; ?>>
				<?php esc_html_e( 'Supprimer', 'edigital' ); ?>
			</button>
		</div>

		<!-- Vidéo de fond -->
		<div id="edsm-video-block"<?php echo ! $is_video ? ' style="display:none"' : ''; ?>>
			<label><?php esc_html_e( 'Vidéo de fond (MP4 / WebM)', 'edigital' ); ?></label>
			<input type="hidden" id="edsm_video_id"  name="slide_video_id"  value="<?php echo esc_attr( $video_id ); ?>" />
			<input type="hidden" id="edsm_video_url" name="slide_video_url" value="<?php echo esc_url( $video_url ); ?>" />
			<?php if ( $video_url ) : ?>
				<p id="edsm-video-label" class="edsm-video-label">
					<?php echo esc_html( basename( $video_url ) ); ?>
				</p>
			<?php else : ?>
				<p id="edsm-video-label" class="edsm-video-label" style="display:none"></p>
			<?php endif; ?>
			<button type="button" class="button" id="edsm-vid-choose">
				<?php esc_html_e( 'Choisir une vidéo', 'edigital' ); ?>
			</button>
			<button type="button" class="button" id="edsm-vid-remove"
				<?php echo ! $video_url ? 'style="display:none"' : ''; ?>>
				<?php esc_html_e( 'Supprimer', 'edigital' ); ?>
			</button>
		</div>

		<!-- Bouton CTA -->
		<div>
			<label for="edsm_btn_texte"><?php esc_html_e( 'Texte du bouton', 'edigital' ); ?></label>
			<input type="text" id="edsm_btn_texte" name="slide_btn_texte"
				value="<?php echo esc_attr( $btn_texte ); ?>" />
		</div>

		<div>
			<label for="edsm_btn_lien"><?php esc_html_e( 'Lien du bouton', 'edigital' ); ?></label>
			<input type="url" id="edsm_btn_lien" name="slide_btn_lien"
				value="<?php echo esc_attr( $btn_lien ); ?>"
				placeholder="https://" />
		</div>

	</div><!-- .edigital-mb -->

	<script>
	(function($){
		// Afficher / masquer image ou vidéo selon le type sélectionné
		$('#edsm_type_media').on('change', function(){
			var isVideo = $(this).val() === 'video';
			$('#edsm-image-block').toggle( ! isVideo );
			$('#edsm-video-block').toggle( isVideo );
		});

		/* ---- Sélecteur d'image ---- */
		var imgFrame;
		$('#edsm-img-choose').on('click', function(e){
			e.preventDefault();
			if ( imgFrame ) { imgFrame.open(); return; }
			imgFrame = wp.media({
				title   : <?php echo wp_json_encode( __( "Choisir l'image de fond", 'edigital' ) ); ?>,
				button  : { text: <?php echo wp_json_encode( __( 'Utiliser cette image', 'edigital' ) ); ?> },
				multiple: false,
				library : { type: 'image' }
			});
			imgFrame.on('select', function(){
				var att = imgFrame.state().get('selection').first().toJSON();
				var url = att.sizes && att.sizes.large ? att.sizes.large.url : att.url;
				$('#edsm_image_id').val( att.id );
				$('#edsm_image_url').val( url );
				$('#edsm-img-preview').attr('src', url).show();
				$('#edsm-img-remove').show();
			});
			imgFrame.open();
		});
		$('#edsm-img-remove').on('click', function(){
			$('#edsm_image_id, #edsm_image_url').val('');
			$('#edsm-img-preview').attr('src','').hide();
			$(this).hide();
		});

		/* ---- Sélecteur de vidéo ---- */
		var vidFrame;
		$('#edsm-vid-choose').on('click', function(e){
			e.preventDefault();
			if ( vidFrame ) { vidFrame.open(); return; }
			vidFrame = wp.media({
				title   : <?php echo wp_json_encode( __( 'Choisir la vidéo de fond', 'edigital' ) ); ?>,
				button  : { text: <?php echo wp_json_encode( __( 'Utiliser cette vidéo', 'edigital' ) ); ?> },
				multiple: false,
				library : { type: 'video' }
			});
			vidFrame.on('select', function(){
				var att = vidFrame.state().get('selection').first().toJSON();
				$('#edsm_video_id').val( att.id );
				$('#edsm_video_url').val( att.url );
				$('#edsm-video-label').text( att.filename || att.url ).show();
				$('#edsm-vid-remove').show();
			});
			vidFrame.open();
		});
		$('#edsm-vid-remove').on('click', function(){
			$('#edsm_video_id, #edsm_video_url').val('');
			$('#edsm-video-label').text('').hide();
			$(this).hide();
		});
	})(jQuery);
	</script>
	<?php
}

// ─── Sauvegarde des données ─────────────────────────────────────────────────

add_action( 'save_post_slide', 'edigital_slide_save_meta' );
function edigital_slide_save_meta( int $post_id ) {
	// Laisser ACF gérer si le plugin est actif
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! isset( $_POST['edigital_slide_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce(
		sanitize_text_field( wp_unslash( $_POST['edigital_slide_nonce'] ) ),
		'edigital_slide_save_' . $post_id
	) ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	// Titre : on autorise uniquement <br> (même logique que le template)
	if ( isset( $_POST['slide_titre'] ) ) {
		update_post_meta(
			$post_id,
			'slide_titre',
			wp_kses( wp_unslash( $_POST['slide_titre'] ), array( 'br' => array() ) )
		);
	}

	// Champs texte simples
	$text_fields = array( 'slide_sous_titre', 'slide_btn_texte' );
	foreach ( $text_fields as $key ) {
		if ( isset( $_POST[ $key ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
		}
	}

	// Type de média
	$type_media = isset( $_POST['slide_type_media'] )
		? sanitize_key( wp_unslash( $_POST['slide_type_media'] ) )
		: 'image';
	if ( ! in_array( $type_media, array( 'image', 'video' ), true ) ) {
		$type_media = 'image';
	}
	update_post_meta( $post_id, 'slide_type_media', $type_media );

	// Luminosité
	if ( isset( $_POST['slide_luminosite'] ) ) {
		$lum = min( 1.0, max( 0.0, floatval( wp_unslash( $_POST['slide_luminosite'] ) ) ) );
		update_post_meta( $post_id, 'slide_luminosite', $lum );
	}

	// Lien bouton
	if ( isset( $_POST['slide_btn_lien'] ) ) {
		update_post_meta( $post_id, 'slide_btn_lien', esc_url_raw( wp_unslash( $_POST['slide_btn_lien'] ) ) );
	}

	// Image — stockée en tableau {id, url, alt} comme le retourne ACF (return_format=array)
	$image_id  = absint( $_POST['slide_image_id']  ?? 0 );
	$image_url = esc_url_raw( wp_unslash( $_POST['slide_image_url'] ?? '' ) );
	if ( $image_id && $image_url ) {
		$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		update_post_meta( $post_id, 'slide_image', array(
			'id'  => $image_id,
			'url' => $image_url,
			'alt' => (string) $alt,
		) );
	} else {
		delete_post_meta( $post_id, 'slide_image' );
	}

	// Vidéo — stockée en tableau {id, url} comme le retourne ACF (return_format=array)
	$video_id  = absint( $_POST['slide_video_id']  ?? 0 );
	$video_url = esc_url_raw( wp_unslash( $_POST['slide_video_url'] ?? '' ) );
	if ( $video_id && $video_url ) {
		update_post_meta( $post_id, 'slide_video', array(
			'id'  => $video_id,
			'url' => $video_url,
		) );
	} else {
		delete_post_meta( $post_id, 'slide_video' );
	}
}
