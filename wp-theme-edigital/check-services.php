<?php
define('ABSPATH_SET', true);
require_once '/var/www/html/wp-load.php';
global $wpdb;

$slugs = [
    'service-creation-web', 'service-mobile-native', 'service-app-metier',
    'service-branding', 'service-maintenance', 'service-visibilite-seo',
    'service-visibilite-google-ads'
];

foreach ($slugs as $slug) {
    $row = $wpdb->get_row($wpdb->prepare(
        "SELECT ID, LENGTH(post_content) AS len, post_content FROM wp_posts WHERE post_name=%s AND post_type='page' LIMIT 1",
        $slug
    ));
    if (!$row) { echo "$slug → NOT FOUND\n"; continue; }
    $has_cards = strpos($row->post_content, 'service-text-card') !== false;
    $empty_grid = preg_match('/wp:edigital\/service-text-grid[^-]*\/-->/', $row->post_content);
    echo sprintf(
        "[%s] %s (ID=%d, len=%d) cards=%s empty_grid=%s\n",
        ($has_cards && !$empty_grid) ? 'OK' : 'BUG',
        $slug, $row->ID, $row->len,
        $has_cards ? 'YES' : 'NO',
        $empty_grid ? 'YES' : 'NO'
    );
}
