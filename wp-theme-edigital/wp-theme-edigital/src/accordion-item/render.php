<?php
/**
 * Render — edigital/accordion-item
 *
 * @var array  $attributes
 * @var string $content   Markup riche saisi via InnerBlocks.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
?>
<div class="ms_ac_panel">
	<div class="ms_ac--label">
		<div class="label-title"><?php echo esc_html( strtoupper( $titre ) ); ?></div>
		<div class="ms_ac--icon rotation">
			<div class="accordion_icon--open">
				<svg aria-hidden="true" class="e-font-icon-svg e-fas-arrow-down" viewBox="0 0 448 512"
					xmlns="http://www.w3.org/2000/svg">
					<path d="M413.1 222.5l22.2 22.2c9.4 9.4 9.4 24.6 0 33.9L241 473c-9.4 9.4-24.6 9.4-33.9 0L12.7 278.6c-9.4-9.4-9.4-24.6 0-33.9l22.2-22.2c9.5-9.5 25-9.3 34.3.4L184 343.4V56c0-13.3 10.7-24 24-24h32c13.3 0 24 10.7 24 24v287.4l114.8-120.5c9.3-9.8 24.8-10 34.3-.4z" />
				</svg>
			</div>
		</div>
	</div>
	<div class="ms_ac--content" style="height:0px;">
		<div class="ms_ac--text"><?php echo $content; ?></div>
	</div>
</div>
