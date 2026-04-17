-- -----------------------------------------------------------------------
-- E-Digital — Import des pages Gutenberg
-- Généré automatiquement par wp-theme-edigital/sql/build-sql.py
-- Prérequis : une installation WordPress avec le préfixe de tables `wp_`.
--             Adaptez le préfixe si nécessaire (rechercher/remplacer `wp_`).
-- Lancement : mysql -u USER -p DB < edigital-pages.sql
-- Idempotent : re-exécuter la requête remplace les pages dont le slug matche.
-- -----------------------------------------------------------------------

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- Nettoyage préalable des pages E-Digital déjà présentes.
DELETE pm FROM wp_postmeta pm
  INNER JOIN wp_posts p ON p.ID = pm.post_id
  WHERE (p.post_name IN ('accueil', 'services', 'service-creation-web', 'service-mobile-native', 'service-app-metier', 'service-branding', 'service-visibilite-seo', 'service-visibilite-google-ads', 'service-maintenance', 'nos-technologies', 'nos-projets', 'blog', 'contact') OR p.post_name IN ('accueil-menu-item', 'services-menu-item', 'service-creation-web-menu-item', 'service-mobile-native-menu-item', 'service-app-metier-menu-item', 'service-branding-menu-item', 'service-visibilite-seo-menu-item', 'service-visibilite-google-ads-menu-item', 'service-maintenance-menu-item', 'nos-technologies-menu-item', 'nos-projets-menu-item', 'blog-menu-item', 'contact-menu-item'))
    AND p.post_type IN ('page','nav_menu_item');

DELETE FROM wp_posts
  WHERE (post_name IN ('accueil', 'services', 'service-creation-web', 'service-mobile-native', 'service-app-metier', 'service-branding', 'service-visibilite-seo', 'service-visibilite-google-ads', 'service-maintenance', 'nos-technologies', 'nos-projets', 'blog', 'contact') OR post_name IN ('accueil-menu-item', 'services-menu-item', 'service-creation-web-menu-item', 'service-mobile-native-menu-item', 'service-app-metier-menu-item', 'service-branding-menu-item', 'service-visibilite-seo-menu-item', 'service-visibilite-google-ads-menu-item', 'service-maintenance-menu-item', 'nos-technologies-menu-item', 'nos-projets-menu-item', 'blog-menu-item', 'contact-menu-item'))
    AND post_type IN ('page','nav_menu_item');

-- Nettoyage du menu principal E-Digital.
DELETE tr FROM wp_term_relationships tr
  INNER JOIN wp_term_taxonomy tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
  INNER JOIN wp_terms t ON t.term_id = tt.term_id
  WHERE tt.taxonomy = 'nav_menu' AND t.slug = 'edigital-primary';

DELETE tt FROM wp_term_taxonomy tt
  INNER JOIN wp_terms t ON t.term_id = tt.term_id
  WHERE tt.taxonomy = 'nav_menu' AND t.slug = 'edigital-primary';

DELETE FROM wp_terms WHERE slug = 'edigital-primary';

-- Page : Accueil (accueil)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10001, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Agence Digitale Avant-gardiste</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Participe à la croissance des TPE et PME. E-Digital est une agence digitale spécialisée dans le développement web et mobile au service des TPE/PME depuis 2003.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/services/">Accéder à nos services</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">À Propos</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Nous sommes une agence digitale spécialisée dans le développement web et mobile au service des TPE/PME depuis 2003. Budget maîtrisé pour CMS, CRM, ERP, Prestashop.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Notre expertise</h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul>
<!-- wp:list-item -->
<li>Conception Web sur Mesure — Sites Web &amp; E-commerce</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Applications Mobiles — iOS &amp; Android</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Logiciels Métier — CRM, ERP &amp; Solutions</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Référencement SEO / SEA — Marketing Digital</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Création d&#x27;Identité Visuelle — Branding &amp; Design</li>
<!-- /wp:list-item -->
<!-- wp:list-item -->
<li>Maintenance &amp; Hébergement — Support Technique</li>
<!-- /wp:list-item -->
</ul>
<!-- /wp:list -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/nos-projets/">Voir tous les projets</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

