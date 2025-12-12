<?php
if (!defined('ABSPATH')) {
    exit; 
}



require_once get_template_directory() . '/inc/theme_setup.php';
require_once get_template_directory() . '/inc/register_menus.php';
require_once get_template_directory() . '/inc/enqueue_styles_scripts.php';
require_once get_template_directory() . '/inc/header-menu-walker.php';
require_once get_template_directory() . '/inc/footer_menu_walker.php';
require_once get_template_directory() . '/inc/post-types.php';
require_once get_template_directory() . '/inc/category-images.php';
require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/contact-form-handler.php';