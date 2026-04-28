<?php
/**
 * Module Newsletter — intégration API Brevo (ex-Sendinblue).
 *
 * Configuration (à placer dans wp-config.php OU dans wp-admin Settings) :
 *
 *   define( 'EDIGITAL_BREVO_API_KEY', 'xkeysib-xxxxxxxxxxxxxxxxxxxxxxxx' );
 *   define( 'EDIGITAL_BREVO_LIST_ID', 3 );  // ID numérique de la liste
 *
 * À défaut de constantes, le module lit `edigital_brevo_api_key` /
 * `edigital_brevo_list_id` depuis les options WordPress (réglables via une
 * éventuelle page de réglages, non incluse ici).
 *
 * Front-end : insérer le shortcode `[edigital_newsletter]` ou appeler
 * directement `edigital_newsletter_form()` dans un template.
 *
 * AJAX endpoint : action `edigital_newsletter_subscribe`. Nonce obligatoire.
 *
 * Pour basculer vers Mailchimp, dupliquer `edigital_newsletter_subscribe_brevo()`
 * en `edigital_newsletter_subscribe_mailchimp()` et changer la fonction appelée
 * dans `edigital_newsletter_handle_ajax()`.
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Récupère la clé API Brevo (constante prioritaire sur option).
 */
function edigital_newsletter_get_api_key() {
	if ( defined( 'EDIGITAL_BREVO_API_KEY' ) && EDIGITAL_BREVO_API_KEY ) {
		return EDIGITAL_BREVO_API_KEY;
	}
	return get_option( 'edigital_brevo_api_key', '' );
}

/**
 * Récupère l'ID de liste Brevo cible.
 */
function edigital_newsletter_get_list_id() {
	if ( defined( 'EDIGITAL_BREVO_LIST_ID' ) && EDIGITAL_BREVO_LIST_ID ) {
		return (int) EDIGITAL_BREVO_LIST_ID;
	}
	return (int) get_option( 'edigital_brevo_list_id', 0 );
}

/**
 * Inscription d'un email à la liste Brevo.
 *
 * @param string $email   Adresse email.
 * @param array  $extra   Champs supplémentaires (FIRSTNAME, LASTNAME, etc.).
 * @return true|WP_Error
 */
function edigital_newsletter_subscribe_brevo( $email, $extra = array() ) {
	$api_key = edigital_newsletter_get_api_key();
	$list_id = edigital_newsletter_get_list_id();

	if ( ! $api_key ) {
		return new WP_Error( 'edigital_newsletter_no_api_key', __( 'Clé API Brevo manquante.', 'edigital' ) );
	}
	if ( ! $list_id ) {
		return new WP_Error( 'edigital_newsletter_no_list', __( 'ID de liste Brevo manquant.', 'edigital' ) );
	}

	$body = array(
		'email'         => $email,
		'listIds'       => array( $list_id ),
		'updateEnabled' => true,
	);
	if ( ! empty( $extra ) ) {
		$body['attributes'] = $extra;
	}

	$response = wp_remote_post( 'https://api.brevo.com/v3/contacts', array(
		'timeout' => 15,
		'headers' => array(
			'accept'       => 'application/json',
			'content-type' => 'application/json',
			'api-key'      => $api_key,
		),
		'body'    => wp_json_encode( $body ),
	) );

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$code = wp_remote_retrieve_response_code( $response );
	// Brevo : 201 = créé, 204 = mis à jour. Tout 2xx = succès.
	if ( $code >= 200 && $code < 300 ) {
		return true;
	}

	$json = json_decode( wp_remote_retrieve_body( $response ), true );
	$msg  = isset( $json['message'] ) ? $json['message'] : __( 'Réponse Brevo inattendue.', 'edigital' );
	return new WP_Error( 'edigital_newsletter_brevo_error', $msg, array( 'status' => $code ) );
}

/**
 * Gestionnaire AJAX (utilisateurs connectés ET visiteurs).
 */