<!-- wp:shortcode -->
[edigital_marquee items="SITES WEB SUR MESURE, APPLICATIONS MOBILES, LOGICIELS MÉTIER, SOLUTION SMMA, SITES E-COMMERCE, SEO & STRATÉGIE DIGITALE, DESIGN PREMIUM, ACCOMPAGNEMENT DÉDIÉ, INNOVATION TECH, EXPERTISE WEB"]
<!-- /wp:shortcode -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Des solutions pour votre succès</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Conception et développement web innovant depuis 2003. Nous donnons vie à vos idées grâce à notre maîtrise des dernières technologies web et mobiles.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/services/">En savoir plus</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->',
  'Accueil',
  '',
  'publish', 'closed', 'closed', '',
  'accueil',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  0,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10001'),
  1, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10001, '_wp_page_template', 'page.php');
-- Page : Nos Services (services)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10002, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Nos Services</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Des solutions sur-mesure pour donner vie à vos projets et propulser votre entreprise dans l&#x27;ère digitale.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Une agence digitale globale capable de répondre à tous vos enjeux technologiques et marketing.</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Solution Numérique</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Développement de sites vitrines et e-commerce ultra-performants. Un design premium et une ergonomie pensée pour convertir vos visiteurs en clients.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Audit Visibilité</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Analyse approfondie et optimisation de votre présence sur les moteurs de recherche. Générez un trafic qualifié et pérenne grâce au SEO.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Publicité Google et Meta</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Campagnes publicitaires ciblées sur Google Ads et les réseaux sociaux. Maximisez votre ROI avec des annonces ultra-performantes.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Application Métier</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Développement de logiciels sur-mesure pour automatiser et digitaliser vos processus internes. Des outils robustes adaptés à vous.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Branding &amp; Design</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Création d&#x27;identités visuelles puissantes, logotypes et chartes mémorables. Conception d&#x27;interfaces UI/UX centrées utilisateur.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Maintenance &amp; Support</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Hébergement sécurisé, mises à jour critiques et support technique dédié. Garantissez la pérennité de vos actifs numériques.</p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[edigital_marquee items="SITES WEB SUR MESURE, APPLICATIONS MOBILES, LOGICIELS MÉTIER, SOLUTION SMMA, SITES E-COMMERCE, SEO & STRATÉGIE DIGITALE, DESIGN PREMIUM, ACCOMPAGNEMENT DÉDIÉ, INNOVATION TECH"]
<!-- /wp:shortcode -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Discutons de votre projet</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->',
  'Nos Services',
  'Des solutions sur-mesure pour donner vie à vos projets et propulser votre entreprise dans l''ère digitale.',
  'publish', 'closed', 'closed', '',
  'services',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  0,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10002'),
  2, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10002, '_wp_page_template', 'page.php');
