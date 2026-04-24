<?php
/**
 * Template « home » — Page des articles (Option A fidélité maximale).
 *
 * WordPress utilise home.php quand une page est définie comme « page des articles »
 * via Réglages > Lecture, ignorant alors le meta _wp_page_template.
 * On délègue directement au template statique page-blog.php.
 *
 * @package EDigital
 */

get_template_part( 'templates/page-blog' );
