<?php
/**
 * ACF safety layer.
 *
 * Ne redéclare JAMAIS get_field() / update_field() etc. — ACF les définit
 * lui-même et une double déclaration provoquerait un fatal error à
 * l'activation du plugin.
 *
 * Ce fichier fournit uniquement :
 *   - edigital_field()  : wrapper sûr autour de get_field() avec valeur de
 *                         repli, utilisable dans tous les templates qu'ACF
 *                         soit actif ou non.
 *
 * Dans les templates, remplacer le pattern :
 *   $v = get_field('x'); echo $v ?: 'défaut';
 * par :
 *   echo edigital_field('x', 'défaut');
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'edigital_field' ) ) {
	/**
	 * Retourne la valeur d'un champ ACF ou post meta, avec un repli explicite.
	 *
	 * @param string     $selector   Clé du champ ACF / meta key.
	 * @param mixed      $default    Valeur retournée si le champ est vide/absent.
	 * @param int|false  $post_id    ID du post (false = post courant).
	 * @return mixed
	 */
	function edigital_field( $selector, $default = '', $post_id = false ) {
		if ( function_exists( 'get_field' ) ) {
			$value = get_field( $selector, $post_id ?: false );
		} else {
			$id    = $post_id ?: get_the_ID();
			$value = $id ? get_post_meta( (int) $id, $selector, true ) : '';
		}
		return ( null === $value || '' === $value || false === $value ) ? $default : $value;
	}
}
