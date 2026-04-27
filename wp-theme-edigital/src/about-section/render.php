<?php
/**
 * Render — edigital/about-section
 *
 * Reproduit la structure HTML d'origine de la maquette :
 * <div class="project-area"> (numéro + grand titre + image parallax + vidéo popup)
 * <div class="project-area bottom"> (sous-titre + étiquette)
 *
 * @var array  $attributes
 * @var string $content
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$numero      = isset( $attributes['numero'] ) ? (string) $attributes['numero'] : '';
$titre       = isset( $attributes['titrePrincipal'] ) ? (string) $attributes['titrePrincipal'] : '';
$image_url   = isset( $attributes['imageUrl'] ) ? (string) $attributes['imageUrl'] : '';
$video_url   = isset( $attributes['videoUrl'] ) ? (string) $attributes['videoUrl'] : '';
$sous_titre  = isset( $attributes['sousTitre'] ) ? (string) $attributes['sousTitre'] : '';
$etiquette   = isset( $attributes['etiquette'] ) ? (string) $attributes['etiquette'] : '';

// Identifiant unique pour la popup (permet plusieurs blocs dans la page).
$popup_id = 'edigital-video-popup-' . wp_unique_id();

$wrapper = get_block_wrapper_attributes( array( 'class' => 'edigital-about-section' ) );
?>
<div <?php echo $wrapper; ?>>
	<div class="project-area">
		<div class="container">
			<div class="e-con-inner">
				<?php if ( $numero ) : ?>
				<p class="number-tag"><?php echo esc_html( $numero ); ?></p>
				<?php endif; ?>
				<?php if ( $titre ) : ?>
				<h2 class="content__title rts-has-mask-fill">
					<span><?php echo wp_kses_post( $titre ); ?></span>
				</h2>
				<?php endif; ?>
			</div>
			<?php if ( $image_url ) : ?>
			<div class="ms-hero">
				<div class="ms-parallax jarallax-img" data-speed="0.7" data-type="scroll"
					style="background-image: url('<?php echo esc_url( $image_url ); ?>');">
				</div>
				<?php if ( $video_url ) : ?>
				<a class="rts-btn popup-video btn-secondary-5-1 mfp-inline" href="#<?php echo esc_attr( $popup_id ); ?>">
					<svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M5.25 20.9999C5.05109 20.9999 4.86032 20.9209 4.71967 20.7803C4.57902 20.6396 4.5 20.4488 4.5 20.2499V3.74993C4.49999 3.6196 4.53395 3.49151 4.59852 3.37829C4.6631 3.26508 4.75606 3.17065 4.86825 3.1043C4.98044 3.03796 5.10798 3.002 5.2383 2.99997C5.36862 2.99794 5.49722 3.0299 5.61143 3.09271L20.6114 11.3427C20.7291 11.4074 20.8273 11.5026 20.8956 11.6182C20.964 11.7338 21 11.8656 21 11.9999C21 12.1342 20.964 12.266 20.8956 12.3816C20.8273 12.4972 20.7291 12.5924 20.6114 12.6571L5.61143 20.9071C5.50069 20.968 5.37637 20.9999 5.25 20.9999Z"
							fill="currentColor"></path>
					</svg>
				</a>
				<div class="mfp-hide" id="<?php echo esc_attr( $popup_id ); ?>"
					style="max-width:900px;margin:auto;background:#000;border-radius:16px;overflow:hidden;">
					<video autoplay controls style="width:100%;display:block;">
						<source src="<?php echo esc_url( $video_url ); ?>" type="video/mp4" />
					</video>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<?php if ( $sous_titre || $etiquette ) : ?>
	<div class="project-area bottom">
		<div class="container">
			<div class="e-con-inner">
				<?php if ( $sous_titre ) : ?>
				<h2 class="content__title rts-has-mask-fill">
					<span><?php echo wp_kses_post( $sous_titre ); ?></span>
				</h2>
				<?php endif; ?>
				<?php if ( $etiquette ) : ?>
				<p class="number-tag"><?php echo esc_html( $etiquette ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
