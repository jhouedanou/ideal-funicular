<?php
/**
 * Metabox native pour le CPT « projet ».
 *
 * Permet d'éditer les champs affichés dans single-projet.php :
 *   client_nom            (string)
 *   projet_categorie      (string)
 *   projet_technologies   (string)
 *   projet_date           (string libre, ex: "Mars 2025")
 *   projet_lien_live      (URL)
 *   projet_contexte       (textarea / wysiwyg simple)
 *   projet_approche       (textarea / wysiwyg simple)
 *   projet_resultat       (textarea / wysiwyg simple)
 *   projet_citation       (textarea)
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── Enregistrement de la metabox ──────────────────────────────────────────

add_action( 'add_meta_boxes', 'edigital_projet_register_metabox' );
function edigital_projet_register_metabox() {
	add_meta_box(
		'edigital_projet_details',
		__( 'Détails du Projet', 'edigital' ),
		'edigital_projet_metabox_cb',
		'projet',
		'normal',
		'high'
	);
}

// ─── Rendu de la metabox ───────────────────────────────────────────────────

function edigital_projet_metabox_cb( $post ) {
	wp_nonce_field( 'edigital_projet_save', 'edigital_projet_nonce' );

	$client       = (string) get_post_meta( $post->ID, 'client_nom', true );
	$categorie    = (string) get_post_meta( $post->ID, 'projet_categorie', true );
	$technologies = (string) get_post_meta( $post->ID, 'projet_technologies', true );
	$date         = (string) get_post_meta( $post->ID, 'projet_date', true );
	$lien_live    = (string) get_post_meta( $post->ID, 'projet_lien_live', true );
	$contexte     = (string) get_post_meta( $post->ID, 'projet_contexte', true );
	$approche     = (string) get_post_meta( $post->ID, 'projet_approche', true );
	$resultat     = (string) get_post_meta( $post->ID, 'projet_resultat', true );
	$citation     = (string) get_post_meta( $post->ID, 'projet_citation', true );
	?>
	<style>
		.edigital-projet-meta { display: grid; grid-template-columns: 1fr 1fr; gap: 16px 24px; }
		.edigital-projet-meta .full { grid-column: 1 / -1; }
		.edigital-projet-meta label { display: block; font-weight: 600; margin-bottom: 4px; }
		.edigital-projet-meta input[type="text"],
		.edigital-projet-meta input[type="url"],
		.edigital-projet-meta textarea { width: 100%; }
		.edigital-projet-meta textarea { min-height: 90px; }
		.edigital-projet-meta .description { color: #666; font-size: 12px; margin-top: 4px; }
	</style>

	<div class="edigital-projet-meta">
		<div>
			<label for="edigital_client_nom"><?php esc_html_e( 'Client', 'edigital' ); ?></label>
			<input type="text" id="edigital_client_nom" name="edigital_client_nom" value="<?php echo esc_attr( $client ); ?>" />
		</div>

		<div>
			<label for="edigital_projet_categorie"><?php esc_html_e( 'Catégorie', 'edigital' ); ?></label>
			<input type="text" id="edigital_projet_categorie" name="edigital_projet_categorie" value="<?php echo esc_attr( $categorie ); ?>" />
		</div>

		<div>
			<label for="edigital_projet_technologies"><?php esc_html_e( 'Technologies', 'edigital' ); ?></label>
			<input type="text" id="edigital_projet_technologies" name="edigital_projet_technologies" value="<?php echo esc_attr( $technologies ); ?>" placeholder="WordPress, React, CSS3" />
		</div>

		<div>
			<label for="edigital_projet_date"><?php esc_html_e( 'Date (texte libre)', 'edigital' ); ?></label>
			<input type="text" id="edigital_projet_date" name="edigital_projet_date" value="<?php echo esc_attr( $date ); ?>" placeholder="Mars 2025" />
			<p class="description"><?php esc_html_e( 'Si vide, la date de publication sera utilisée.', 'edigital' ); ?></p>
		</div>

		<div class="full">
			<label for="edigital_projet_lien_live"><?php esc_html_e( 'Lien « Voir le Site Live »', 'edigital' ); ?></label>
			<input type="url" id="edigital_projet_lien_live" name="edigital_projet_lien_live" value="<?php echo esc_attr( $lien_live ); ?>" placeholder="https://..." />
		</div>

		<div class="full">
			<label for="edigital_projet_contexte"><?php esc_html_e( 'Le Contexte du Projet', 'edigital' ); ?></label>
			<textarea id="edigital_projet_contexte" name="edigital_projet_contexte"><?php echo esc_textarea( $contexte ); ?></textarea>
		</div>

		<div class="full">
			<label for="edigital_projet_approche"><?php esc_html_e( 'Notre Approche & Solution', 'edigital' ); ?></label>
			<textarea id="edigital_projet_approche" name="edigital_projet_approche"><?php echo esc_textarea( $approche ); ?></textarea>
		</div>

		<div class="full">
			<label for="edigital_projet_citation"><?php esc_html_e( 'Citation (encadré)', 'edigital' ); ?></label>
			<textarea id="edigital_projet_citation" name="edigital_projet_citation" rows="3"><?php echo esc_textarea( $citation ); ?></textarea>
		</div>

		<div class="full">
			<label for="edigital_projet_resultat"><?php esc_html_e( 'Le Résultat', 'edigital' ); ?></label>
			<textarea id="edigital_projet_resultat" name="edigital_projet_resultat"><?php echo esc_textarea( $resultat ); ?></textarea>
		</div>
	</div>

	<p class="description" style="margin-top:16px;">
		<?php esc_html_e( 'Astuce : les champs « Contexte / Approche / Citation / Résultat » ne sont utilisés que si le contenu principal de l\'article est vide.', 'edigital' ); ?>
	</p>
	<?php
}

// ─── Sauvegarde ────────────────────────────────────────────────────────────

add_action( 'save_post_projet', 'edigital_projet_save_meta', 10, 2 );
function edigital_projet_save_meta( $post_id, $post ) {
	if ( ! isset( $_POST['edigital_projet_nonce'] ) ||
		! wp_verify_nonce( $_POST['edigital_projet_nonce'], 'edigital_projet_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$text_fields = array(
		'edigital_client_nom'          => 'client_nom',
		'edigital_projet_categorie'    => 'projet_categorie',
		'edigital_projet_technologies' => 'projet_technologies',
		'edigital_projet_date'         => 'projet_date',
	);
	foreach ( $text_fields as $input => $meta ) {
		$value = isset( $_POST[ $input ] ) ? sanitize_text_field( wp_unslash( $_POST[ $input ] ) ) : '';
		if ( '' === $value ) {
			delete_post_meta( $post_id, $meta );
		} else {
			update_post_meta( $post_id, $meta, $value );
		}
	}

	// URL
	$lien = isset( $_POST['edigital_projet_lien_live'] ) ? esc_url_raw( wp_unslash( $_POST['edigital_projet_lien_live'] ) ) : '';
	if ( '' === $lien ) {
		delete_post_meta( $post_id, 'projet_lien_live' );
	} else {
		update_post_meta( $post_id, 'projet_lien_live', $lien );
	}

	// Textareas (HTML simple autorisé)
	$textarea_fields = array(
		'edigital_projet_contexte' => 'projet_contexte',
		'edigital_projet_approche' => 'projet_approche',
		'edigital_projet_resultat' => 'projet_resultat',
		'edigital_projet_citation' => 'projet_citation',
	);
	foreach ( $textarea_fields as $input => $meta ) {
		$value = isset( $_POST[ $input ] ) ? wp_kses_post( wp_unslash( $_POST[ $input ] ) ) : '';
		if ( '' === $value ) {
			delete_post_meta( $post_id, $meta );
		} else {
			update_post_meta( $post_id, $meta, $value );
		}
	}
}
