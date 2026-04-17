<?php
/**
 * Pied de page du site.
 *
 * @package EDigital
 */
?>
	</main><!-- #content -->

	<footer class="ms-footer" role="contentinfo">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4">
					<h4 class="ms-footer__title"><?php bloginfo( 'name' ); ?></h4>
					<p><?php esc_html_e( 'Agence de création de sites internet et d\'applications mobiles à Paris.', 'edigital' ); ?></p>
					<p>
						<?php esc_html_e( 'Siège Social - Paris', 'edigital' ); ?><br>
						<?php esc_html_e( '23 rue du départ - 75014 Paris', 'edigital' ); ?><br>
						<a href="tel:+33184251681">01 84 25 16 81</a> | <a href="mailto:com1@e-digital.fr">com1@e-digital.fr</a>
					</p>
				</div>
				<div class="col-md-4">
					<h4 class="ms-footer__title"><?php esc_html_e( 'Navigation', 'edigital' ); ?></h4>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'ms-footer__nav footer-nav-area',
						'fallback_cb'    => 'edigital_primary_menu_fallback',
						'depth'          => 1,
					) );
					?>
				</div>
				<div class="col-md-4">
					<?php if ( is_active_sidebar( 'sidebar-blog' ) && ( is_home() || is_singular( 'post' ) || is_archive() ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-blog' ); ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="ms-footer__bottom">
				<p>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Tous droits réservés.', 'edigital' ); ?></p>
			</div>
		</div>
	</footer>
</div><!-- .ms-main -->

<?php wp_footer(); ?>
</body>
</html>
