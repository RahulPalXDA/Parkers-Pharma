<?php
if (!defined('ABSPATH')) {
    exit;
}

// Set global post ID for template parts
global $post_id;
$post_id = get_the_ID();

get_header();
?>

<?php get_template_part('template-parts/shared/inner-hero'); ?>
<?php get_template_part('template-parts/product/details'); ?>

<?php
get_footer();