function edigital_newsletter_handle_ajax() {
	check_ajax_referer( 'edigital_newsletter', 'nonce' );

	$email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	if ( ! is_email( $email ) ) {
		wp_send_json_error( array( 'message' => __( 'Adresse email invalide.', 'edigital' ) ), 400 );
	}

	$extra = array();
	if ( ! empty( $_POST['firstname'] ) ) {
		$extra['FIRSTNAME'] = sanitize_text_field( wp_unslash( $_POST['firstname'] ) );
	}

	$result = edigital_newsletter_subscribe_brevo( $email, $extra );
	if ( is_wp_error( $result ) ) {
		wp_send_json_error( array( 'message' => $result->get_error_message() ), 500 );
	}

	wp_send_json_success( array( 'message' => __( 'Merci ! Votre inscription est confirmée.', 'edigital' ) ) );
}
add_action( 'wp_ajax_edigital_newsletter_subscribe',        'edigital_newsletter_handle_ajax' );
add_action( 'wp_ajax_nopriv_edigital_newsletter_subscribe', 'edigital_newsletter_handle_ajax' );

/**
 * Formulaire HTML (rendu).
 */
function edigital_newsletter_form( $atts = array() ) {
	$atts = wp_parse_args( $atts, array(
		'titre'       => __( 'Inscrivez-vous à la newsletter', 'edigital' ),
		'placeholder' => __( 'Votre adresse email', 'edigital' ),
		'cta'         => __( 'Je m\'inscris', 'edigital' ),
	) );

	ob_start();
	?>
	<form class="edigital-newsletter-form" data-edigital-newsletter>
		<?php if ( $atts['titre'] ) : ?>
			<p class="edigital-newsletter-form__titre"><?php echo esc_html( $atts['titre'] ); ?></p>
		<?php endif; ?>
		<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'edigital_newsletter' ) ); ?>">
		<div class="edigital-newsletter-form__row">
			<input type="email" name="email" required placeholder="<?php echo esc_attr( $atts['placeholder'] ); ?>">
			<button type="submit"><?php echo esc_html( $atts['cta'] ); ?></button>
		</div>
		<p class="edigital-newsletter-form__feedback" role="status" aria-live="polite"></p>
	</form>
	<?php
	return ob_get_clean();
}

/**
 * Shortcode : [edigital_newsletter titre="..." cta="..."]
 */
function edigital_newsletter_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'titre'       => __( 'Inscrivez-vous à la newsletter', 'edigital' ),
		'placeholder' => __( 'Votre adresse email', 'edigital' ),
		'cta'         => __( 'Je m\'inscris', 'edigital' ),
	), $atts, 'edigital_newsletter' );
	return edigital_newsletter_form( $atts );
}
add_shortcode( 'edigital_newsletter', 'edigital_newsletter_shortcode' );

/**
 * JS d'inscription (chargé inline pour éviter un fichier supplémentaire).
 */
function edigital_newsletter_inline_script() {
	?>
	<script>
	(function () {
		var endpoint = '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>';
		document.addEventListener('submit', function (e) {
			var form = e.target.closest('[data-edigital-newsletter]');
			if (!form) return;
			e.preventDefault();
			var fb = form.querySelector('.edigital-newsletter-feedback')
			      || form.querySelector('.edigital-newsletter-form__feedback');
			if (!fb) {
				fb = document.createElement('p');
				fb.className = 'edigital-newsletter-feedback';
				form.appendChild(fb);
			}
			var data = new FormData(form);
			data.append('action', 'edigital_newsletter_subscribe');
			fb.textContent = '...';
			fetch(endpoint, { method: 'POST', body: data, credentials: 'same-origin' })
				.then(function (r) { return r.json(); })
				.then(function (r) {
					fb.textContent = r && r.data && r.data.message ? r.data.message : 'OK';
					if (r && r.success) form.reset();
				})
				.catch(function () { fb.textContent = 'Erreur réseau.'; });
		});
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'edigital_newsletter_inline_script' );
