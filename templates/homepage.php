<?php
/**
 * Template Name: Home Page
 */

get_header(); ?>
<?php get_template_part( 'template-parts/homepage', 'hero' ); ?>
<?php get_template_part( 'template-parts/homepage', 'about' ); ?>
<?php get_template_part( 'template-parts/homepage', 'key-solutions' ); ?>
<?php get_template_part( 'template-parts/homepage', 'featured-resources' ); ?>
<?php get_template_part( 'template-parts/homepage', 'news-insights' ); ?>
<?php get_template_part( 'template-parts/help', 'card' ); ?>
<?php get_footer(); ?>