<?php
if (!defined('ABSPATH')) {
    exit;
}

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

    // Load theme text domain
    load_theme_textdomain('parkers-pharma', get_template_directory() . '/languages');
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

// Add social media contact fields to user profiles
function parkers_user_contact_methods($methods)
{
    $methods['linkedin'] = __('LinkedIn URL', 'parkers-pharma');
    $methods['twitter'] = __('Twitter/X URL', 'parkers-pharma');
    $methods['facebook'] = __('Facebook URL', 'parkers-pharma');
    $methods['instagram'] = __('Instagram URL', 'parkers-pharma');
    $methods['youtube'] = __('YouTube URL', 'parkers-pharma');
    $methods['other_social'] = __('Other Website URL', 'parkers-pharma');
    return $methods;
}
add_filter('user_contactmethods', 'parkers_user_contact_methods');
