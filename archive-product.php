<?php
if (!defined('ABSPATH')) {
    exit;
}


global $post_id;
$post_id = get_queried_object_id();

get_header();
?>
<?php get_template_part('template-parts/shared/inner-hero'); ?>
<?php get_template_part('template-parts/shared/product-archive'); ?>
<?php
get_footer();