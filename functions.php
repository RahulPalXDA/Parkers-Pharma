<?php
/**
 * Basic theme functions.
 */

function basic_theme_setup()
{
    // Add support for document title tag
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height' => 115,
        'width' => 108,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'basic_theme_setup');

function enable_excerpt_for_all_post_types()
{
    $post_types = get_post_types(array('public' => true), 'names');
    foreach ($post_types as $pt) {
        add_post_type_support($pt, 'excerpt');
    }
}

add_action('init', 'enable_excerpt_for_all_post_types');

require_once get_template_directory() . '/inc/register_menus.php';
require_once get_template_directory() . '/inc/enqueue_styles_scripts.php';
require_once get_template_directory() . '/inc/header-menu-walker.php';
require_once get_template_directory() . '/inc/footer_menu_walker.php';