<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
/**
 * Register Custom Post Types and Taxonomies
 *
 * @package Parkers_Pharma
 */

function parkers_register_product_cpt()
{
    $labels = array(
        'name' => _x('Products', 'Post Type General Name', 'parkers-pharma'),
        'singular_name' => _x('Product', 'Post Type Singular Name', 'parkers-pharma'),
        'menu_name' => __('Products', 'parkers-pharma'),
        'name_admin_bar' => __('Product', 'parkers-pharma'),
        'archives' => __('Product Archives', 'parkers-pharma'),
        'attributes' => __('Product Attributes', 'parkers-pharma'),
        'parent_item_colon' => __('Parent Product:', 'parkers-pharma'),
        'all_items' => __('All Products', 'parkers-pharma'),
        'add_new_item' => __('Add New Product', 'parkers-pharma'),
        'add_new' => __('Add New', 'parkers-pharma'),
        'new_item' => __('New Product', 'parkers-pharma'),
        'edit_item' => __('Edit Product', 'parkers-pharma'),
        'update_item' => __('Update Product', 'parkers-pharma'),
        'view_item' => __('View Product', 'parkers-pharma'),
        'view_items' => __('View Products', 'parkers-pharma'),
        'search_items' => __('Search Product', 'parkers-pharma'),
        'not_found' => __('Not found', 'parkers-pharma'),
        'not_found_in_trash' => __('Not found in Trash', 'parkers-pharma'),
        'featured_image' => __('Product Image', 'parkers-pharma'),
        'set_featured_image' => __('Set product image', 'parkers-pharma'),
        'remove_featured_image' => __('Remove product image', 'parkers-pharma'),
        'use_featured_image' => __('Use as product image', 'parkers-pharma'),
        'insert_into_item' => __('Insert into product', 'parkers-pharma'),
        'uploaded_to_this_item' => __('Uploaded to this product', 'parkers-pharma'),
        'items_list' => __('Products list', 'parkers-pharma'),
        'items_list_navigation' => __('Products list navigation', 'parkers-pharma'),
        'filter_items_list' => __('Filter products list', 'parkers-pharma'),
    );
    $args = array(
        'label' => __('Product', 'parkers-pharma'),
        'description' => __('Post Type for Products', 'parkers-pharma'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies' => array('product_cat'), // Replaced standard categories with custom taxonomy
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-cart',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'product', 'with_front' => true),
        'show_in_rest' => true,
    );
    register_post_type('product', $args);

}
add_action('init', 'parkers_register_product_cpt', 0);

function parkers_register_product_taxonomies()
{
    $labels = array(
        'name' => _x('Product Categories', 'taxonomy general name', 'parkers-pharma'),
        'singular_name' => _x('Product Category', 'taxonomy singular name', 'parkers-pharma'),
        'search_items' => __('Search Product Categories', 'parkers-pharma'),
        'all_items' => __('All Product Categories', 'parkers-pharma'),
        'parent_item' => __('Parent Product Category', 'parkers-pharma'),
        'parent_item_colon' => __('Parent Product Category:', 'parkers-pharma'),
        'edit_item' => __('Edit Product Category', 'parkers-pharma'),
        'update_item' => __('Update Product Category', 'parkers-pharma'),
        'add_new_item' => __('Add New Product Category', 'parkers-pharma'),
        'new_item_name' => __('New Product Category Name', 'parkers-pharma'),
        'menu_name' => __('Categories', 'parkers-pharma'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'product-category'),
        'show_in_rest' => true,
    );

    register_taxonomy('product_cat', array('product'), $args);
}
add_action('init', 'parkers_register_product_taxonomies', 0);

/**
 * Disable date-based archives for Products
 */
function parkers_disable_cpt_date_archives($query)
{
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_date() && isset($query->query_vars['post_type']) && $query->query_vars['post_type'] === 'product') {
            $query->set_404();
        }
    }
}
add_action('pre_get_posts', 'parkers_disable_cpt_date_archives');

