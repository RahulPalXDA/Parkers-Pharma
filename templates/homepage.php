<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * Template Name: Home Page
 */

get_header(); ?>
<?php
$template_parts = array(
    'homepage-hero',
    'homepage-about',
    'homepage-key-solutions',
    'homepage-featured-resources',
    'homepage-news-insights',
    'help-card',
);

foreach ($template_parts as $part) {
    get_template_part('template-parts/' . $part);
}
?>
<?php get_footer(); ?>