-- Page : Création de Site Web (service-creation-web)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10003, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Création de Site Web</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Des sites modernes, réactifs et optimisés SEO, conçus pour convertir vos visiteurs en clients.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Nous créons des sites web modernes, performants et optimisés pour propulser votre activité en ligne.</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Site Vitrine Professionnel</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Un site vitrine soigné, rapide et responsive qui reflète l&#x27;image de votre entreprise. Conçu pour capter l&#x27;attention de vos visiteurs dès la première seconde et les convertir en clients.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Boutique E-commerce</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Des boutiques en ligne sur WooCommerce, Shopify ou solution sur mesure. Catalogue produits, panier, paiement sécurisé, gestion des stocks — tout est optimisé pour maximiser vos ventes.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Développement Web sur Mesure</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Plateformes web complexes, intranet, portails clients ou applications métier en ligne. Nous développons des solutions robustes avec les technologies les plus adaptées à votre contexte.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Optimisation SEO &amp; Référencement</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Chaque site est conçu avec les meilleures pratiques SEO intégrées : structure sémantique, balises optimisées, Core Web Vitals, maillage interne — pour une visibilité durable sur Google.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Refonte &amp; Modernisation de Site</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Votre site est vieillissant ou ne convertit plus ? Nous le repensons de A à Z — nouveau design, nouvelle architecture, migration sécurisée — tout en préservant votre référencement existant.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Maintenance &amp; Support Web</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Mises à jour régulières, sauvegardes automatiques, surveillance de sécurité 24h/24 et support réactif. Votre site reste rapide, sécurisé et opérationnel en permanence.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Prêt à lancer votre projet ?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Discutons ensemble de vos besoins et construisons le site web qui propulsera votre activité.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Demander un devis gratuit</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->',
  'Création de Site Web',
  'Des sites modernes, réactifs et optimisés SEO, conçus pour convertir vos visiteurs en clients.',
  'publish', 'closed', 'closed', '',
  'service-creation-web',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  10002,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10003'),
  3, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10003, '_wp_page_template', 'page.php');
-- Page : Applications Mobiles Natives (service-mobile-native)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10004, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Applications Mobiles Natives</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Offrez une expérience utilisateur exceptionnelle sur iOS et Android.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Nous concevons des applications fluides, performantes et intuitives pour engager vos utilisateurs au quotidien.</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Développement iOS</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Applications natives fluides et performantes développées en Swift pour iPhone et iPad.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Développement Android</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Applications robustes et modernes développées en Kotlin pour l&#x27;écosystème Android.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Multiplateforme</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Solutions hybrides (Flutter/React Native) pour un déploiement rapide sur les deux stores.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Tests &amp; QA</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Tests rigoureux sur une multitude d&#x27;appareils pour garantir une stabilité parfaite.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Publication Stores</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Accompagnement complet pour la mise en ligne sur l&#x27;App Store et Google Play Store.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Maintenance Mobile</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Mises à jour régulières pour suivre les évolutions des systèmes iOS et Android.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Parlons de votre application</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->',
  'Applications Mobiles Natives',
  'Offrez une expérience utilisateur exceptionnelle sur iOS et Android.',
  'publish', 'closed', 'closed', '',
  'service-mobile-native',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  10002,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10004'),
  4, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10004, '_wp_page_template', 'page.php');
-- Page : Applications Métier (service-app-metier)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10005, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Applications Métier : L&#x27;outil sur-mesure pour votre performance</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Vos processus internes sont ralentis par des fichiers Excel complexes ou des logiciels rigides ? Pour franchir un cap, votre entreprise a besoin d&#x27;outils qui s&#x27;adaptent à votre manière de travailler, et non l&#x27;inverse.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Pourquoi passer au sur-mesure ?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Une application métier n&#x27;est pas un gadget, c&#x27;est le moteur de votre productivité :</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Automatisation</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Supprimez les tâches répétitives à faible valeur ajoutée.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Centralisation</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Vos données sont accessibles partout, en temps réel et en toute sécurité.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Agilité</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Un outil qui évolue au rythme de vos besoins et de votre croissance.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">L’expertise E-Digital.fr</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Développer une application efficace demande une compréhension profonde des enjeux business. Avec plus de dix ans d’expérience, E-Digital conçoit des solutions robustes et intuitives qui transforment votre organisation quotidienne en avantage concurrentiel.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Digitalisez votre savoir-faire</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Ne laissez pas des outils obsolètes brider votre développement. Passons à la vitesse supérieure.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Discuter de mon projet d&#x27;application</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->',
  'Applications Métier',
  'Vos processus internes sont ralentis par des fichiers Excel complexes ou des logiciels rigides ? Pour franchir un cap, votre entreprise a besoin d''outils qui s''adaptent à votre manière de travailler, et non l''inverse.',
  'publish', 'closed', 'closed', '',
  'service-app-metier',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  10002,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10005'),
  5, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10005, '_wp_page_template', 'page.php');
