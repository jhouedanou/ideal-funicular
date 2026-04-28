<?php
/**
 * Single Post Template: Projet
 *
 * Affiche dynamiquement les données du projet avec un repli Lorem Ipsum
 * lorsque les champs ACF ne sont pas renseignés. Termine sur une boucle
 * « projets liés » basée sur la taxonomie Expertise.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post();

		$post_id      = get_the_ID();
		$thumbnail    = get_the_post_thumbnail_url( $post_id, 'large' )
			?: get_template_directory_uri() . '/assets/images/portfolio/LDSolutions.png';
		$client       = edigital_field( 'client_nom',     '' );
		$categorie    = edigital_field( 'projet_categorie', '' );
		$technologies = edigital_field( 'projet_technologies', 'WordPress, React, CSS3' );
		$date         = edigital_field( 'projet_date',    get_the_date( 'F Y' ) );
		$lien_live    = edigital_field( 'projet_lien_live', '' );
		$contexte     = edigital_field( 'projet_contexte', '' );
		$approche     = edigital_field( 'projet_approche', '' );
		$resultat     = edigital_field( 'projet_resultat', '' );
		$citation     = edigital_field( 'projet_citation', '' );

		// Lorem Ipsum de repli — utilisé si l'éditeur n'a pas encore saisi de contenu.
		$lorem_contexte = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.';
		$lorem_approche = 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
		$lorem_resultat = 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.';
		$lorem_citation = 'Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.';

		// Termes Expertise pour l'affichage en pastille.
		$expertises = get_the_terms( $post_id, 'expertise' );
		?>
<main class="ms-main ms-single-post" data-scroll-section="">

	<section class="ms-hero-internal" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url('<?php echo esc_url( $thumbnail ); ?>') no-repeat center center; background-size: cover; padding: 180px 0 120px; text-align: center;">
		<div class="container">
			<header class="ms-sp--header">
				<div class="post-meta-date meta-date-sp" style="color: rgba(255,255,255,0.7) !important;">
					<span class="post-author__name"><?php esc_html_e( 'Étude de Cas', 'edigital' ); ?></span>
				</div>
				<h1 class="ms-sp--title" style="color: #fff !important; font-size: 52px !important; margin-bottom: 30px !important;"><?php the_title(); ?></h1>
				<?php if ( $expertises && ! is_wp_error( $expertises ) ) : ?>
					<div class="post-category__list">
						<ul class="post-categories">
							<?php foreach ( $expertises as $term ) : ?>
								<li>
									<a href="<?php echo esc_url( edigital_expertise_link( $term->slug ) ); ?>" rel="category tag" style="color:#fff !important; border-color:rgba(255,255,255,0.3) !important;">
										<?php echo esc_html( $term->name ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</header>
		</div>
	</section>

	<section class="project-details-area" style="padding: 100px 0;">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 pe-lg-5">
					<figure class="media-wrapper media-wrapper--16:9 mb-5">
						<img alt="<?php echo esc_attr( get_the_title() ); ?>" src="<?php echo esc_url( $thumbnail ); ?>" style="width:100%; height:auto; border-radius:24px; box-shadow:0 15px 40px rgba(0,0,0,0.1);" />
					</figure>

					<article class="entry-content" style="max-width:100%; margin:0; padding-right:15px;">
						<?php if ( get_the_content() ) : ?>
							<?php the_content(); ?>
						<?php else : ?>
							<h3 style="font-size:32px; font-weight:700; margin-bottom:25px;"><?php esc_html_e( 'Le Contexte du Projet', 'edigital' ); ?></h3>
							<p><?php echo wp_kses_post( $contexte ?: $lorem_contexte ); ?></p>

							<h3 style="font-size:28px; font-weight:700; margin-top:40px; margin-bottom:20px;"><?php esc_html_e( 'Notre Approche & Solution', 'edigital' ); ?></h3>
							<p><?php echo wp_kses_post( $approche ?: $lorem_approche ); ?></p>

							<blockquote style="border-left:5px solid #ff0000; padding:30px; background:#f9f9f9; font-style:italic; border-radius:0 10px 10px 0; margin:40px 0;">
								<?php echo esc_html( $citation ?: $lorem_citation ); ?>
							</blockquote>

							<h3 style="font-size:28px; font-weight:700; margin-bottom:20px;"><?php esc_html_e( 'Le Résultat', 'edigital' ); ?></h3>
							<p><?php echo wp_kses_post( $resultat ?: $lorem_resultat ); ?></p>
						<?php endif; ?>
					</article>
				</div>

				<aside class="col-lg-4 mt-5 mt-lg-0">
					<div class="project-sidebar" style="background:#fff; padding:40px; border-radius:24px; box-shadow:0 20px 50px rgba(0,0,0,0.06); position:sticky; top:120px;">
						<h4 style="font-size:24px; font-weight:700; margin-bottom:30px; border-bottom:1px solid #eaeaea; padding-bottom:15px;"><?php esc_html_e( 'Détails du Projet', 'edigital' ); ?></h4>

						<?php if ( $client ) : ?>
							<div class="sidebar-item" style="margin-bottom:25px;">
								<h5 style="font-size:14px; text-transform:uppercase; color:#888; font-weight:600; letter-spacing:1px; margin-bottom:8px;"><?php esc_html_e( 'Client', 'edigital' ); ?></h5>
								<p style="font-size:18px; font-weight:600; color:#000; margin:0;"><?php echo esc_html( $client ); ?></p>
							</div>
						<?php endif; ?>

						<?php if ( $categorie ) : ?>
							<div class="sidebar-item" style="margin-bottom:25px;">
								<h5 style="font-size:14px; text-transform:uppercase; color:#888; font-weight:600; letter-spacing:1px; margin-bottom:8px;"><?php esc_html_e( 'Catégorie', 'edigital' ); ?></h5>
								<p style="font-size:18px; font-weight:600; color:#000; margin:0;"><?php echo esc_html( $categorie ); ?></p>
							</div>
						<?php endif; ?>

						<div class="sidebar-item" style="margin-bottom:25px;">
							<h5 style="font-size:14px; text-transform:uppercase; color:#888; font-weight:600; letter-spacing:1px; margin-bottom:8px;"><?php esc_html_e( 'Technologies', 'edigital' ); ?></h5>
							<p style="font-size:18px; font-weight:600; color:#000; margin:0;"><?php echo esc_html( $technologies ); ?></p>
						</div>

						<div class="sidebar-item" style="margin-bottom:40px;">
							<h5 style="font-size:14px; text-transform:uppercase; color:#888; font-weight:600; letter-spacing:1px; margin-bottom:8px;"><?php esc_html_e( 'Date', 'edigital' ); ?></h5>
							<p style="font-size:18px; font-weight:600; color:#000; margin:0;"><?php echo esc_html( $date ); ?></p>
						</div>

						<?php if ( $lien_live ) : ?>
							<a class="ms-btn ms-btn--primary" href="<?php echo esc_url( $lien_live ); ?>" target="_blank" rel="noopener" style="width:100%; text-align:center; border-radius:30px; padding:15px 30px; background:#ff0000; color:#fff; font-weight:700; text-transform:uppercase; display:block; text-decoration:none;">
								<div class="ms-btn__text"><?php esc_html_e( 'Voir le Site Live', 'edigital' ); ?></div>
							</a>
						<?php endif; ?>
					</div>
				</aside>
			</div>
		</div>
	</section>

	<?php
	$next = get_next_post();
	if ( $next ) :
		?>
		<section class="project-nav-area" style="background:#111; padding:80px 0; margin-top:50px;">
			<div class="container text-center">
				<span style="display:block; color:rgba(255,255,255,0.5); font-size:14px; text-transform:uppercase; letter-spacing:2px; margin-bottom:10px;"><?php esc_html_e( 'Projet Suivant', 'edigital' ); ?></span>
				<a href="<?php echo esc_url( get_permalink( $next ) ); ?>" style="text-decoration:none;">
					<h2 style="color:#fff; font-size:48px; font-weight:700; margin:0;"><?php echo esc_html( get_the_title( $next ) ); ?></h2>
				</a>
			</div>
		</section>
	<?php endif; ?>

	<section class="related-projects-area" style="padding:80px 0; background:#fafafa;">
		<div class="container">
			<h2 style="text-align:center; font-size:36px; font-weight:700; margin-bottom:50px;">
				<?php esc_html_e( 'Projets liés', 'edigital' ); ?>
			</h2>
			<?php edigital_render_projets_lies( $post_id, 3 ); ?>
		</div>
	</section>

</main>
		<?php
	endwhile;
endif;

get_footer();
