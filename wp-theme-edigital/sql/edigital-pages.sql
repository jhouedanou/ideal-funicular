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
  '<!-- wp:edigital/intro {"titreLigne1":"Agence Digitale","titreLigne2":"Avant-gardiste","etiquette":"À Propos","ancre":"services"} /-->

<!-- wp:edigital/marquee-images {"images":[{"url":"/wp-content/themes/edigital/assets/images/portfolio/web-design.png","alt":"Conception Web sur Mesure"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/blog-mobile-dev.png","alt":"Développement Mobile"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/mobile-app.png","alt":"Applications Mobiles"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/blog-smma.png","alt":"Marketing Digital"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/logiciel-metier.png","alt":"Logiciels Métier"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/blog-web-creation.png","alt":"Création de Sites"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/blog-custom-app.png","alt":"Applications Spécifiques"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/blog-ecommerce.png","alt":"E-commerce"}]} /-->

<!-- wp:edigital/about-section {"numero":"-01","titrePrincipal":"NOUS SOMMES UNE AGENCE DIGITALE SPÉCIALISÉE DANS LE DÉVELOPPEMENT WEB ET MOBILE AU SERVICE DES TPE/PME DEPUIS 2003.","imageUrl":"/wp-content/themes/edigital/assets/images/portfolio/most-hero.png","videoUrl":"/wp-content/themes/edigital/assets/images/slider/freepik_create-a-video_seedance_720p_16-9_24fps_3921.mp4","sousTitre":"Agence digitale spécialisée dans la conception et le développement de solutions sur mesure.","etiquette":"Expertise"} /-->

<!-- wp:edigital/expertise-grid {"titre":"Notre Expertise","texteCta":"Découvrez nos dernières réalisations","libelleCta":"Voir Tous Les Projets","lienCta":"/nos-projets/"} -->
	<!-- wp:edigital/expertise-card {"titre":"Conception de site vitrine","categorie":"Web Design","imageUrl":"/wp-content/themes/edigital/assets/images/portfolio/expertise-vitrine.png","imageAlt":"Conception de site vitrine","lien":"/services/creation-web/"} /-->
	<!-- wp:edigital/expertise-card {"titre":"Développement E-commerce","categorie":"E-commerce","imageUrl":"/wp-content/themes/edigital/assets/images/portfolio/expertise-ecommerce.png","imageAlt":"Développement E-commerce","lien":"/services/creation-web/"} /-->
	<!-- wp:edigital/expertise-card {"titre":"Application Mobile Native","categorie":"Développement Mobile","imageUrl":"/wp-content/themes/edigital/assets/images/portfolio/expertise-mobile.png","imageAlt":"Application Mobile Native","lien":"/services/mobile-native/"} /-->
	<!-- wp:edigital/expertise-card {"titre":"Référencement SEO / SEA","categorie":"Marketing Digital","imageUrl":"/wp-content/themes/edigital/assets/images/portfolio/expertise-seo.png","imageAlt":"Référencement SEO et SEA","lien":"/services/visibilite-seo/"} /-->
	<!-- wp:edigital/expertise-card {"titre":"Création d''Identité Visuelle","categorie":"Branding & Design","imageUrl":"/wp-content/themes/edigital/assets/images/portfolio/expertise-branding.png","imageAlt":"Création d''identité visuelle","lien":"/services/branding/"} /-->
	<!-- wp:edigital/expertise-card {"titre":"Maintenance & Hébergement","categorie":"Support Technique","imageUrl":"/wp-content/themes/edigital/assets/images/portfolio/expertise-support.png","imageAlt":"Maintenance et Hébergement","lien":"/services/maintenance/"} /-->
<!-- /wp:edigital/expertise-grid -->

<!-- wp:edigital/text-ticker {"separateurUrl":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","ligne1":[{"avant":"SITES","mot":"WEB","apres":"SUR MESURE"},{"avant":"APPLICATIONS","mot":"MOBILES","apres":""},{"avant":"LOGICIELS","mot":"MÉTIER","apres":""},{"avant":"SOLUTION","mot":"SMMA","apres":""},{"avant":"SITES","mot":"E-COMMERCE","apres":""}],"ligne2":[{"avant":"SEO &","mot":"STRATÉGIE","apres":"DIGITALE"},{"avant":"DESIGN","mot":"PREMIUM","apres":""},{"avant":"ACCOMPAGNEMENT","mot":"DÉDIÉ","apres":""},{"avant":"INNOVATION","mot":"TECH","apres":""},{"avant":"EXPERTISE","mot":"WEB","apres":""}]} /-->

<!-- wp:edigital/section-heading {"titre":"Nous donnons vie à vos idées grâce à notre maîtrise des dernières technologies web et mobiles.","etiquette":"Histoire","variante":"last"} /-->

<!-- wp:edigital/actualites-grid {"nombre":6,"colonnes":"3","libelleCta":"Toutes les actualités","lienCta":"/blog/","variante":"histoire"} /-->

<!-- wp:edigital/marquee-images {"images":[{"url":"/wp-content/themes/edigital/assets/images/portfolio/web-design.png","alt":"Conception Web sur Mesure"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/blog-mobile-dev.png","alt":"Développement Mobile"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/mobile-app.png","alt":"Applications Mobiles"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/blog-smma.png","alt":"Marketing Digital"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/logiciel-metier.png","alt":"Logiciels Métier"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/blog-web-creation.png","alt":"Création de Sites"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/blog-custom-app.png","alt":"Applications Spécifiques"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/blog-ecommerce.png","alt":"E-commerce"}]} /-->

<!-- wp:edigital/parallax-hero {"titreLigne1":"Créateurs d''expériences","titreLigne2":"digitales depuis 2003","backgroundUrl":"/wp-content/themes/edigital/assets/images/portfolio/createurs-bg.png"} /-->

<!-- wp:edigital/actualites-grid {"titre":"ACTUALITÉS E-DIGITAL","nombre":4,"colonnes":"2","libelleCta":"Voir tous les projets","lienCta":"/nos-projets/","variante":"section"} /-->

<!-- wp:edigital/services-accordion {"titre":"Services","alignement":"right"} -->
	<!-- wp:edigital/accordion-item {"titre":"CRÉATION WEB"} -->
		<!-- wp:paragraph --><p><strong>Sites Modernes :</strong> Nous développons des sites web modernes, réactifs et optimisés pour le SEO.</p><!-- /wp:paragraph -->
		<!-- wp:paragraph --><p><strong>Visibilité :</strong> Améliorez votre présence en ligne et attirez plus de visiteurs.</p><!-- /wp:paragraph -->
	<!-- /wp:edigital/accordion-item -->
	<!-- wp:edigital/accordion-item {"titre":"APP MOBILE"} -->
		<!-- wp:paragraph --><p><strong>Natives iOS &amp; Android :</strong> Nous concevons des applications mobiles natives offrant une expérience et des performances élevées.</p><!-- /wp:paragraph -->
	<!-- /wp:edigital/accordion-item -->
	<!-- wp:edigital/accordion-item {"titre":"APP MÉTIER"} -->
		<!-- wp:paragraph --><p><strong>Sur Mesure :</strong> Nous développons des applications métiers sur mesure pour optimiser vos processus internes et améliorer la productivité de votre entreprise.</p><!-- /wp:paragraph -->
	<!-- /wp:edigital/accordion-item -->
	<!-- wp:edigital/accordion-item {"titre":"SMMA"} -->
		<!-- wp:paragraph --><p><strong>Croissance :</strong> Faire des réseaux sociaux un levier de croissance pour votre business.</p><!-- /wp:paragraph -->
		<!-- wp:paragraph --><p><strong>Stratégie :</strong> Création de contenu, Publicité (Media Buying) et gestion de communauté.</p><!-- /wp:paragraph -->
	<!-- /wp:edigital/accordion-item -->
	<!-- wp:edigital/accordion-item {"titre":"CONSULTING"} -->
		<!-- wp:paragraph --><p>Une équipe dédiée de 8 collaborateurs pour un accompagnement de A à Z. Accédez à des applications pour CMS, CRM, ERP, PrestaShop avec un budget maîtrisé.</p><!-- /wp:paragraph -->
	<!-- /wp:edigital/accordion-item -->
<!-- /wp:edigital/services-accordion -->

<!-- wp:edigital/pricing {"titre":"NOS TARIFS","ancre":"tarifs","extras":[{"libelle":"Référencement SEO","prix":"à partir de 500€ / mois"},{"libelle":"Maintenance & Support","prix":"à partir de 99€ / mois"}]} -->
	<!-- wp:edigital/pricing-card {"titre":"Site Vitrine","sousTitre":"Idéal pour les TPE/PME et indépendants.","prix":"à partir de 1 200€","points":["Design Personnalisé","Optimisé SEO","Responsive Design"],"libelleCta":"Demander un Devis","lienCta":"/contact/","accent":false} /-->
	<!-- wp:edigital/pricing-card {"titre":"Site E-commerce","sousTitre":"Votre boutique en ligne sur mesure.","prix":"à partir de 3 500€","points":["Paiement Sécurisé","Gestion des Stocks","PrestaShop / WooCommerce"],"libelleCta":"Demander un Devis","lienCta":"/contact/","accent":true} /-->
	<!-- wp:edigital/pricing-card {"titre":"App Mobile","sousTitre":"Application Native iOS & Android.","prix":"à partir de 5 000€","points":["Haute Performance","UX / UI Premium","Notification Push"],"libelleCta":"Demander un Devis","lienCta":"/contact/","accent":false} /-->
<!-- /wp:edigital/pricing -->

<!-- wp:edigital/clients {"titreLigne1":"Ils nous font","titreLigne2":"confiance.","backgroundUrl":"/wp-content/themes/edigital/assets/images/clients/client-bg.webp"} -->
	<!-- wp:edigital/client-logo {"libelle":"TOTAL CI","police":"cinzel","taille":38} /-->
	<!-- wp:edigital/client-logo {"libelle":"Yves Rocher","police":"playfair","taille":40} /-->
	<!-- wp:edigital/client-logo {"libelle":"Raufils Assurance","police":"caveat","taille":42} /-->
	<!-- wp:edigital/client-logo {"libelle":"ORDISUD","police":"oswald","taille":44} /-->
	<!-- wp:edigital/client-logo {"libelle":"Quitus Immobilier","police":"dancing","taille":34} /-->
	<!-- wp:edigital/client-logo {"libelle":"ORDEA","police":"unbounded","taille":36} /-->
	<!-- wp:edigital/client-logo {"libelle":"Cabinet Famchon","police":"montserrat","taille":34} /-->
<!-- /wp:edigital/clients -->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"","breadcrumb2Url":"","breadcrumbCurrent":"Nos Services","titre":"Nos Services","sousTitre":"Des solutions sur-mesure pour donner vie à vos projets et propulser votre entreprise dans l''ère digitale."} /-->

<!-- wp:edigital/service-intro {"titre":"Une agence digitale globale capable de répondre à tous vos enjeux technologiques et marketing."} /-->

<!-- wp:edigital/services-hub {"items":[
{"titre":"Solution Numérique","description":"Développement de sites vitrines et e-commerce ultra-performants. Un design premium et une ergonomie pensée pour convertir vos visiteurs en clients.","url":"/services/creation-web/","imageUrl":"/wp-content/themes/edigital/assets/images/service-web-hero.jpg"},
{"titre":"Audit Visibilité","description":"Analyse approfondie et optimisation de votre présence sur les moteurs de recherche. Générez un trafic qualifié et pérenne grâce au SEO.","url":"/services/visibilite-seo/","imageUrl":"/wp-content/themes/edigital/assets/images/hero-visibilite.png"},
{"titre":"Publicité Google et Meta","description":"Campagnes publicitaires ciblées sur Google Ads et les réseaux sociaux. Maximisez votre ROI avec des annonces ultra-performantes.","url":"/services/visibilite-google-ads/","imageUrl":"/wp-content/themes/edigital/assets/images/hero-ads.png"},
{"titre":"Application Métier","description":"Développement de logiciels sur-mesure pour automatiser et digitaliser vos processus internes. Des outils robustes adaptés à vous.","url":"/services/app-metier/","imageUrl":"/wp-content/themes/edigital/assets/images/hero-app-metier.png"},
{"titre":"Branding & Design","description":"Création d''identités visuelles puissantes, logotypes et chartes mémorables. Conception d''interfaces UI/UX centrées utilisateur.","url":"/services/branding/","imageUrl":"/wp-content/themes/edigital/assets/images/hero-branding.png"},
{"titre":"Maintenance & Support","description":"Hébergement sécurisé, mises à jour critiques et support technique dédié. Garantissez la pérennité de vos actifs numériques.","url":"/services/maintenance/","imageUrl":"/wp-content/themes/edigital/assets/images/hero-maintenance.png"}
]} /-->

<!-- wp:edigital/text-ticker {"separateurUrl":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","ligne1":[{"avant":"SITES","mot":"WEB","apres":"SUR MESURE"},{"avant":"APPLICATIONS","mot":"MOBILES","apres":""},{"avant":"LOGICIELS","mot":"MÉTIER","apres":""},{"avant":"SOLUTION","mot":"SMMA","apres":""},{"avant":"SITES","mot":"E-COMMERCE","apres":""}],"ligne2":[{"avant":"SEO &","mot":"STRATÉGIE","apres":"DIGITALE"},{"avant":"DESIGN","mot":"PREMIUM","apres":""},{"avant":"ACCOMPAGNEMENT","mot":"DÉDIÉ","apres":""},{"avant":"INNOVATION","mot":"TECH","apres":""},{"avant":"EXPERTISE","mot":"WEB","apres":""}]} /-->

<!-- wp:edigital/service-cta {"titre":"Prêt à concrétiser votre projet ?","texte":"Discutons-en. Nous revenons vers vous très rapidement avec une proposition adaptée à vos enjeux.","libelleCta":"Discutons de votre projet","lienCta":"/contact/"} /-->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"Services","breadcrumb2Url":"/services/","breadcrumbCurrent":"Création Site Web","titre":"Création de Site Web","sousTitre":"Des sites modernes, réactifs et optimisés SEO, conçus pour convertir vos visiteurs en clients."} /-->

<!-- wp:edigital/service-intro {"titre":"Nous créons des sites web modernes, performants et optimisés pour propulser votre activité en ligne."} /-->

<!-- wp:edigital/service-text-grid {"colonnes":3} -->
<!-- wp:edigital/service-text-card {"icone":"fa-laptop","icoFamille":"fas","tag":"Présence en ligne","titre":"Site Vitrine Professionnel","texte":"Un site vitrine soigné, rapide et responsive qui reflète l''image de votre entreprise. Conçu pour capter l''attention de vos visiteurs dès la première seconde et les convertir en clients."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-shopping-cart","icoFamille":"fas","tag":"Vente en ligne","titre":"Boutique E-commerce","texte":"Des boutiques en ligne sur WooCommerce, Shopify ou solution sur mesure. Catalogue produits, panier, paiement sécurisé, gestion des stocks — tout est optimisé pour maximiser vos ventes."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-code","icoFamille":"fas","tag":"Développement","titre":"Développement Web sur Mesure","texte":"Plateformes web complexes, intranet, portails clients ou applications métier en ligne. Nous développons des solutions robustes avec les technologies les plus adaptées à votre contexte."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-search","icoFamille":"fas","tag":"Référencement","titre":"Optimisation SEO & Référencement","texte":"Chaque site est conçu avec les meilleures pratiques SEO intégrées : structure sémantique, balises optimisées, Core Web Vitals, maillage interne — pour une visibilité durable sur Google."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-sync-alt","icoFamille":"fas","tag":"Redesign","titre":"Refonte & Modernisation de Site","texte":"Votre site est vieillissant ou ne convertit plus ? Nous le repensons de A à Z — nouveau design, nouvelle architecture, migration sécurisée — tout en préservant votre référencement existant."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-shield-alt","icoFamille":"fas","tag":"Support & Sécurité","titre":"Maintenance & Support Web","texte":"Mises à jour régulières, sauvegardes automatiques, surveillance de sécurité 24h/24 et support réactif. Votre site reste rapide, sécurisé et opérationnel en permanence."} /-->
<!-- /wp:edigital/service-text-grid -->

<!-- wp:edigital/text-ticker {"separateurUrl":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","ligne1":[{"avant":"SITES","mot":"WEB","apres":"SUR MESURE"},{"avant":"E-COMMERCE","mot":"PREMIUM","apres":""},{"avant":"DESIGN","mot":"UNIQUE","apres":""},{"avant":"SEO","mot":"OPTIMISÉ","apres":""}],"ligne2":[{"avant":"RESPONSIVE","mot":"DESIGN","apres":""},{"avant":"PERFORMANCE","mot":"WEB","apres":""},{"avant":"ACCOMPAGNEMENT","mot":"DÉDIÉ","apres":""},{"avant":"EXPERTISE","mot":"20 ANS","apres":""}]} /-->

<!-- wp:edigital/service-cta {"titre":"Prêt à lancer votre projet ?","texte":"Discutons ensemble de vos besoins et construisons le site web qui propulsera votre activité.","libelleCta":"Demander un devis gratuit","lienCta":"/contact/"} /-->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"Services","breadcrumb2Url":"/services/","breadcrumbCurrent":"App Mobile","titre":"Applications Mobiles Natives","sousTitre":"Offrez une expérience utilisateur exceptionnelle sur iOS et Android."} /-->

<!-- wp:edigital/service-intro {"titre":"Nous concevons des applications fluides, performantes et intuitives pour engager vos utilisateurs au quotidien."} /-->

<!-- wp:edigital/service-text-grid {"colonnes":3} -->
<!-- wp:edigital/service-text-card {"icone":"fa-apple","icoFamille":"fab","tag":"App Mobile","titre":"Développement iOS","texte":"Applications natives fluides et performantes développées en Swift pour iPhone et iPad."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-android","icoFamille":"fab","tag":"App Mobile","titre":"Développement Android","texte":"Applications robustes et modernes développées en Kotlin pour l''écosystème Android."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-layer-group","icoFamille":"fas","tag":"App Mobile","titre":"Multiplateforme","texte":"Solutions hybrides (Flutter/React Native) pour un déploiement rapide sur les deux stores."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-vials","icoFamille":"fas","tag":"App Mobile","titre":"Tests & QA","texte":"Tests rigoureux sur une multitude d''appareils pour garantir une stabilité parfaite."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-upload","icoFamille":"fas","tag":"App Mobile","titre":"Publication Stores","texte":"Accompagnement complet pour la mise en ligne sur l''App Store et Google Play Store."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-tools","icoFamille":"fas","tag":"App Mobile","titre":"Maintenance Mobile","texte":"Mises à jour régulières pour suivre les évolutions des systèmes iOS et Android."} /-->
<!-- /wp:edigital/service-text-grid -->

<!-- wp:edigital/text-ticker {"separateurUrl":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","ligne1":[{"avant":"SITES","mot":"WEB","apres":"SUR MESURE"},{"avant":"E-COMMERCE","mot":"PREMIUM","apres":""},{"avant":"DESIGN","mot":"UNIQUE","apres":""},{"avant":"SEO","mot":"OPTIMISÉ","apres":""}],"ligne2":[{"avant":"RESPONSIVE","mot":"DESIGN","apres":""},{"avant":"PERFORMANCE","mot":"WEB","apres":""},{"avant":"ACCOMPAGNEMENT","mot":"DÉDIÉ","apres":""},{"avant":"EXPERTISE","mot":"20 ANS","apres":""}]} /-->

<!-- wp:edigital/service-cta {"titre":"Prêt à lancer votre projet ?","texte":"Discutons ensemble de vos besoins et construisons l''application mobile qui propulsera votre activité.","libelleCta":"Demander un devis gratuit","lienCta":"/contact/"} /-->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"Services","breadcrumb2Url":"/services/","breadcrumbCurrent":"Application Métier","titre":"Applications Métier : L''outil sur-mesure pour votre performance","sousTitre":"Vos processus internes sont ralentis par des fichiers Excel complexes ou des logiciels rigides ? Pour franchir un cap, votre entreprise a besoin d''outils qui s''adaptent à votre manière de travailler, et non l''inverse."} /-->

<!-- wp:edigital/service-intro {"titre":"Pourquoi passer au sur-mesure ?"} /-->

<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Une application métier n''est pas un gadget, c''est le moteur de votre productivité :</p><!-- /wp:paragraph -->

<!-- wp:edigital/service-text-grid {"colonnes":3} -->
<!-- wp:edigital/service-text-card {"icone":"fa-cogs","icoFamille":"fas","tag":"Productivité","titre":"Automatisation","texte":"Supprimez les tâches répétitives à faible valeur ajoutée."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-database","icoFamille":"fas","tag":"Data","titre":"Centralisation","texte":"Vos données sont accessibles partout, en temps réel et en toute sécurité."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-tachometer-alt","icoFamille":"fas","tag":"Évolution","titre":"Agilité","texte":"Un outil qui évolue au rythme de vos besoins et de votre croissance."} /-->
<!-- /wp:edigital/service-text-grid -->

<!-- wp:edigital/service-intro {"titre":"L''expertise E-Digital.fr"} /-->

<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Développer une application efficace demande une compréhension profonde des enjeux business.<br><br>Avec plus de dix ans d''expérience, E-Digital conçoit des solutions robustes et intuitives qui transforment votre organisation quotidienne en avantage concurrentiel.</p><!-- /wp:paragraph -->

<!-- wp:edigital/text-ticker {"separateurUrl":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","ligne1":[{"avant":"APPLICATION","mot":"MÉTIER","apres":""},{"avant":"LOGICIEL","mot":"SUR-MESURE","apres":""},{"avant":"PRODUCTIVITÉ","mot":"MAXIMALE","apres":""},{"avant":"AUTOMATISATION","mot":"WEB","apres":""}],"ligne2":[{"avant":"PORTAIL","mot":"CLIENT","apres":""},{"avant":"DÉVELOPPEMENT","mot":"AGILE","apres":""},{"avant":"DIGITALISATION","mot":"MÉTIER","apres":""},{"avant":"SYSTÈME","mot":"INTÉGRÉ","apres":""}]} /-->

<!-- wp:edigital/service-cta {"titre":"Digitalisez votre savoir-faire","texte":"Ne laissez pas des outils obsolètes brider votre développement. Passons à la vitesse supérieure.","libelleCta":"Discuter de mon projet d''application","lienCta":"/contact/"} /-->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"Services","breadcrumb2Url":"/services/","breadcrumbCurrent":"Branding & Design","titre":"Branding & Design : Soyez mémorable, soyez leader","sousTitre":"Votre identité visuelle est la première promesse que vous faites à vos clients. Si votre image est datée ou floue, vous perdez en crédibilité avant même d''avoir pris la parole. Le branding, c''est l''art de transformer votre expertise en une marque forte et reconnaissable."} /-->

<!-- wp:edigital/service-intro {"titre":"Au-delà du simple logo"} /-->

<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Nous créons des univers de marque qui captent l''attention et inspirent la confiance :</p><!-- /wp:paragraph -->

<!-- wp:edigital/service-text-grid {"colonnes":3} -->
<!-- wp:edigital/service-text-card {"icone":"fa-fingerprint","icoFamille":"fas","tag":"ADN visuel","titre":"Identité Visuelle Unique","texte":"Un design qui reflète vos valeurs et vous distingue immédiatement de la concurrence."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-chess-knight","icoFamille":"fas","tag":"Stratégie","titre":"Design Stratégique","texte":"Chaque couleur, police et forme est choisie pour servir vos objectifs business."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-mobile-alt","icoFamille":"fas","tag":"Expérience","titre":"Expérience Utilisateur (UX)","texte":"Des interfaces pensées pour la conversion et le confort de vos clients."} /-->
<!-- /wp:edigital/service-text-grid -->

<!-- wp:edigital/service-intro {"titre":"L''expertise E-Digital.fr"} /-->

<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Une marque forte est un actif qui prend de la valeur. Avec plus de dix ans d''expérience, E-Digital conçoit des identités visuelles pérennes, capables de soutenir les besoins de votre croissance sur le long terme.</p><!-- /wp:paragraph -->

<!-- wp:edigital/text-ticker {"separateurUrl":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","ligne1":[{"avant":"BRANDING","mot":"& DESIGN","apres":""},{"avant":"IDENTITÉ","mot":"VISUELLE","apres":""},{"avant":"DESIGN","mot":"UX/UI","apres":""},{"avant":"LOGO","mot":"SUR MESURE","apres":""}],"ligne2":[{"avant":"EXPÉRIENCE","mot":"CLIENT","apres":""},{"avant":"STRATÉGIE","mot":"MARQUE","apres":""},{"avant":"DESIGN","mot":"GRAPHIQUE","apres":""},{"avant":"DIRECTION","mot":"ARTISTIQUE","apres":""}]} /-->

<!-- wp:edigital/service-cta {"titre":"Donnez à votre ambition l''image qu''elle mérite","texte":"Ne laissez plus une image médiocre freiner votre développement.","libelleCta":"Cliquez ici pour renseigner le formulaire de devis","lienCta":"/contact/"} /-->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"Services","breadcrumb2Url":"/services/","breadcrumbCurrent":"Visibilité","titre":"Votre site existe, mais reste invisible ?","sousTitre":"Un site sans trafic est un investissement perdu. Si votre plateforme ne génère ni contacts ni ventes, ce n''est pas un problème de design, c''est un problème de visibilité."} /-->

<!-- wp:edigital/service-intro {"titre":"E-Digital.fr : L''expérience au service de votre croissance"} /-->

<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Ne laissez plus vos concurrents prendre toute la place. Nous transformons votre site en un véritable levier de business.</p><!-- /wp:paragraph -->

<!-- wp:edigital/service-text-grid {"colonnes":3} -->
<!-- wp:edigital/service-text-card {"icone":"fa-briefcase","icoFamille":"fas","tag":"Visibilité","titre":"Expertise","texte":"Plus de dix ans d''expérience en stratégie digitale."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-bullseye","icoFamille":"fas","tag":"Visibilité","titre":"Objectif","texte":"Positionner votre marque là où vos clients vous cherchent."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-chart-line","icoFamille":"fas","tag":"Visibilité","titre":"Résultat","texte":"Un flux constant de prospects qualifiés pour nourrir votre développement."} /-->
<!-- /wp:edigital/service-text-grid -->

<!-- wp:paragraph {"align":"center","className":"seo-claim"} --><p class="has-text-align-center seo-claim"><strong>Le constat est simple : Votre croissance de demain dépend de votre visibilité d''aujourd''hui.</strong></p><!-- /wp:paragraph -->

<!-- wp:edigital/text-ticker {"separateurUrl":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","ligne1":[{"avant":"VISIBILITÉ","mot":"MAXIMALE","apres":""},{"avant":"TRAFIC","mot":"QUALIFIÉ","apres":""},{"avant":"STRATÉGIE","mot":"DIGITALE","apres":""},{"avant":"SEO","mot":"PERFORMANT","apres":""}],"ligne2":[{"avant":"ACQUISITION","mot":"CLIENTS","apres":""},{"avant":"RÉSULTATS","mot":"CONCRETS","apres":""},{"avant":"CROISSANCE","mot":"GARANTIE","apres":""},{"avant":"EXPERTISE","mot":"10 ANS","apres":""}]} /-->

<!-- wp:edigital/service-cta {"titre":"Prêt à obtenir des résultats concrets ?","texte":"Discutons ensemble de vos besoins et construisons la stratégie qui propulsera votre activité.","libelleCta":"Demander un devis gratuit","lienCta":"/contact/"} /-->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"Services","breadcrumb2Url":"/services/","breadcrumbCurrent":"Publicité Google et Meta","titre":"Publicité Google & Meta : Dominez votre marché","sousTitre":"Vous voulez des résultats immédiats ? Là où le SEO prend des mois, la publicité payante (Google Ads & Meta Ads) vous propulse en tête de liste en 24 heures."} /-->

<!-- wp:edigital/service-intro {"titre":"Pourquoi coupler Google et Meta ?"} /-->

<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">C''est l''alliance parfaite pour couvrir 100% du parcours de vos clients :</p><!-- /wp:paragraph -->

<!-- wp:edigital/service-text-grid {"colonnes":2} -->
<!-- wp:edigital/service-text-card {"icone":"fa-google","icoFamille":"fab","tag":"L''Intention","titre":"Google Ads","texte":"On cible les clients qui recherchent activement votre service. Vous apparaissez au moment précis où le besoin est exprimé. C''est de la capture de demande pure."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-facebook-f","icoFamille":"fab","tag":"L''Audience","titre":"Meta Ads","texte":"On cible les clients selon leurs centres d''intérêt et comportements. On crée le besoin et installe votre marque dans le quotidien de vos futurs acheteurs (Facebook, Instagram, WhatsApp)."} /-->
<!-- /wp:edigital/service-text-grid -->

<!-- wp:edigital/service-intro {"titre":"L''avantage E-Digital.fr"} /-->

<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Gérer des budgets publicitaires ne s''improvise pas. Avec plus de dix ans d''expérience, nous optimisons chaque euro investi pour garantir votre rentabilité.</p><!-- /wp:paragraph -->

<!-- wp:edigital/service-text-grid {"colonnes":3} -->
<!-- wp:edigital/service-text-card {"icone":"fa-crosshairs","icoFamille":"fas","tag":"Performance","titre":"Ciblage laser","texte":"Ne payez que pour des clics qualifiés."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-chart-pie","icoFamille":"fas","tag":"Performance","titre":"ROI mesurable","texte":"Vous savez exactement ce que chaque campagne rapporte à votre entreprise."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-bolt","icoFamille":"fas","tag":"Performance","titre":"Réactivité","texte":"Ajustement des stratégies en temps réel pour coller aux besoins de votre croissance."} /-->
<!-- /wp:edigital/service-text-grid -->

<!-- wp:paragraph {"align":"center","className":"seo-claim"} --><p class="has-text-align-center seo-claim"><strong>Stop aux budgets gaspillés. Passez à une stratégie publicitaire qui transforme vos investissements en chiffre d''affaires.</strong></p><!-- /wp:paragraph -->

<!-- wp:edigital/text-ticker {"separateurUrl":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","ligne1":[{"avant":"PUBLICITÉ","mot":"DIGITALE","apres":""},{"avant":"GOOGLE","mot":"ADS","apres":""},{"avant":"META","mot":"ADS","apres":""},{"avant":"ROI","mot":"MAXIMAL","apres":""}],"ligne2":[{"avant":"ACQUISITION","mot":"CLIENTS","apres":""},{"avant":"RENTABILITÉ","mot":"GARANTIE","apres":""},{"avant":"CLICS","mot":"QUALIFIÉS","apres":""},{"avant":"CROISSANCE","mot":"RAPIDE","apres":""}]} /-->

<!-- wp:edigital/service-cta {"titre":"Prêt à dominer votre marché ?","texte":"Contactez-nous pour définir votre budget et lancer vos premières campagnes rentables.","libelleCta":"Démarrer vos campagnes","lienCta":"/contact/"} /-->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"Services","breadcrumb2Url":"/services/","breadcrumbCurrent":"Maintenance & Support","titre":"Maintenance : Sécurisez votre actif numérique","sousTitre":"Un site ou une application qui tombe, c''est une perte immédiate de chiffre d''affaires et de crédibilité. La technologie évolue chaque jour : ne laissez pas l''obsolescence ou une faille technique paralyser votre entreprise."} /-->

<!-- wp:edigital/service-intro {"titre":"Zéro interruption, 100% de sérénité"} /-->

<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">Nous ne nous contentons pas de réparer ; nous anticipons. Notre service de maintenance garantit la pérennité de vos outils :</p><!-- /wp:paragraph -->

<!-- wp:edigital/service-text-grid {"colonnes":3} -->
<!-- wp:edigital/service-text-card {"icone":"fa-shield-alt","icoFamille":"fas","tag":"Sécurité","titre":"Maintenance Préventive","texte":"Mises à jour critiques et patches de sécurité pour contrer les menaces avant qu''elles n''agissent."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-bolt","icoFamille":"fas","tag":"Assistance","titre":"Support Réactif","texte":"Une assistance technique à vos côtés pour résoudre vos incidents dans les plus brefs délais."} /-->
<!-- wp:edigital/service-text-card {"icone":"fa-tachometer-alt","icoFamille":"fas","tag":"Performance","titre":"Optimisation Continue","texte":"Votre outil reste performant, rapide et compatible avec les nouveaux usages du web."} /-->
<!-- /wp:edigital/service-text-grid -->

<!-- wp:edigital/service-intro {"titre":"La fiabilité E-Digital.fr"} /-->

<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">S''appuyer sur E-Digital, c''est bénéficier de plus de dix ans d''expérience dans la gestion d''infrastructures critiques.<br><br>Nous assurons la surveillance de vos plateformes pour que vous puissiez vous concentrer sur l''essentiel : vos besoins de croissance.</p><!-- /wp:paragraph -->

<!-- wp:edigital/text-ticker {"separateurUrl":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","ligne1":[{"avant":"MAINTENANCE","mot":"PRÉVENTIVE","apres":""},{"avant":"SÉCURITÉ","mot":"WEB","apres":""},{"avant":"SUPPORT","mot":"RÉACTIF","apres":""},{"avant":"99.9%","mot":"UPTIME","apres":""}],"ligne2":[{"avant":"PERFORMANCE","mot":"SYSTÈME","apres":""},{"avant":"MÀJ","mot":"CRITIQUES","apres":""},{"avant":"SAUVEGARDE","mot":"AUTO","apres":""},{"avant":"FIABILITÉ","mot":"TOTALE","apres":""}]} /-->

<!-- wp:edigital/service-cta {"titre":"Ne prenez aucun risque avec vos plateformes","texte":"Découvrez nos plans de maintenance sur-mesure pour vous sécuriser dès aujourd''hui.","libelleCta":"Cliquez ici pour renseigner le formulaire de devis","lienCta":"/contact/"} /-->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"","breadcrumb2Url":"","breadcrumbCurrent":"Nos Technologies","titre":"Nos Technologies","sousTitre":"Nous maîtrisons les outils les plus performants pour donner vie à vos projets les plus ambitieux."} /-->

<!-- wp:edigital/technos-grid {"items":[
{"label":"Flutter","iconUrl":"https://cdn.jsdelivr.net/gh/devicons/devicon/icons/flutter/flutter-original.svg","description":"Développement mobile multiplateforme haute performance pour iOS et Android avec un code unique."},
{"label":"React Native","iconUrl":"https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg","description":"Applications mobiles natives puissantes utilisant la flexibilité et la rapidité de React."},
{"label":"WordPress","iconUrl":"https://cdn.jsdelivr.net/gh/devicons/devicon/icons/wordpress/wordpress-plain.svg","description":"Création de sites vitrines et blogs dynamiques, optimisés pour un référencement naturel maximal."},
{"label":"Prestashop","iconUrl":"/wp-content/themes/edigital/assets/images/portfolio/blog-ecommerce.png","description":"Solutions e-commerce robustes et évolutives pour gérer vos ventes en ligne en toute simplicité."},
{"label":"Laravel","iconUrl":"https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg","description":"Développement de plateformes web complexes et de logiciels métiers sécurisés sur mesure."},
{"label":"Python & IA","iconUrl":"https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg","description":"Automatisation intelligente et intégration de solutions d''intelligence artificielle avancées."},
{"label":"Next.js","iconUrl":"https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nextjs/nextjs-original.svg","description":"Interfaces utilisateur ultra-rapides et optimisées pour le SEO avec les dernières innovations React."},
{"label":"Tailwind CSS","iconUrl":"https://cdn.jsdelivr.net/gh/devicons/devicon/icons/tailwindcss/tailwindcss-original.svg","description":"Design moderne, réactif et épuré pour une expérience utilisateur exceptionnelle sur tous les écrans."},
{"label":"Node.js","iconUrl":"https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg","description":"Backend temps réel ultra-rapide pour des applications web modernes et scalables."}
]} /-->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"","breadcrumb2Url":"","breadcrumbCurrent":"Nos Projets","titre":"Nos Projets","sousTitre":"Découvrez nos dernières réalisations et laissez-vous inspirer pour votre futur projet digital."} /-->

<!-- wp:edigital/projets-intro {"titre":"Agence digitale spécialisée dans la conception et le développement de solutions sur mesure.","sousTitre":"","filtres":[{"label":"Tous nos projets","slug":"*"},{"label":"Design","slug":"design"},{"label":"Développement","slug":"developpement"},{"label":"Portfolio","slug":"portfolio"}]} /-->

<!-- wp:edigital/text-ticker {"separateurUrl":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","ligne1":[{"avant":"PORTFOLIO","mot":"SUR MESURE","apres":""},{"avant":"RÉALISATIONS","mot":"PREMIUM","apres":""},{"avant":"PROJETS","mot":"SIGNATURE","apres":""},{"avant":"CRÉATIONS","mot":"DIGITALES","apres":""}],"ligne2":[{"avant":"DESIGN","mot":"UNIQUE","apres":""},{"avant":"EXPÉRIENCE","mot":"UTILISATEUR","apres":""},{"avant":"INNOVATION","mot":"TECH","apres":""},{"avant":"PERFORMANCE","mot":"WEB","apres":""}]} /-->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"","breadcrumb2Url":"","breadcrumbCurrent":"Blog","titre":"Notre Blog","sousTitre":"Actualités, conseils et tendances du monde digital pour propulser votre activité."} /-->',
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
  '<!-- wp:edigital/service-hero {"breadcrumb1Label":"Accueil","breadcrumb1Url":"/","breadcrumb2Label":"","breadcrumb2Url":"","breadcrumbCurrent":"Contact","titre":"Contact","sousTitre":"Parlons de votre projet. Nous revenons vers vous très rapidement."} /-->

<!-- wp:edigital/marquee-images {"images":[{"url":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","alt":"Travaillons Ensemble"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","alt":"Travaillons Ensemble"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","alt":"Travaillons Ensemble"},{"url":"/wp-content/themes/edigital/assets/images/portfolio/circle-mokko.svg","alt":"Travaillons Ensemble"}]} /-->

<!-- wp:columns {"className":"contact-layout"} -->
<div class="wp-block-columns contact-layout">

<!-- wp:column {"width":"66%","className":"contact-form-col"} -->
<div class="wp-block-column contact-form-col" style="flex-basis:66%">
<!-- wp:shortcode -->
[edigital_devis titre="Parlons de votre projet"]
<!-- /wp:shortcode -->
</div>
<!-- /wp:column -->

<!-- wp:column {"width":"34%"} -->
<div class="wp-block-column" style="flex-basis:34%">
<!-- wp:edigital/contact-info {"titre":"Parlons de votre projet","telLabel":"Appelez-nous","telValue":"01 84 25 16 81","emailLabel":"Écrivez-nous","emailValue":"com1@e-digital.fr","adresse1Label":"Paris — Siège social","adresse1Value":"23 rue du départ, 75014 Paris","adresse2Label":"Agence Yvelines","adresse2Value":"Guyancourt (78280)","horairesLabel":"Horaires","horairesValue":"Lun – Ven : 8H à 17H30","facebookUrl":"https://www.facebook.com/profile.php?id=100068093956984","linkedinUrl":"https://www.linkedin.com/company/e-digital-fr/"} /-->
</div>
<!-- /wp:column -->

</div>
<!-- /wp:columns -->',
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
