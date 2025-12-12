<?php
if (!defined('ABSPATH')) {
    exit;
}

// Set global post ID for template parts
global $post_id;
$post_id = get_option('page_for_posts');
?>

<?php get_header(); ?>
<?php get_template_part('template-parts/shared/inner-hero'); ?>
<?php get_template_part('template-parts/blog/blog-archive'); ?>
<?php get_template_part('template-parts/blog/case-studies'); ?>
<?php get_footer(); ?>