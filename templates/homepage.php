<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Template Name: Home Page
 */

// Set global post ID for template parts
global $post_id;
$post_id = get_the_ID();
?>

<?php get_header(); ?>

<?php
$parts = array(
    'hero',
    'about',
    'key-solutions',
    'featured-resources',
    'news-insights'
);
foreach ($parts as $part) {
    get_template_part('template-parts/homepage/' . $part);
}
get_template_part('template-parts/shared/help', 'card');
?>

<?php
set_query_var('top_ftr_space', true);
get_footer();
?>