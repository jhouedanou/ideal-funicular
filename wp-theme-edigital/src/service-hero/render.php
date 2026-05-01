<?php
/**
 * Render — edigital/service-hero
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$bg            = isset( $attributes['backgroundUrl'] ) ? (string) $attributes['backgroundUrl'] : '';
$use_featured  = ! empty( $attributes['useFeaturedImage'] );

// Si demandé, on remplace l'image par celle mise en avant de la page courante.
// On utilise la queried object plutôt que get_the_ID() pour gérer correctement
// les contextes archive (ex. /nos-projets/ qui est une archive CPT, pas la page).
if ( $use_featured ) {
	$page_id = 0;
	$qo      = get_queried_object();
	if ( $qo instanceof WP_Post && 'page' === $qo->post_type ) {
		$page_id = $qo->ID;
	} elseif ( is_post_type_archive() ) {
		// Pour les archives CPT, on essaie d'associer à la page WP de même slug.
		$pt_obj = get_queried_object();
		if ( $pt_obj && isset( $pt_obj->has_archive ) && is_string( $pt_obj->has_archive ) ) {
			$archive_page = get_page_by_path( $pt_obj->has_archive );
			if ( $archive_page ) {
				$page_id = $archive_page->ID;
			}
		}
	} elseif ( is_home() ) {
		$page_id = (int) get_option( 'page_for_posts' );
	}
	if ( $page_id ) {
		$thumb = get_the_post_thumbnail_url( $page_id, 'full' );
		if ( $thumb ) {
			$bg = $thumb;
		}
	}
}

$b1_label = isset( $attributes['breadcrumb1Label'] ) ? (string) $attributes['breadcrumb1Label'] : '';
$b1_url   = isset( $attributes['breadcrumb1Url'] ) ? (string) $attributes['breadcrumb1Url'] : '';
$b2_label = isset( $attributes['breadcrumb2Label'] ) ? (string) $attributes['breadcrumb2Label'] : '';
$b2_url   = isset( $attributes['breadcrumb2Url'] ) ? (string) $attributes['breadcrumb2Url'] : '';
$current  = isset( $attributes['breadcrumbCurrent'] ) ? (string) $attributes['breadcrumbCurrent'] : '';
$titre    = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$sous     = isset( $attributes['sousTitre'] ) ? (string) $attributes['sousTitre'] : '';

$style = $bg
	? "background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('" . esc_url( $bg ) . "') no-repeat center center; background-size: cover;"
	: '';

$wrapper = get_block_wrapper_attributes( array(
	'class' => 'ms-hero-internal',
	'style' => $style,
) );
?>
<section <?php echo $wrapper; ?>>
	<div class="container">
		<div class="ms-hc">
			<div class="ms-hc--inner">
				<?php if ( $b1_label || $b2_label || $current ) : ?>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<?php if ( $b1_label ) : ?>
						<li class="breadcrumb-item"><a href="<?php echo esc_url( $b1_url ?: home_url( '/' ) ); ?>"><?php echo esc_html( $b1_label ); ?></a></li>
						<?php endif; ?>
						<?php if ( $b2_label ) : ?>
						<li class="breadcrumb-item"><a href="<?php echo esc_url( $b2_url ?: '#' ); ?>"><?php echo esc_html( $b2_label ); ?></a></li>
						<?php endif; ?>
						<?php if ( $current ) : ?>
						<li aria-current="page" class="breadcrumb-item active"><?php echo esc_html( $current ); ?></li>
						<?php endif; ?>
					</ol>
				</nav>
				<?php endif; ?>
				<?php if ( $titre ) : ?>
					<h1 class="ms-hero-title"><?php echo wp_kses_post( $titre ); ?></h1>
				<?php endif; ?>
				<?php if ( $sous ) : ?>
					<p class="ms-hero-subtitle"><?php echo wp_kses_post( $sous ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
