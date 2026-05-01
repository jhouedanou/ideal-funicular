<?php
/**
 * Plugin Name: E-Digital Mail Debug
 * Description: Intercepte tout appel à wp_mail() et écrit le détail
 *              (to, cc, subject, attachments, body trunqué) dans
 *              wp-content/debug.log. Aucune réelle livraison n'est
 *              tentée — pratique pour le test du formulaire de contact.
 *
 * Activé uniquement quand WP_DEBUG_LOG est vrai. À retirer en prod.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) ) {
	return;
}

add_action( 'phpmailer_init', function ( $mailer ) {
	$lines = array();
	$lines[] = '--- wp_mail (phpmailer_init) ---';
	$lines[] = 'From       : ' . $mailer->From . ' <' . $mailer->FromName . '>';
	$lines[] = 'Subject    : ' . $mailer->Subject;
	$tos = array();
	foreach ( $mailer->getToAddresses() as $a ) { $tos[] = $a[0]; }
	$lines[] = 'To         : ' . implode( ', ', $tos );
	$ccs = array();
	foreach ( $mailer->getCcAddresses() as $a ) { $ccs[] = $a[0]; }
	$lines[] = 'Cc         : ' . implode( ', ', $ccs );
	$bccs = array();
	foreach ( $mailer->getBccAddresses() as $a ) { $bccs[] = $a[0]; }
	$lines[] = 'Bcc        : ' . implode( ', ', $bccs );
	$lines[] = 'Reply-To   : ' . implode( ', ', array_keys( $mailer->getReplyToAddresses() ) );
	$atts = $mailer->getAttachments();
	$lines[] = 'Attachments: ' . count( $atts );
	foreach ( $atts as $a ) {
		$lines[] = '  raw = ' . wp_json_encode( $a );
	}
	$body = $mailer->Body;
	$lines[] = 'Body length: ' . strlen( $body );
	$lines[] = 'Body head  : ' . substr( wp_strip_all_tags( $body ), 0, 240 );
	$lines[] = '--- end wp_mail ---';
	error_log( implode( "\n", $lines ) );
} );

// Empêcher l'envoi réel (PHP mail() retournera quand même true côté wp_mail).
add_filter( 'pre_wp_mail', function ( $pre, $atts ) {
	$ats = $atts['attachments'] ?? array();
	$keys = array();
	foreach ( $ats as $k => $v ) {
		$keys[] = sprintf( '[%s] => %s (string_key=%s)', $k, $v, var_export( is_string( $k ), true ) );
	}
	error_log( sprintf( '[mail-debug] pre_wp_mail intercepted: to=%s subject="%s" attachments=%d :: %s',
		is_array( $atts['to'] ) ? implode( ',', $atts['to'] ) : $atts['to'],
		$atts['subject'] ?? '',
		count( $ats ),
		implode( ' | ', $keys )
	) );
	return $pre; // null = laisser WordPress continuer le pipeline
}, 10, 2 );
