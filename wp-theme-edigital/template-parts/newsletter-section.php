<?php
/**
 * Section newsletter — markup unifié pour toutes les pages.
 *
 * Inclus via : get_template_part( 'template-parts/newsletter-section' );
 *
 * @package EDigital
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div class="newsletter-area">
	<div class="newsletter-inner">
		<h2 class="heading-title"><?php esc_html_e( 'Newsletter', 'edigital' ); ?></h2>
		<div class="form-area">
			<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>"
				class="mc4wp-form mc4wp-form-116" data-id="116" data-name="Newsletter E-digital"
				method="post" data-edigital-newsletter>
				<input name="action" type="hidden" value="edigital_newsletter_subscribe" />
				<input name="nonce" type="hidden" value="<?php echo esc_attr( wp_create_nonce( 'edigital_newsletter' ) ); ?>" />
				<input name="form_type" type="hidden" value="newsletter" />
				<div class="mc4wp-form-fields">
					<div class="ms-mc4wp--wrap">
						<p>
							<?php esc_html_e( 'Abonnez-vous pour recevoir nos idées inspirantes,', 'edigital' ); ?><br />
							<?php esc_html_e( 'l\'actualité de nos projets et nos innovations quotidiennes.', 'edigital' ); ?>
						</p>
						<div class="ms-mc4wp--action">
							<input class="form-control" name="email" type="email" required
								placeholder="<?php esc_attr_e( 'Votre adresse e-mail', 'edigital' ); ?>" />
							<button class="btn btn-default btn--md btn--primary" type="submit">
								<span class="ms-btn__text">
									<svg class="ms-btt-i" viewBox="0 0 96 96" width="96" height="96"
										xmlns="http://www.w3.org/2000/svg">
										<path d="M52,84V21.656l21.457,21.456c1.561,1.562,4.095,1.562,5.656,0.001c1.562-1.562,1.562-4.096,0-5.658L50.829,9.172l0,0c-0.186-0.186-0.391-0.352-0.609-0.498c-0.101-0.067-0.21-0.114-0.315-0.172c-0.124-0.066-0.242-0.142-0.373-0.195c-0.135-0.057-0.275-0.089-0.415-0.129c-0.111-0.033-0.216-0.076-0.331-0.099C48.527,8.027,48.264,8,48.001,8l0,0c-0.003,0-0.006,0.001-0.009,0.001c-0.259,0.001-0.519,0.027-0.774,0.078c-0.12,0.024-0.231,0.069-0.349,0.104c-0.133,0.039-0.268,0.069-0.397,0.123c-0.139,0.058-0.265,0.136-0.396,0.208c-0.098,0.054-0.198,0.097-0.292,0.159c-0.221,0.146-0.427,0.314-0.614,0.501L16.889,37.456c-1.562,1.562-1.562,4.095-0.001,5.657c1.562,1.562,4.094,1.562,5.658,0L44,21.657V84c0,2.209,1.791,4,4,4S52,86.209,52,84z" />
									</svg>
								</span>
							</button>
						</div>
						<p class="edigital-newsletter-feedback" role="status" aria-live="polite"></p>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
