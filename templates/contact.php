<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Template Name: Contact Us
 */


global $post_id;
$post_id = get_the_ID();
?>

<?php get_header(); ?>

<?php
get_template_part('template-parts/shared/inner-hero');
get_template_part('template-parts/contact-us/contact-info');
get_template_part('template-parts/contact-us/contact-form');
?>

<?php get_footer(); ?>