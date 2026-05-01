<?php
/**
 * Migration : CPT « actualite » → post_type « post ».
 *
 * Ce script est idempotent. Il :
 *   1. Convertit chaque post de type « actualite » en post standard (post_type=post).
 *   2. Migre les termes de la taxonomie « actualite_categorie » vers la
 *      taxonomie native « category ».
 *   3. Enrichit le post_content avec une version longue transcrite depuis
 *      les templates HTML (blog-single.html pour mobile-dev, contenu
 *      éditorial étendu pour les autres) UNIQUEMENT si le contenu actuel
 *      est court (< 500 caractères) — les éditions manuelles sont préservées.
 *
 * Le bloc `edigital/actualites-grid` reste compatible : il fait déjà un
 * fallback vers `post` quand le CPT « actualite » est vide.
 *
 * Usage : wp eval-file migrate-actualites-to-posts.php
 */

defined( 'ABSPATH' ) || exit;

// -----------------------------------------------------------------------------
// 1. Contenu long-form transcrit depuis blog-single.html + contenu éditorial.
//    Clé = slug d'image, donc associable de façon stable à chaque article.
// -----------------------------------------------------------------------------

// Clés = nom de fichier sans extension (WordPress peut convertir PNG → JPG
// au sideload selon les filtres actifs, donc on ne peut pas se reposer
// sur l'extension d'origine).
$rich_content = array(
	'blog-mobile-dev' => <<<HTML
<!-- wp:paragraph -->
<p>À l'ère du tout numérique, posséder une application mobile performante n'est plus un luxe, mais une nécessité stratégique pour toute entreprise souhaitant rester compétitive. À Paris, cœur battant de l'innovation technologique en France, E-digital accompagne les créateurs et les entreprises dans la concrétisation de leurs visions mobiles les plus ambitieuses.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Pourquoi choisir le développement d'applications mobiles ?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Une application mobile offre une proximité inégalée avec vos utilisateurs. Contrairement à un site web, elle permet une interaction directe via les notifications push, une utilisation hors-ligne partielle et une exploitation optimale des fonctionnalités du smartphone (GPS, caméra, biométrie). Que ce soit pour fidéliser votre clientèle ou optimiser vos processus internes, le mobile est l'outil ultime de transformation digitale.</p>
<!-- /wp:paragraph -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><p>« Le succès d'une application mobile ne se mesure pas seulement à son nombre de téléchargements, mais à la valeur réelle qu'elle apporte quotidiennement à ses utilisateurs. »</p><cite><strong>L'équipe E-digital</strong></cite></blockquote>
<!-- /wp:quote -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">iOS vs Android : Quel choix pour votre projet ?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Chez E-digital, nous maîtrisons les deux écosystèmes majeurs. Le choix entre un développement natif (Swift pour iOS, Kotlin pour Android) ou multiplateforme (Flutter, React Native) dépend de vos objectifs de performance, de votre budget et de votre calendrier. Le développement hybride moderne permet aujourd'hui d'obtenir des résultats bluffants avec un coût optimisé, idéal pour les startups parisiennes en phase de lancement.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">L'importance capitale de l'UX/UI Design</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>À Paris comme ailleurs, un utilisateur juge une application dans les 5 premières secondes. Notre pôle design se concentre sur l'ergonomie (UX) et l'esthétique (UI) pour garantir une navigation fluide, intuitive et mémorable. Chaque bouton, chaque transition et chaque couleur est pensé pour refléter l'identité de votre marque tout en offrant un confort d'utilisation maximal.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">L'accompagnement E-digital à chaque étape</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>De la phase d'idéation et de cahier des charges jusqu'à la publication sur l'App Store et le Google Play Store, nous sommes votre partenaire de confiance. Notre méthodologie agile vous permet de suivre l'avancée du projet en temps réel et d'ajuster les fonctionnalités selon les premiers retours utilisateurs. Nous assurons également la maintenance et les mises à jour pour garantir la pérennité de votre solution mobile.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Conclusion : Donnez vie à votre projet mobile</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Le marché des applications mobiles à Paris est en pleine effervescence. Ne laissez pas votre idée dormir dans un tiroir. Que vous soyez une PME souhaitant digitaliser ses services ou un entrepreneur visionnaire, E-digital met son expertise technique et sa créativité au service de votre réussite. Contactez-nous pour une étude personnalisée de votre projet.</p>
<!-- /wp:paragraph -->
HTML
,
	'blog-smma' => <<<HTML
<!-- wp:paragraph -->
<p>Aujourd'hui, les réseaux sociaux ne sont plus une option : ils sont au cœur de la stratégie de croissance de toute entreprise ambitieuse. Le SMMA (Social Media Marketing Agency) consolide création de contenu, publicité ciblée et gestion de communauté dans une approche cohérente et mesurable.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Une stratégie de contenu qui convertit</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Notre équipe conçoit des calendriers éditoriaux alignés avec vos objectifs business. Chaque post, chaque story, chaque vidéo est pensé pour générer de l'engagement, qualifier des prospects et nourrir votre tunnel de conversion. Nous travaillons aussi bien sur Instagram, LinkedIn, TikTok que Facebook selon votre cible.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Media buying : maximiser votre ROAS</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Au-delà du contenu organique, nous pilotons vos campagnes payantes (Meta Ads, TikTok Ads, LinkedIn Ads) avec une logique d'optimisation continue. A/B testing créatifs, segmentation d'audience, retargeting dynamique : chaque euro investi est mesuré et optimisé pour générer le meilleur retour sur ad spend.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Community management proactif</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Une communauté engagée vaut mille publicités. Nos community managers répondent à vos abonnés, animent les conversations, gèrent les crises et transforment vos clients en ambassadeurs. Une présence humaine, professionnelle et continue qui construit la confiance dans la durée.</p>
<!-- /wp:paragraph -->
HTML
,
	'blog-web-creation' => <<<HTML
<!-- wp:paragraph -->
<p>Votre site web est votre première vitrine, votre commercial 24/7, votre carte de visite à l'échelle d'Internet. À Guyancourt comme à Paris, E-digital conçoit des sites qui ne se contentent pas d'être beaux : ils convertissent, performent et grandissent avec votre activité.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Un design qui reflète votre marque</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Avant la première ligne de code, nous prenons le temps de comprendre votre univers, vos clients et vos ambitions. Maquettes Figma interactives, ateliers UX, prototypage : chaque interface est pensée pour servir votre identité et vos objectifs business.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Une technologie au service de la performance</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>WordPress, Next.js, Laravel, Astro… nous sélectionnons la stack qui correspond à votre contexte. Score Lighthouse 90+, Core Web Vitals au vert, accessibilité RGAA : la performance technique est un prérequis non négociable, pas une option.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Du SEO dès la conception</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Structure sémantique, balisage Schema.org, maillage interne réfléchi, performance mobile : votre site est conçu pour être trouvé. Nous travaillons main dans la main avec votre stratégie de contenu pour vous positionner durablement sur les requêtes qui comptent.</p>
<!-- /wp:paragraph -->
HTML
,
	'blog-software' => <<<HTML
<!-- wp:paragraph -->
<p>Quand vos équipes jonglent entre quinze fichiers Excel, trois logiciels qui ne communiquent pas et un ERP rigide, c'est qu'il est temps de penser sur-mesure. Une application métier dédiée, c'est l'outil qui s'adapte à vos process — et non l'inverse.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Une analyse approfondie de vos processus</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Avant de coder, nous immergeons nos consultants dans votre quotidien. Workflows réels, points de friction, données critiques : chaque fonctionnalité de votre future application est validée avec les utilisateurs finaux pour garantir l'adoption.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Une architecture évolutive</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>API REST documentées, base de données normalisée, microservices quand pertinents : votre application est conçue pour grandir. Intégrations CRM, ERP, PrestaShop, comptabilité — votre outil métier devient le cœur de votre système d'information.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Une mise en production sécurisée</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Tests automatisés, déploiements progressifs, formation des utilisateurs, support post-livraison : nous restons à vos côtés bien au-delà de la mise en ligne. Votre application métier est un investissement long terme — nous le traitons comme tel.</p>
<!-- /wp:paragraph -->
HTML
,
	'blog-ecommerce' => <<<HTML
<!-- wp:paragraph -->
<p>Vendre en ligne ne s'improvise plus. Entre concurrence de masse, exigences techniques et attentes utilisateurs en constante évolution, lancer un e-commerce qui performe demande méthode et expertise. Nos équipes accompagnent les TPE/PME de la conception au scaling.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">PrestaShop, WooCommerce ou sur-mesure ?</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Le bon choix de plateforme dépend de votre volumétrie, de la complexité de votre catalogue et de votre roadmap. PrestaShop pour la richesse fonctionnelle, WooCommerce pour la flexibilité WordPress, ou Shopify Plus pour le scaling international : nous vous orientons en toute objectivité.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Conversion rate optimization</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Tunnel de paiement optimisé, fiches produits engageantes, recommandations personnalisées, gestion fine du panier : chaque étape du parcours d'achat est pensée pour transformer le visiteur en client. Notre approche s'appuie sur la data et l'A/B testing continu.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Logistique, paiement et après-vente</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Stripe, PayPal, Apple Pay, Klarna : intégration des moyens de paiement modernes pour réduire l'abandon. Connecteurs transporteurs, gestion des stocks multi-canal, automatisation du SAV : votre back-office tourne sans friction pour vous laisser vous concentrer sur la croissance.</p>
<!-- /wp:paragraph -->
HTML
,
	'blog-strategy' => <<<HTML
<!-- wp:paragraph -->
<p>Le digital ne se résume pas à un site web et quelques posts Instagram. C'est une transformation profonde de la relation client, des process internes et du modèle économique. E-digital vous accompagne dans cette mutation avec une équipe pluridisciplinaire et des résultats mesurables.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Un audit 360° pour démarrer juste</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Nous commençons par cartographier l'existant : présence digitale, parcours client, outils internes, concurrence. Cet audit nous permet de prioriser les chantiers à impact rapide et ceux qui nécessitent un investissement structurel.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Une roadmap trimestrielle</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Plutôt qu'un plan triennal qui finit dans un tiroir, nous travaillons par sprints trimestriels. Chaque trimestre : 3 à 5 objectifs business clairs, des KPIs trackés, des livrables concrets. Votre stratégie évolue avec votre marché, pas l'inverse.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Une équipe dédiée, pas un freelance isolé</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Direction de projet, développeurs, designers, experts SEO et SMMA : nos 8 collaborateurs travaillent en synergie sur votre dossier. Vous bénéficiez d'un point de contact unique mais d'une expertise complète, sans les coûts d'une agence parisienne classique.</p>
<!-- /wp:paragraph -->
HTML
,
);

