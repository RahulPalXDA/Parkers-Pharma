<?php
if (!defined('ABSPATH')) {
    exit;
}
global $post_id;
$post_id = get_the_ID();
?>

<?php get_header(); ?>
<?php get_template_part('template-parts/shared/inner-hero'); ?>
<?php get_template_part('template-parts/press-blogs/news-events'); ?>
<?php get_footer(); ?>