<?php
/**
 * Archive du CPT « projet » — délégation vers le template statique.
 *
 * Le CPT « projet » est enregistré avec `has_archive => 'nos-projets'`,
 * donc /nos-projets/ est routé en archive (et non en page WP). On
 * délègue ici au template `templates/page-nos-projets.php`, qui charge
 * lui-même le contenu Gutenberg de la page WP du même slug.
 *
 * @package EDigital
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_template_part( 'templates/page-nos-projets' );