-- Page : Branding & Design (service-branding)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10006, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Branding &amp; Design : Soyez mémorable, soyez leader</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Votre identité visuelle est la première promesse que vous faites à vos clients. Le branding, c&#x27;est l&#x27;art de transformer votre expertise en une marque forte et reconnaissable.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Au-delà du simple logo</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Nous créons des univers de marque qui captent l&#x27;attention et inspirent la confiance :</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Identité Visuelle Unique</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Un design qui reflète vos valeurs et vous distingue immédiatement de la concurrence.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Design Stratégique</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Chaque couleur, police et forme est choisie pour servir vos objectifs business.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Expérience Utilisateur (UX)</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Des interfaces pensées pour la conversion et le confort de vos clients.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">L&#x27;expertise E-Digital.fr</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Une marque forte est un actif qui prend de la valeur. Avec plus de dix ans d’expérience, E-Digital conçoit des identités visuelles pérennes, capables de soutenir les besoins de votre croissance sur le long terme.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Donnez à votre ambition l&#x27;image qu&#x27;elle mérite</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Ne laissez plus une image médiocre freiner votre développement.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Demander un devis</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->',
  'Branding & Design',
  'Votre identité visuelle est la première promesse que vous faites à vos clients. Le branding, c''est l''art de transformer votre expertise en une marque forte et reconnaissable.',
  'publish', 'closed', 'closed', '',
  'service-branding',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  10002,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10006'),
  6, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10006, '_wp_page_template', 'page.php');
-- Page : Visibilité SEO & Référencement Naturel (service-visibilite-seo)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10007, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Votre site existe, mais reste invisible ?</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Un site sans trafic est un investissement perdu. Si votre plateforme ne génère ni contacts ni ventes, ce n&#x27;est pas un problème de design, c&#x27;est un problème de visibilité.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">E-Digital.fr : L&#x27;expérience au service de votre croissance</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Ne laissez plus vos concurrents prendre toute la place. Nous transformons votre site en un véritable levier de business.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Expertise</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Plus de dix ans d’expérience en stratégie digitale.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Objectif</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Positionner votre marque là où vos clients vous cherchent.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Résultat</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Un flux constant de prospects qualifiés pour nourrir votre développement.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Prêt à obtenir des résultats concrets ?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Discutons ensemble de vos besoins et construisons la stratégie qui propulsera votre activité.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Demander un devis gratuit</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->',
  'Visibilité SEO & Référencement Naturel',
  'Un site sans trafic est un investissement perdu. Si votre plateforme ne génère ni contacts ni ventes, ce n''est pas un problème de design, c''est un problème de visibilité.',
  'publish', 'closed', 'closed', '',
  'service-visibilite-seo',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  10002,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10007'),
  7, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10007, '_wp_page_template', 'page.php');
-- Page : Publicité Google Ads & Meta Ads (service-visibilite-google-ads)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10008, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Publicité Google &amp; Meta : Dominez votre marché</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Vous voulez des résultats immédiats ? Là où le SEO prend des mois, la publicité payante (Google Ads &amp; Meta Ads) vous propulse en tête de liste en 24 heures.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Pourquoi coupler Google et Meta ?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>C’est l’alliance parfaite pour couvrir 100% du parcours de vos clients :</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Google Ads</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>On cible les clients qui recherchent activement votre service. Vous apparaissez au moment précis où le besoin est exprimé. C&#x27;est de la capture de demande pure.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Meta Ads</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>On cible les clients selon leurs centres d&#x27;intérêt et comportements. On crée le besoin et installe votre marque dans le quotidien de vos futurs acheteurs (Facebook, Instagram, WhatsApp).</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">L’avantage E-Digital.fr</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Gérer des budgets publicitaires ne s&#x27;improvise pas. Avec plus de dix ans d&#x27;expérience, nous optimisons chaque euro investi pour garantir votre rentabilité.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Ciblage laser</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Ne payez que pour des clics qualifiés.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">ROI mesurable</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Vous savez exactement ce que chaque campagne rapporte à votre entreprise.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Réactivité</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Ajustement des stratégies en temps réel pour coller aux besoins de votre croissance.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Prêt à dominer votre marché ?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Contactez-nous pour définir votre budget et lancer vos premières campagnes rentables.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Démarrer vos campagnes</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->',
  'Publicité Google Ads & Meta Ads',
  'Vous voulez des résultats immédiats ? Là où le SEO prend des mois, la publicité payante (Google Ads & Meta Ads) vous propulse en tête de liste en 24 heures.',
  'publish', 'closed', 'closed', '',
  'service-visibilite-google-ads',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  10002,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10008'),
  8, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10008, '_wp_page_template', 'page.php');
