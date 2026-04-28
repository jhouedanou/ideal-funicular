<?php
/**
 * Render — edigital/client-logo
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$libelle = isset( $attributes['libelle'] ) ? (string) $attributes['libelle'] : '';
$police  = isset( $attributes['police'] ) ? (string) $attributes['police'] : 'cinzel';
$taille  = isset( $attributes['taille'] ) ? (int) $attributes['taille'] : 38;

if ( ! $libelle ) {
	return;
}

$font_map = array(
	'cinzel'     => "'Cinzel', serif",
	'playfair'   => "'Playfair Display', serif",
	'caveat'     => "'Caveat', cursive",
	'oswald'     => "'Oswald', sans-serif",
	'dancing'    => "'Dancing Script', cursive",
	'unbounded'  => "'Unbounded', sans-serif",
	'montserrat' => "'Montserrat', sans-serif",
);

$font_family = isset( $font_map[ $police ] ) ? $font_map[ $police ] : "'Cinzel', serif";

$style = sprintf(
	'color: #9e9e9e; font-size: %dpx; font-family: %s;',
	$taille,
	$font_family
);

if ( 'playfair' === $police ) {
	$style .= ' font-style: italic;';
}
if ( 'montserrat' === $police ) {
	$style .= ' font-weight: 900;';
}
if ( 'cinzel' === $police ) {
	$style .= ' letter-spacing: 2px;';
}
if ( 'unbounded' === $police ) {
	$style .= ' letter-spacing: 1px;';
}
if ( 'oswald' === $police ) {
	$style .= ' text-transform: uppercase;';
}
?>
<div class="col-lg-4 col-md-6 col-sm-6 mb-5">
	<div class="text-area">
		<h4 class="text-center" style="<?php echo esc_attr( $style ); ?>">
			<?php echo esc_html( $libelle ); ?>
		</h4>
	</div>
</div>
