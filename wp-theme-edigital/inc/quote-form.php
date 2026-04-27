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
 */
function edigital_quote_form( $atts = array() ) {
	$atts = wp_parse_args( $atts, array(
		'titre' => __( 'Demander un devis', 'edigital' ),
	) );

	$services        = edigital_quote_services();
	$preselect_slug  = isset( $_GET['service'] ) ? sanitize_title( wp_unslash( $_GET['service'] ) ) : '';
	$preselect_label = isset( $services[ $preselect_slug ] ) ? $services[ $preselect_slug ] : '';

	ob_start();
	?>
	<form class="edigital-quote-form" data-edigital-quote>
		<?php if ( $atts['titre'] ) : ?>
			<h3 class="edigital-quote-form__titre"><?php echo esc_html( $atts['titre'] ); ?></h3>
		<?php endif; ?>

		<?php if ( $preselect_label ) : ?>
			<p class="edigital-quote-form__preselect">
				<?php
				printf(
					/* translators: %s = nom du service présélectionné. */
					esc_html__( 'Service présélectionné : %s', 'edigital' ),
					'<strong>' . esc_html( $preselect_label ) . '</strong>'
				);
				?>
			</p>
		<?php endif; ?>

		<input type="hidden" name="nonce" value="<?php echo esc_attr( wp_create_nonce( 'edigital_quote' ) ); ?>">

		<p>
			<label for="edigital-quote-service"><?php esc_html_e( 'Service souhaité', 'edigital' ); ?></label>
			<select id="edigital-quote-service" name="service" required>
				<option value=""><?php esc_html_e( '— Choisir —', 'edigital' ); ?></option>
				<?php foreach ( $services as $slug => $label ) : ?>
					<option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $preselect_slug, $slug ); ?>>
						<?php echo esc_html( $label ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>

		<p>
			<label for="edigital-quote-name"><?php esc_html_e( 'Nom complet', 'edigital' ); ?></label>
			<input id="edigital-quote-name" type="text" name="name" required>
		</p>

		<p>
			<label for="edigital-quote-email"><?php esc_html_e( 'Email', 'edigital' ); ?></label>
			<input id="edigital-quote-email" type="email" name="email" required>
		</p>

		<p>
			<label for="edigital-quote-phone"><?php esc_html_e( 'Téléphone', 'edigital' ); ?></label>
			<input id="edigital-quote-phone" type="tel" name="phone">
		</p>

		<p>
			<label for="edigital-quote-budget"><?php esc_html_e( 'Budget estimé', 'edigital' ); ?></label>
			<select id="edigital-quote-budget" name="budget">
				<option value=""><?php esc_html_e( '— Indicatif —', 'edigital' ); ?></option>
				<option value="<5k"><?php esc_html_e( 'Moins de 5 000 €', 'edigital' ); ?></option>
				<option value="5-15k">5 000 € – 15 000 €</option>
				<option value="15-50k">15 000 € – 50 000 €</option>
				<option value=">50k"><?php esc_html_e( 'Plus de 50 000 €', 'edigital' ); ?></option>
			</select>
		</p>

		<p>
			<label for="edigital-quote-message"><?php esc_html_e( 'Décrivez votre projet', 'edigital' ); ?></label>
			<textarea id="edigital-quote-message" name="message" rows="5" required></textarea>
		</p>

		<p>
			<button type="submit" class="btn btn-mokko btn--primary"><?php esc_html_e( 'Envoyer ma demande', 'edigital' ); ?></button>
		</p>

		<p class="edigital-quote-form__feedback" role="status" aria-live="polite"></p>
	</form>
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
