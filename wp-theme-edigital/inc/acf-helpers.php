<?php
/**
 * ACF safety layer.
 *
 * Charge des fallbacks pour `get_field()`, `get_sub_field()`, `have_rows()` et
 * `the_row()` lorsque le plugin ACF n'est pas actif. Les templates peuvent ainsi
 * appeler ces fonctions sans déclencher de fatal — ils recevront simplement
 * `null` / `false`, ce qui active leurs valeurs par défaut.
 *
 * Charger ce fichier le plus tôt possible dans `functions.php` (avant tout
 * include de template).
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_field' ) ) {
	function get_field( $selector, $post_id = false, $format_value = true ) {
		$post_id = $post_id ?: get_the_ID();
		$value   = $post_id ? get_post_meta( $post_id, $selector, true ) : '';
		return ( '' === $value ) ? null : $value;
	}
}

if ( ! function_exists( 'get_sub_field' ) ) {
	function get_sub_field( $selector, $format_value = true ) {
		return null;
	}
}

if ( ! function_exists( 'have_rows' ) ) {
	function have_rows( $selector, $post_id = false ) {
		return false;
	}
}

if ( ! function_exists( 'the_row' ) ) {
	function the_row( $format = false ) {
		return null;
	}
}

if ( ! function_exists( 'update_field' ) ) {
	function update_field( $selector, $value, $post_id = false ) {
		$post_id = $post_id ?: get_the_ID();
		return $post_id ? update_post_meta( $post_id, $selector, $value ) : false;
	}
}

/**
 * Helper utilitaire : récupère un champ ACF avec une valeur de repli explicite.
 * À utiliser dans les templates pour rendre le code plus lisible que le
 * pattern `$v = get_field('x'); echo $v ?: 'défaut'`.
 */
if ( ! function_exists( 'edigital_field' ) ) {
	function edigital_field( $selector, $default = '', $post_id = false ) {
		$value = get_field( $selector, $post_id );
		return ( null === $value || '' === $value ) ? $default : $value;
	}
}
