<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
class Header_Menu_Walker extends Walker_Nav_Menu
{
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu shadow\">\n";
    }
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        $is_active = in_array('current-menu-item', $classes) ||
            in_array('current-menu-parent', $classes) ||
            in_array('current-menu-ancestor', $classes);
        if ($depth === 0) {
            $li_classes = 'nav-item' . ($has_children ? ' dropdown' : '');
        } else {
            $li_classes = $has_children ? 'dropdown-submenu' : '';
        }
        $output .= '<li' . ($li_classes ? ' class="' . esc_attr($li_classes) . '"' : '') . '>';
        if ($depth === 0) {
            $link_classes = 'nav-link' . ($is_active ? ' active-menu-item' : '');
            $output .= '<a class="' . esc_attr($link_classes) . '" href="' . esc_attr($item->url) . '">'
                . esc_html($item->title) . '</a>';
            if ($has_children) {
                $output .= '<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">'
                    . '<i class="fa-solid fa-angle-down"></i>'
                    . '</a>';
            }
        } else {
            $link_classes = 'dropdown-item' . ($has_children ? ' dropdown-toggle' : '') . ($is_active ? ' active-menu-item' : '');
            $toggle_attr = $has_children ? ' data-bs-toggle="dropdown" aria-expanded="false"' : '';
            $output .= '<a class="' . esc_attr($link_classes) . '" href="' . esc_attr($item->url) . '"' . $toggle_attr . '>'
                . esc_html($item->title) . '</a>';
        }
    }
    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}