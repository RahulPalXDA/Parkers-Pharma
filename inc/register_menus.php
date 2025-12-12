<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
function mytheme_register_menus()
{
    register_nav_menus(
        array(
            'primary' => __('Header Menu', 'parkers-pharma'),
            'footer' => __('Quick Links Menu', 'parkers-pharma'),
            'social' => __('Social media Menu', 'parkers-pharma'),
        )
    );
}
add_action('init', 'mytheme_register_menus');