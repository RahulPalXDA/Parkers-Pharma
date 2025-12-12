<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Template Name: Download Resource
 */

// Set global post ID for template parts
global $post_id;
$post_id = get_the_ID();
?>

<?php get_header(); ?>

<?php
get_template_part('template-parts/shared/inner-hero');
get_template_part('template-parts/downloads/download-section');
get_template_part('template-parts/shared/help', 'card', array());
?>

<?php
set_query_var('top_ftr_space', true);
get_footer();
?>