// -----------------------------------------------------------------------------
// 2. Mapping image → catégorie WP standard.
// -----------------------------------------------------------------------------

$category_map = array(
	'blog-mobile-dev'   => 'Technologie',
	'blog-smma'         => 'Stratégie',
	'blog-web-creation' => 'Design',
	'blog-software'     => 'Développement',
	'blog-ecommerce'    => 'E-commerce',
	'blog-strategy'     => 'Stratégie',
);

// -----------------------------------------------------------------------------
// 3. Migration des actualités existantes.
// -----------------------------------------------------------------------------

// On traite à la fois les actualités à migrer ET les posts déjà migrés
// (cas d'un re-run après conversion de post_type) afin que l'enrichissement
// de contenu et la migration des taxonomies soient idempotents.
$actualites = get_posts( array(
	'post_type'   => array( 'actualite', 'post' ),
	'post_status' => 'any',
	'numberposts' => -1,
) );

// Filtre : on ne touche qu'aux posts qui ont une thumbnail mappée dans
// $rich_content / $category_map (les autres posts utilisateur sont
// préservés tels quels).
$actualites = array_filter( $actualites, function ( $p ) use ( $rich_content ) {
	$thumb_id = get_post_thumbnail_id( $p->ID );
	if ( ! $thumb_id ) {
		return false;
	}
	$attached = get_post_meta( $thumb_id, '_wp_attached_file', true );
	$key      = $attached ? pathinfo( basename( $attached ), PATHINFO_FILENAME ) : '';
	return isset( $rich_content[ $key ] );
} );

