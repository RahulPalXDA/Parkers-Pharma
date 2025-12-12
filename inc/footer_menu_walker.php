<?php
if (!defined('ABSPATH')) {
    exit; 
}
class Footer_Menu_Walker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = array())
    {
    }
    function end_lvl(&$output, $depth = 0, $args = array())
    {
    }
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        if (!isset($this->started)) {
            $output .= '<ul class="footer-menu">';
            $this->started = true;
        }
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        if (
            in_array('current-menu-item', $classes) ||
            in_array('current_page_item', $classes) ||
            in_array('current-menu-ancestor', $classes)
        ) {
            $classes[] = 'active-footer';
        }
        $classes = array_diff($classes, ['menu-item-has-children']);
        $class_names = join(' ', array_filter($classes));
        $output .= '<li class="' . esc_attr($class_names) . '">';
        $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }
    function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= "</li>";
    }
    function end_menu(&$output)
    {
        if (isset($this->started)) {
            $output .= '</ul>';
        }
    }
}