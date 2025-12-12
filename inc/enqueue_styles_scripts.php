<?php
if (!defined('ABSPATH')) {
    exit; 
}

function theme_enqueue_assets()
{
    $assets_uri = get_template_directory_uri() . '/assets';
    $version = '1.0.0';

    wp_enqueue_style('bootstrap-css', $assets_uri . '/css/bootstrap.min.css', [], $version, 'all');
    wp_enqueue_style('owl-carousel-css', $assets_uri . '/css/owl.carousel.min.css', [], $version, 'all');
    wp_enqueue_style('theme-style', $assets_uri . '/css/style.css', ['bootstrap-css', 'owl-carousel-css'], $version, 'all');
    wp_enqueue_style('theme-responsive', $assets_uri . '/css/responsive.css', ['theme-style'], $version, 'all');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', [], $version, 'all');

    wp_enqueue_script('popper-js', $assets_uri . '/js/popper.min.js', ['jquery'], $version, true);
    wp_enqueue_script('bootstrap-js', $assets_uri . '/js/bootstrap.min.js', ['jquery', 'popper-js'], $version, true);
    wp_enqueue_script('owl-carousel-js', $assets_uri . '/js/owl.carousel.min.js', ['jquery'], $version, true);
    wp_enqueue_script('theme-custom-js', $assets_uri . '/js/custom.js', ['jquery', 'bootstrap-js', 'owl-carousel-js'], $version, true);
}

add_action('wp_enqueue_scripts', 'theme_enqueue_assets');