if ( empty( $actualites ) ) {
	WP_CLI::log( 'Aucune actualité ni post mappé à traiter.' );
} else {
	WP_CLI::log( sprintf( 'Traitement de %d post(s) (migration + enrichissement).', count( $actualites ) ) );
}

$migrated = 0;
$enriched = 0;

foreach ( $actualites as $post ) {
	$post_id = $post->ID;

	// 3a. Conversion du post_type.
	if ( 'actualite' === $post->post_type ) {
		set_post_type( $post_id, 'post' );
		$migrated++;
		WP_CLI::log( sprintf( '  ✓ Post %d (%s) → post_type=post', $post_id, $post->post_title ) );
	}

	// 3b. Récupération du fichier image associé pour identifier l'article.
	//     On enlève l'extension : WP peut convertir PNG → JPG au sideload.
	$thumb_id   = get_post_thumbnail_id( $post_id );
	$image_file = '';
	if ( $thumb_id ) {
		$attached = get_post_meta( $thumb_id, '_wp_attached_file', true );
		if ( $attached ) {
			$image_file = pathinfo( basename( $attached ), PATHINFO_FILENAME );
		}
	}

	// 3c. Enrichissement du contenu (idempotent — uniquement si court).
	$current_len = mb_strlen( wp_strip_all_tags( $post->post_content ) );
	if ( $image_file && isset( $rich_content[ $image_file ] ) && $current_len < 500 ) {
		wp_update_post( array(
			'ID'           => $post_id,
			'post_content' => $rich_content[ $image_file ],
		) );
		$enriched++;
		WP_CLI::log( sprintf( '  ↻ Contenu enrichi pour le post %d (%s caractères → %s)',
			$post_id, $current_len, mb_strlen( wp_strip_all_tags( $rich_content[ $image_file ] ) ) ) );
	}

	// 3d. Migration des termes actualite_categorie → category.
	if ( taxonomy_exists( 'actualite_categorie' ) ) {
		$old_terms = wp_get_object_terms( $post_id, 'actualite_categorie', array( 'fields' => 'names' ) );
		if ( ! is_wp_error( $old_terms ) && ! empty( $old_terms ) ) {
			wp_set_post_categories( $post_id, array(), false );
			foreach ( $old_terms as $name ) {
				$term = term_exists( $name, 'category' );
				if ( ! $term ) {
					$term = wp_insert_term( $name, 'category' );
				}
				if ( ! is_wp_error( $term ) && isset( $term['term_id'] ) ) {
					wp_set_post_terms( $post_id, array( (int) $term['term_id'] ), 'category', true );
				}
			}
			wp_remove_object_terms( $post_id, $old_terms, 'actualite_categorie' );
		}
	}

	// 3e. Garantit qu'au moins une catégorie est assignée via $category_map.
	if ( $image_file && isset( $category_map[ $image_file ] ) ) {
		$cat_name = $category_map[ $image_file ];
		$existing_cats = wp_get_post_categories( $post_id );
		if ( empty( $existing_cats ) ) {
			$term = term_exists( $cat_name, 'category' );
			if ( ! $term ) {
				$term = wp_insert_term( $cat_name, 'category' );
			}
			if ( ! is_wp_error( $term ) && isset( $term['term_id'] ) ) {
				wp_set_post_categories( $post_id, array( (int) $term['term_id'] ) );
			}
		}
	}
}

WP_CLI::log( sprintf( 'Migration terminée : %d post_type convertis, %d contenus enrichis.', $migrated, $enriched ) );
WP_CLI::success( 'Migration actualités → posts OK.' );
