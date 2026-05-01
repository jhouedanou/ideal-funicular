<?php
/**
 * Formulaire de demande de devis — Homepage.
 *
 * - Rendu via shortcode `[edigital_devis]` ou appel direct
 *   `edigital_quote_form()` dans un template.
 * - Pré-remplissage du champ « service » via le paramètre d'URL `?service=slug`
 *   (ex. depuis un bouton « Demander un devis » d'une page service).
 * - Soumission AJAX vers l'action `edigital_quote_submit` qui envoie un email à
 *   l'admin via `wp_mail()`.
 *
 * Configuration optionnelle :
 *   define( 'EDIGITAL_QUOTE_RECIPIENT', 'devis@exemple.fr' );
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Liste des services proposés (slug => label). Centralisée pour rester en
 * cohérence avec les pages de service du thème.
 */
function edigital_quote_services() {
	return array(
		'creation-web'         => __( 'Conception Web sur Mesure', 'edigital' ),
		'mobile-native'        => __( 'Applications Mobiles', 'edigital' ),
		'app-metier'           => __( 'Logiciels Métier', 'edigital' ),
		'branding'             => __( 'Branding & Identité', 'edigital' ),
		'visibilite-seo'       => __( 'Visibilité SEO', 'edigital' ),
		'visibilite-google-ads' => __( 'Google Ads', 'edigital' ),
		'maintenance'          => __( 'Maintenance', 'edigital' ),
	);
}

/**
 * Rendu du formulaire (HTML).
 *
 * Depuis la migration de la page Contact, le formulaire multi-étapes vit
 * sur la page /contact/. Ce shortcode/fonction rend désormais un bloc CTA
 * qui redirige l'utilisateur vers cette page.
 *
 * Le paramètre ?service=slug est transmis à la page contact afin de
 * pré-sélectionner le service correspondant dans le formulaire.
 */
function edigital_quote_form( $atts = array() ) {
	$atts = wp_parse_args( $atts, array(
		'titre'    => __( 'Demander un devis', 'edigital' ),
		'subtitle' => __( 'Remplissez notre formulaire en 3 étapes et recevez une étude personnalisée.', 'edigital' ),
	) );

	// Résolution de l'URL de la page contact.
	$contact_page = get_page_by_path( 'contact' );
	$contact_url  = $contact_page ? get_permalink( $contact_page ) : home_url( '/contact/' );

	// Transmission du service pré-sélectionné si présent.
	$preselect_slug = isset( $_GET['service'] ) ? sanitize_title( wp_unslash( $_GET['service'] ) ) : '';
	if ( $preselect_slug ) {
		$contact_url = add_query_arg( 'service', $preselect_slug, $contact_url );
	}

	ob_start();
	?>
	<div class="edigital-devis-cta">
		<?php if ( $atts['titre'] ) : ?>
		<h3 class="edigital-devis-cta__titre"><?php echo esc_html( $atts['titre'] ); ?></h3>
		<?php endif; ?>
		<?php if ( $atts['subtitle'] ) : ?>
		<p class="edigital-devis-cta__sub"><?php echo esc_html( $atts['subtitle'] ); ?></p>
		<?php endif; ?>
		<a class="btn btn-mokko btn--lg btn--primary edigital-devis-cta__btn"
			href="<?php echo esc_url( $contact_url ); ?>">
			<div class="ms-btn__text"><?php esc_html_e( 'Accéder au formulaire →', 'edigital' ); ?></div>
		</a>
	</div>
	<?php
	return ob_get_clean();
}

function edigital_quote_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'titre' => __( 'Demander un devis', 'edigital' ),
	), $atts, 'edigital_devis' );
	return edigital_quote_form( $atts );
}
add_shortcode( 'edigital_devis', 'edigital_quote_shortcode' );

/**
 * Récupère l'adresse de réception des demandes de devis.
 */
function edigital_quote_recipient() {
	if ( defined( 'EDIGITAL_QUOTE_RECIPIENT' ) && EDIGITAL_QUOTE_RECIPIENT ) {
		return EDIGITAL_QUOTE_RECIPIENT;
	}
	return get_option( 'admin_email' );
}

/**
 * Endpoint AJAX (utilisateurs et visiteurs).
 */
function edigital_quote_handle_ajax() {
	check_ajax_referer( 'edigital_quote', 'nonce' );

	$service  = isset( $_POST['service'] ) ? sanitize_title( wp_unslash( $_POST['service'] ) ) : '';
	$name     = isset( $_POST['name'] )    ? sanitize_text_field( wp_unslash( $_POST['name'] ) )    : '';
	$email    = isset( $_POST['email'] )   ? sanitize_email( wp_unslash( $_POST['email'] ) )         : '';
	$phone    = isset( $_POST['phone'] )   ? sanitize_text_field( wp_unslash( $_POST['phone'] ) )   : '';
	$budget   = isset( $_POST['budget'] )  ? sanitize_text_field( wp_unslash( $_POST['budget'] ) )  : '';
	$message  = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( ! $name || ! is_email( $email ) || ! $message ) {
		wp_send_json_error( array( 'message' => __( 'Champs obligatoires manquants.', 'edigital' ) ), 400 );
	}

	$services = edigital_quote_services();
	$service_label = isset( $services[ $service ] ) ? $services[ $service ] : __( 'Non précisé', 'edigital' );

	$subject = sprintf( '[Devis] %s — %s', $service_label, $name );
	$body    = sprintf(
		"Service : %s\nNom : %s\nEmail : %s\nTéléphone : %s\nBudget : %s\n\nMessage :\n%s",
		$service_label, $name, $email, $phone, $budget ?: 'NC', $message
	);

	$headers = array(
		'Reply-To: ' . $name . ' <' . $email . '>',
		'Content-Type: text/plain; charset=UTF-8',
	);

	$sent = wp_mail( edigital_quote_recipient(), $subject, $body, $headers );
	if ( ! $sent ) {
		wp_send_json_error( array( 'message' => __( 'Échec de l\'envoi. Réessayez plus tard.', 'edigital' ) ), 500 );
	}

	wp_send_json_success( array( 'message' => __( 'Merci, nous revenons vers vous très vite.', 'edigital' ) ) );
}
add_action( 'wp_ajax_edigital_quote_submit',        'edigital_quote_handle_ajax' );
add_action( 'wp_ajax_nopriv_edigital_quote_submit', 'edigital_quote_handle_ajax' );

/**
 * JS d'envoi.
 */
function edigital_quote_inline_script() {
	?>
	<script>
	(function () {
		var endpoint = '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>';
		document.addEventListener('submit', function (e) {
			var form = e.target.closest('[data-edigital-quote]');
			if (!form) return;
			e.preventDefault();
			var fb = form.querySelector('.edigital-quote-form__feedback');
			var data = new FormData(form);
			data.append('action', 'edigital_quote_submit');
			fb.textContent = 'Envoi en cours...';
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
add_action( 'wp_footer', 'edigital_quote_inline_script' );
