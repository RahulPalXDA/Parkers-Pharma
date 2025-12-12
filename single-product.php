<?php
if (!defined('ABSPATH')) {
    exit;
}


global $post_id;
$post_id = get_the_ID();

get_header();
?>

<?php get_template_part('template-parts/shared/inner-hero'); ?>
<?php get_template_part('template-parts/product/details'); ?>

<?php
get_footer();