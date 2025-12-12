<?php
if (!defined('ABSPATH')) {
    exit;
}

function parkers_breadcrumbs()
{
    if (is_front_page()) {
        return;
    }

    $items = [];
    $items[] = '<a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'parkers-pharma') . '</a>';

    if (is_home()) {
        $items[] = get_the_title(get_option('page_for_posts'));
    } elseif (is_post_type_archive()) {
        $items[] = post_type_archive_title('', false);
    } elseif (is_tax() || is_category() || is_tag()) {
        $term = get_queried_object();
        $term_links = [];
        $ancestors = array_reverse(get_ancestors($term->term_id, $term->taxonomy));
        foreach ($ancestors as $ancestor_id) {
            $ancestor = get_term($ancestor_id, $term->taxonomy);
            $term_links[] = '<a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a>';
        }
        $term_links[] = esc_html($term->name);
        $items[] = implode(' - ', $term_links);
    } elseif (is_singular()) {
        $post_type = get_post_type();
        $taxonomies = get_object_taxonomies($post_type, 'objects');
        foreach ($taxonomies as $tax) {
            if ($tax->hierarchical) {
                $terms = get_the_terms(get_the_ID(), $tax->name);
                if ($terms && !is_wp_error($terms)) {
                    $term = $terms[0];
                    $term_links = [];
                    $ancestors = array_reverse(get_ancestors($term->term_id, $term->taxonomy));
                    foreach ($ancestors as $ancestor_id) {
                        $ancestor = get_term($ancestor_id, $term->taxonomy);
                        $term_links[] = '<a href="' . esc_url(get_term_link($ancestor)) . '">' . esc_html($ancestor->name) . '</a>';
                    }
                    $term_links[] = '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                    $items[] = implode(' - ', $term_links);
                    break;
                }
            }
        }
        $items[] = get_the_title();
    } elseif (is_search()) {
        $items[] = esc_html__('Search Results', 'parkers-pharma');
    } elseif (is_404()) {
        $items[] = esc_html__('Page Not Found', 'parkers-pharma');
    }

    echo '<ul class="breadcrumb-list">';
    foreach ($items as $item) {
        echo '<li>' . $item . '</li>';
    }
    echo '</ul>';
}