-- Page : Maintenance & Support Technique (service-maintenance)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10009, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Maintenance : Sécurisez votre actif numérique</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Un site ou une application qui tombe, c&#x27;est une perte immédiate de chiffre d&#x27;affaires et de crédibilité. La technologie évolue chaque jour : ne laissez pas l&#x27;obsolescence ou une faille technique paralyser votre entreprise.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Zéro interruption, 100% de sérénité</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Nous ne nous contentons pas de réparer ; nous anticipons. Notre service de maintenance garantit la pérennité de vos outils :</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Maintenance Préventive</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Mises à jour critiques et patches de sécurité pour contrer les menaces avant qu’elles n&#x27;agissent.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Support Réactif</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Une assistance technique à vos côtés pour résoudre vos incidents dans les plus brefs délais.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Optimisation Continue</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Votre outil reste performant, rapide et compatible avec les nouveaux usages du web.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">La fiabilité E-Digital.fr</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>S’appuyer sur E-Digital, c’est bénéficier de plus de dix ans d’expérience dans la gestion d&#x27;infrastructures critiques. Nous assurons la surveillance de vos plateformes pour que vous puissiez vous concentrer sur l&#x27;essentiel : vos besoins de croissance.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Ne prenez aucun risque avec vos plateformes</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Découvrez nos plans de maintenance sur-mesure pour vous sécuriser dès aujourd&#x27;hui.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
<!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/">Demander un devis</a></div>
<!-- /wp:button -->
</div>
<!-- /wp:buttons -->',
  'Maintenance & Support Technique',
  'Un site ou une application qui tombe, c''est une perte immédiate de chiffre d''affaires et de crédibilité. La technologie évolue chaque jour : ne laissez pas l''obsolescence ou une faille technique paralyser votre entreprise.',
  'publish', 'closed', 'closed', '',
  'service-maintenance',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  10002,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10009'),
  9, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10009, '_wp_page_template', 'page.php');
-- Page : Nos Technologies (nos-technologies)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10010, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Nos Technologies</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Nous maîtrisons les outils les plus performants pour donner vie à vos projets les plus ambitieux.</p>
<!-- /wp:paragraph -->',
  'Nos Technologies',
  'Nous maîtrisons les outils les plus performants pour donner vie à vos projets les plus ambitieux.',
  'publish', 'closed', 'closed', '',
  'nos-technologies',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  0,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10010'),
  10, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10010, '_wp_page_template', 'page.php');
-- Page : Nos Projets (nos-projets)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10011, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Nos Projets</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Découvrez nos dernières réalisations et laissez-vous inspirer pour votre futur projet digital.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Agence digitale spécialisée dans la conception et le développement de solutions sur mesure.</h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Logic Design Solutions</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Quitus Immobilier</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Pouret Medical</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Ruaud Industries</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Yvanick conseil</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Bike service</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Dupain</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Fer play</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Cabinet FAMCHON</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Maintenance PC Paris</h3>
<!-- /wp:heading -->',
  'Nos Projets',
  'Découvrez nos dernières réalisations et laissez-vous inspirer pour votre futur projet digital.',
  'publish', 'closed', 'closed', '',
  'nos-projets',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  0,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10011'),
  11, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10011, '_wp_page_template', 'page.php');