function parkers_register_contact_submission_cpt()
{
    register_post_type('contact_submission', array(
        'labels' => array(
            'name' => __('Contact Submissions', 'parkers-pharma'),
            'singular_name' => __('Contact Submission', 'parkers-pharma'),
            'menu_name' => __('Contact Forms', 'parkers-pharma'),
            'all_items' => __('All Submissions', 'parkers-pharma'),
            'view_item' => __('View Submission', 'parkers-pharma'),
            'edit_item' => __('Edit Submission', 'parkers-pharma'),
            'search_items' => __('Search Submissions', 'parkers-pharma'),
            'not_found' => __('No submissions found', 'parkers-pharma'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-email-alt',
        'capability_type' => 'post',
        'capabilities' => array(
            'create_posts' => false,
        ),
        'map_meta_cap' => true,
        'supports' => array('title', 'editor'),
    ));
}
add_action('init', 'parkers_register_contact_submission_cpt');

// Add meta box for contact submission details
function parkers_contact_submission_meta_box()
{
    add_meta_box(
        'contact_submission_details',
        __('Contact Details', 'parkers-pharma'),
        'parkers_contact_submission_meta_box_callback',
        'contact_submission',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'parkers_contact_submission_meta_box');

function parkers_contact_submission_meta_box_callback($post)
{
    wp_nonce_field('parkers_contact_meta_nonce', 'contact_meta_nonce');

    $first_name = get_post_meta($post->ID, 'contact_first_name', true);
    $last_name = get_post_meta($post->ID, 'contact_last_name', true);
    $email = get_post_meta($post->ID, 'contact_email', true);
    $phone = get_post_meta($post->ID, 'contact_phone', true);
    $submission_date = get_post_meta($post->ID, 'submission_date', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="contact_first_name"><?php _e('First Name', 'parkers-pharma'); ?></label></th>
            <td><input type="text" id="contact_first_name" name="contact_first_name"
                    value="<?php echo esc_attr($first_name); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="contact_last_name"><?php _e('Last Name', 'parkers-pharma'); ?></label></th>
            <td><input type="text" id="contact_last_name" name="contact_last_name"
                    value="<?php echo esc_attr($last_name); ?>" class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="contact_email"><?php _e('Email', 'parkers-pharma'); ?></label></th>
            <td><input type="email" id="contact_email" name="contact_email" value="<?php echo esc_attr($email); ?>"
                    class="regular-text" /></td>
        </tr>
        <tr>
            <th><label for="contact_phone"><?php _e('Phone', 'parkers-pharma'); ?></label></th>
            <td><input type="text" id="contact_phone" name="contact_phone" value="<?php echo esc_attr($phone); ?>"
                    class="regular-text" /></td>
        </tr>
        <tr>
            <th><label><?php _e('Submitted On', 'parkers-pharma'); ?></label></th>
            <td><strong><?php echo esc_html($submission_date ?: get_the_date('Y-m-d H:i:s', $post->ID)); ?></strong></td>
        </tr>
    </table>
    <p class="description"><?php _e('The message content is shown in the editor above.', 'parkers-pharma'); ?></p>
    <?php
}

// Save meta box data
function parkers_save_contact_submission_meta($post_id)
{
    if (!isset($_POST['contact_meta_nonce']) || !wp_verify_nonce($_POST['contact_meta_nonce'], 'parkers_contact_meta_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array('contact_first_name', 'contact_last_name', 'contact_email', 'contact_phone');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_contact_submission', 'parkers_save_contact_submission_meta');

// Add custom columns to admin list
function parkers_contact_submission_columns($columns)
{
    $new_columns = array(
        'cb' => $columns['cb'],
        'title' => __('Subject', 'parkers-pharma'),
        'contact_name' => __('Name', 'parkers-pharma'),
        'contact_email' => __('Email', 'parkers-pharma'),
        'contact_phone' => __('Phone', 'parkers-pharma'),
        'date' => __('Date', 'parkers-pharma'),
    );
    return $new_columns;
}
add_filter('manage_contact_submission_posts_columns', 'parkers_contact_submission_columns');

// Populate custom columns
function parkers_contact_submission_column_content($column, $post_id)
{
    switch ($column) {
        case 'contact_name':
            $first = get_post_meta($post_id, 'contact_first_name', true);
            $last = get_post_meta($post_id, 'contact_last_name', true);
            echo esc_html($first . ' ' . $last);
            break;
        case 'contact_email':
            $email = get_post_meta($post_id, 'contact_email', true);
            echo '<a href="mailto:' . esc_attr($email) . '">' . esc_html($email) . '</a>';
            break;
        case 'contact_phone':
            echo esc_html(get_post_meta($post_id, 'contact_phone', true));
            break;
    }
}
add_action('manage_contact_submission_posts_custom_column', 'parkers_contact_submission_column_content', 10, 2);

// Make columns sortable
function parkers_contact_submission_sortable_columns($columns)
{
    $columns['contact_name'] = 'contact_name';
    $columns['contact_email'] = 'contact_email';
    return $columns;
}
add_filter('manage_edit-contact_submission_sortable_columns', 'parkers_contact_submission_sortable_columns');
