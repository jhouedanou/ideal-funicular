<?php
/**
 * Render — edigital/actualites-grid
 *
 * Reproduit la grille d'actualités de la maquette.
 * Lit dynamiquement les N derniers articles du CPT « actualite ».
 * Fallback : CPT « post » si aucune actualité n'est publiée.
 *
 * @var array $attributes
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$titre       = isset( $attributes['titre'] ) ? (string) $attributes['titre'] : '';
$nombre      = isset( $attributes['nombre'] ) ? (int) $attributes['nombre'] : 6;
$colonnes    = isset( $attributes['colonnes'] ) ? (string) $attributes['colonnes'] : '3';
$libelle_cta = isset( $attributes['libelleCta'] ) ? (string) $attributes['libelleCta'] : '';
$lien_cta    = isset( $attributes['lienCta'] ) ? (string) $attributes['lienCta'] : '';
$variante    = isset( $attributes['variante'] ) ? (string) $attributes['variante'] : 'histoire';

if ( $lien_cta && '/' === substr( $lien_cta, 0, 1 ) ) {
	$lien_cta = home_url( $lien_cta );
}

// Mapping colonnes → classes Bootstrap.
$col_class_map = array(
	'2' => 'col-sm-12 col-md-6 col-lg-6',
	'3' => 'col-sm-12 col-md-6 col-lg-4',
	'4' => 'col-sm-12 col-md-6 col-lg-3',
);
$col_class = isset( $col_class_map[ $colonnes ] ) ? $col_class_map[ $colonnes ] : $col_class_map['3'];

$query = new WP_Query( array(
	'post_type'      => 'actualite',
	'post_status'    => 'publish',
	'posts_per_page' => $nombre,
	'orderby'        => 'date',
	'order'          => 'DESC',
) );

if ( ! $query->have_posts() ) {
	$query = new WP_Query( array(
		'post_type'      => 'post',
		'post_status'    => 'publish',
		'posts_per_page' => $nombre,
		'orderby'        => 'date',
		'order'          => 'DESC',
	) );
}

$avatar_url = get_template_directory_uri() . '/assets/images/portfolio/avatar.png';

$wrapper = get_block_wrapper_attributes( array( 'class' => 'edigital-actualites-grid' ) );
?>
<div <?php echo $wrapper; ?>>
	<?php if ( 'section' === $variante && $titre ) : ?>
	<div class="ms-ah-wrapper custom-style2">
		<h2 class="content__title hero-title title up-text">
			<?php echo wp_kses_post( $titre ); ?>
		</h2>
	</div>
	<?php endif; ?>
	<div class="ms-posts--wrap">
		<div class="row ms-posts--card">
			<?php
			if ( $query->have_posts() ) :
				while ( $query->have_posts() ) : $query->the_post();
					$thumb_url  = get_the_post_thumbnail_url( null, 'medium' );
					$categories = ( 'actualite' === get_post_type() )
						? get_the_terms( get_the_ID(), 'actualite_categorie' )
						: get_the_category();
					if ( is_wp_error( $categories ) ) {
						$categories = array();
					}
				?>
				<article class="grid-item <?php echo esc_attr( $col_class ); ?> post has-post-thumbnail">
					<a aria-label="<?php echo esc_attr( get_the_title() ); ?>" href="<?php the_permalink(); ?>"></a>
					<figure class="ms-posts--card__media">
						<?php if ( $thumb_url ) : ?>
						<img alt="<?php echo esc_attr( get_the_title() ); ?>" src="<?php echo esc_url( $thumb_url ); ?>" />
						<?php else : ?>
						<img alt="<?php echo esc_attr( get_the_title() ); ?>"
							src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/portfolio/blog-web-creation.png" />
						<?php endif; ?>
					</figure>
					<div class="post-content">
						<div class="post-meta-header">
							<div class="post-header--author">
								<img alt="<?php echo esc_attr( get_the_author() ); ?>" src="<?php echo esc_url( $avatar_url ); ?>" />
								<div class="post-meta__info">
									<span class="post-meta__author"><?php echo esc_html( get_the_author() ); ?></span>
									<span class="post-meta__date"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></span>
								</div>
							</div>
						</div>
						<div class="post-meta-cont">
							<?php if ( ! empty( $categories ) ) : ?>
							<div class="post-category">
								<?php foreach ( $categories as $i => $cat ) : ?>
								<a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" rel="category tag">
									<?php echo esc_html( $cat->name ); ?>
								</a><?php echo ( $i < count( $categories ) - 1 ) ? ',&nbsp;' : ''; ?>
								<?php endforeach; ?>
							</div>
							<?php endif; ?>
							<div class="post-header">
								<a class="post-title" href="<?php the_permalink(); ?>">
									<h3><?php echo esc_html( get_the_title() ); ?></h3>
								</a>
							</div>
						</div>
					</div>
				</article>
				<?php
				endwhile;
				wp_reset_postdata();
			endif;
			?>
		</div>
		<?php if ( $libelle_cta && $lien_cta ) : ?>
		<div class="btn-wrap">
			<a class="btn btn-mokko btn--md" href="<?php echo esc_url( $lien_cta ); ?>" role="button">
				<div class="ms-btn--label">
					<div class="ms-btn__text"><?php echo esc_html( $libelle_cta ); ?></div>
					<div class="ms-btn__border"></div>
				</div>
			</a>
		</div>
		<?php endif; ?>
	</div>
</div>