-- Page : Blog (blog)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10012, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Notre Blog</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Actualités, conseils et tendances du monde digital pour propulser votre activité.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading">Les plus lus</h4>
<!-- /wp:heading -->

<!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading">Catégories</h4>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Développement d&#x27;applications mobiles à Paris 📱</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Agence Marketing des Médias Sociaux : Les Clés du Succès</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Création de Site Internet : Donnez Vie à Vos Idées</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Création Application Spécifique : Pourquoi le sur-mesure ?</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Vendre en Ligne : Les Erreurs à Éviter en 2024</h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Accompagnement Stratégique pour votre Croissance</h3>
<!-- /wp:heading -->',
  'Blog',
  'Actualités, conseils et tendances du monde digital pour propulser votre activité.',
  'publish', 'closed', 'closed', '',
  'blog',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  0,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10012'),
  12, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10012, '_wp_page_template', 'page.php');
-- Page : Contact (contact)
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  10013, 1, NOW(), UTC_TIMESTAMP(),
  '<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading">Contact</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Parlons de votre projet. Nous revenons vers vous très rapidement.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Parlons de votre projet</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Appelez-nous : 01 84 25 16 81</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Écrivez-nous : com1@e-digital.fr</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Nos adresses</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Paris — Siège social : 23 rue du départ, 75014 Paris</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p>Agence Yvelines : Guyancourt (78280)</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Horaires</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Lun – Ven : 8H à 17H30</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Formulaire de contact</h2>
<!-- /wp:heading -->

<!-- wp:shortcode -->
[edigital_contact_form]
<!-- /wp:shortcode -->',
  'Contact',
  'Parlons de votre projet. Nous revenons vers vous très rapidement.',
  'publish', 'closed', 'closed', '',
  'contact',
  '', '', NOW(), UTC_TIMESTAMP(), '',
  0,
  CONCAT((SELECT option_value FROM wp_options WHERE option_name='siteurl'), '/?page_id=10013'),
  13, 'page', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (10013, '_wp_page_template', 'page.php');

-- Page d'accueil statique + page du blog
INSERT INTO wp_options (option_name, option_value, autoload) VALUES ('show_on_front','page','yes') ON DUPLICATE KEY UPDATE option_value = VALUES(option_value);
INSERT INTO wp_options (option_name, option_value, autoload) VALUES ('page_on_front','10001','yes') ON DUPLICATE KEY UPDATE option_value = VALUES(option_value);
INSERT INTO wp_options (option_name, option_value, autoload) VALUES ('page_for_posts','10012','yes') ON DUPLICATE KEY UPDATE option_value = VALUES(option_value);

