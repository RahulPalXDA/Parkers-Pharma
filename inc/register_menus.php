<?php
function mytheme_register_menus()
{
    register_nav_menus(
        array(
            'primary' => __('Header Menu'),
            'footer' => __('Quick Links Menu'),
            'social' => __('Social media Menu'),
        )
    );
}
add_action('init', 'mytheme_register_menus');