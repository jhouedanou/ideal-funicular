<?php
/**
 * Render — edigital/service-intro
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
if ( '' === $titre ) {
	return;
}

$wrapper = get_block_wrapper_attributes( array( 'class' => 'project-area pt-150 pb-50' ) );
?>
<section <?php echo $wrapper; ?>>
	<div class="container">
		<div class="e-con-inner mb-50 text-center" style="display: block; width: 100%;">
			<h2 class="content__title rts-has-mask-fill" style="flex-basis: 100%; text-align: center; justify-content: center; width: 100%; margin-top: 50px !important;">
				<span><?php echo wp_kses_post( $titre ); ?></span>
			</h2>
		</div>
	</div>
</section>