-- Menu principal E-Digital (emplacement 'primary').
INSERT INTO wp_terms (name, slug, term_group) VALUES ('E-Digital Primary', 'edigital-primary', 0);
SET @menu_term_id := LAST_INSERT_ID();
INSERT INTO wp_term_taxonomy (term_id, taxonomy, description, parent, count) VALUES (@menu_term_id, 'nav_menu', '', 0, 0);
SET @menu_tt_id := LAST_INSERT_ID();
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  11001, 1, NOW(), UTC_TIMESTAMP(), '', 'Accueil', '', 'publish', 'closed', 'closed', '', 'accueil-menu-item', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 1, 'nav_menu_item', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (11001, '_menu_item_type', 'post_type'),(11001, '_menu_item_menu_item_parent', '0'),(11001, '_menu_item_object_id', '10001'),(11001, '_menu_item_object', 'page'),(11001, '_menu_item_target', ''),(11001, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),(11001, '_menu_item_xfn', ''),(11001, '_menu_item_url', '');
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) VALUES (11001, @menu_tt_id, 0);
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  11002, 1, NOW(), UTC_TIMESTAMP(), '', 'Nos Services', '', 'publish', 'closed', 'closed', '', 'services-menu-item', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 2, 'nav_menu_item', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (11002, '_menu_item_type', 'post_type'),(11002, '_menu_item_menu_item_parent', '0'),(11002, '_menu_item_object_id', '10002'),(11002, '_menu_item_object', 'page'),(11002, '_menu_item_target', ''),(11002, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),(11002, '_menu_item_xfn', ''),(11002, '_menu_item_url', '');
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) VALUES (11002, @menu_tt_id, 0);
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  11003, 1, NOW(), UTC_TIMESTAMP(), '', 'Nos Technologies', '', 'publish', 'closed', 'closed', '', 'nos-technologies-menu-item', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 3, 'nav_menu_item', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (11003, '_menu_item_type', 'post_type'),(11003, '_menu_item_menu_item_parent', '0'),(11003, '_menu_item_object_id', '10010'),(11003, '_menu_item_object', 'page'),(11003, '_menu_item_target', ''),(11003, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),(11003, '_menu_item_xfn', ''),(11003, '_menu_item_url', '');
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) VALUES (11003, @menu_tt_id, 0);
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  11004, 1, NOW(), UTC_TIMESTAMP(), '', 'Nos Projets', '', 'publish', 'closed', 'closed', '', 'nos-projets-menu-item', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 4, 'nav_menu_item', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (11004, '_menu_item_type', 'post_type'),(11004, '_menu_item_menu_item_parent', '0'),(11004, '_menu_item_object_id', '10011'),(11004, '_menu_item_object', 'page'),(11004, '_menu_item_target', ''),(11004, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),(11004, '_menu_item_xfn', ''),(11004, '_menu_item_url', '');
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) VALUES (11004, @menu_tt_id, 0);
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  11005, 1, NOW(), UTC_TIMESTAMP(), '', 'Blog', '', 'publish', 'closed', 'closed', '', 'blog-menu-item', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 5, 'nav_menu_item', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (11005, '_menu_item_type', 'post_type'),(11005, '_menu_item_menu_item_parent', '0'),(11005, '_menu_item_object_id', '10012'),(11005, '_menu_item_object', 'page'),(11005, '_menu_item_target', ''),(11005, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),(11005, '_menu_item_xfn', ''),(11005, '_menu_item_url', '');
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) VALUES (11005, @menu_tt_id, 0);
INSERT INTO wp_posts (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) VALUES (
  11006, 1, NOW(), UTC_TIMESTAMP(), '', 'Contact', '', 'publish', 'closed', 'closed', '', 'contact-menu-item', '', '', NOW(), UTC_TIMESTAMP(), '', 0, '', 6, 'nav_menu_item', '', 0
);
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES (11006, '_menu_item_type', 'post_type'),(11006, '_menu_item_menu_item_parent', '0'),(11006, '_menu_item_object_id', '10013'),(11006, '_menu_item_object', 'page'),(11006, '_menu_item_target', ''),(11006, '_menu_item_classes', 'a:1:{i:0;s:0:"";}'),(11006, '_menu_item_xfn', ''),(11006, '_menu_item_url', '');
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) VALUES (11006, @menu_tt_id, 0);
UPDATE wp_term_taxonomy SET count = 6 WHERE term_taxonomy_id = @menu_tt_id;
-- Auto-assignation de l'emplacement 'primary' : le thème applique ce
-- mod via after_switch_theme (voir functions.php). Si vous préférez
-- l'assigner en base, décommentez et adaptez la ligne ci-dessous en
-- remplaçant 'wp-theme-edigital' par le nom du dossier du thème :
-- INSERT INTO wp_options (option_name, option_value, autoload) VALUES
--   ('theme_mods_wp-theme-edigital',
--    CONCAT('a:1:{s:18:"nav_menu_locations";a:1:{s:7:"primary";i:', @menu_term_id, ';}}'),
--    'yes')
--   ON DUPLICATE KEY UPDATE option_value = VALUES(option_value);

SET FOREIGN_KEY_CHECKS = 1;
-- Fin de l'import E-Digital.
