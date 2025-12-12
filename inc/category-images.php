<?php
if (!defined('ABSPATH')) {
    exit;
}

// Category Image Support
function parkers_admin_scripts()
{
    wp_enqueue_media();
    wp_enqueue_script('parkers-admin-upload', get_template_directory_uri() . '/assets/js/admin-upload.js', array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'parkers_admin_scripts');

// Product Category - Image field only (for side image)
function parkers_add_product_cat_image_field($taxonomy)
{
    ?>
    <div class="form-field term-group">
        <label for="category-image-id"><?php _e('Image', 'parkers-pharma'); ?></label>
        <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
        <div id="category-image-wrapper"></div>
        <p>
            <input type="button" class="button button-secondary parkers_media_button" id="parkers_media_button"
                name="parkers_media_button" value="<?php _e('Add Image', 'parkers-pharma'); ?>" />
            <input type="button" class="button button-secondary parkers_media_remove" id="parkers_media_remove"
                name="parkers_media_remove" value="<?php _e('Remove Image', 'parkers-pharma'); ?>" style="display:none;" />
        </p>
    </div>
    <?php
}
add_action('product_cat_add_form_fields', 'parkers_add_product_cat_image_field', 10, 2);

function parkers_edit_product_cat_image_field($term, $taxonomy)
{
    $image_id = get_term_meta($term->term_id, 'category-image-id', true);
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="category-image-id"><?php _e('Image', 'parkers-pharma'); ?></label>
        </th>
        <td>
            <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo esc_attr($image_id); ?>">
            <div id="category-image-wrapper">
                <?php if ($image_id) { ?>
                    <?php echo wp_get_attachment_image($image_id, 'thumbnail'); ?>
                <?php } ?>
            </div>
            <p>
                <input type="button" class="button button-secondary parkers_media_button" id="parkers_media_button"
                    name="parkers_media_button" value="<?php _e('Add Image', 'parkers-pharma'); ?>" />
                <input type="button" class="button button-secondary parkers_media_remove" id="parkers_media_remove"
                    name="parkers_media_remove" value="<?php _e('Remove Image', 'parkers-pharma'); ?>"
                    style="<?php echo is_numeric($image_id) ? '' : 'display:none;'; ?>" />
            </p>
        </td>
    </tr>
    <?php
}
add_action('product_cat_edit_form_fields', 'parkers_edit_product_cat_image_field', 10, 2);

function parkers_save_product_cat_image($term_id, $tt_id)
{
    if (isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']) {
        update_term_meta($term_id, 'category-image-id', sanitize_text_field($_POST['category-image-id']));
    } else {
        update_term_meta($term_id, 'category-image-id', '');
    }
}
add_action('created_product_cat', 'parkers_save_product_cat_image', 10, 2);
add_action('edited_product_cat', 'parkers_save_product_cat_image', 10, 2);

// Post Category - Banner image field only
function parkers_add_category_banner_field($taxonomy)
{
    ?>
    <div class="form-field term-group">
        <label for="category-banner-id"><?php _e('Banner Image', 'parkers-pharma'); ?></label>
        <input type="hidden" id="category-banner-id" name="category-banner-id" class="custom_media_url" value="">
        <div id="category-banner-wrapper"></div>
        <p>
            <input type="button" class="button button-secondary parkers_banner_button" id="parkers_banner_button"
                name="parkers_banner_button" value="<?php _e('Add Banner', 'parkers-pharma'); ?>" />
            <input type="button" class="button button-secondary parkers_banner_remove" id="parkers_banner_remove"
                name="parkers_banner_remove" value="<?php _e('Remove Banner', 'parkers-pharma'); ?>"
                style="display:none;" />
        </p>
    </div>
    <?php
}
add_action('category_add_form_fields', 'parkers_add_category_banner_field', 10, 2);

function parkers_edit_category_banner_field($term, $taxonomy)
{
    $banner_id = get_term_meta($term->term_id, 'category-banner-id', true);
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="category-banner-id"><?php _e('Banner Image', 'parkers-pharma'); ?></label>
        </th>
        <td>
            <input type="hidden" id="category-banner-id" name="category-banner-id"
                value="<?php echo esc_attr($banner_id); ?>">
            <div id="category-banner-wrapper">
                <?php if ($banner_id) { ?>
                    <?php echo wp_get_attachment_image($banner_id, 'thumbnail'); ?>
                <?php } ?>
            </div>
            <p>
                <input type="button" class="button button-secondary parkers_banner_button" id="parkers_banner_button"
                    name="parkers_banner_button" value="<?php _e('Add Banner', 'parkers-pharma'); ?>" />
                <input type="button" class="button button-secondary parkers_banner_remove" id="parkers_banner_remove"
                    name="parkers_banner_remove" value="<?php _e('Remove Banner', 'parkers-pharma'); ?>"
                    style="<?php echo is_numeric($banner_id) ? '' : 'display:none;'; ?>" />
            </p>
        </td>
    </tr>
    <?php
}
add_action('category_edit_form_fields', 'parkers_edit_category_banner_field', 10, 2);

function parkers_save_category_banner($term_id, $tt_id)
{
    if (isset($_POST['category-banner-id']) && '' !== $_POST['category-banner-id']) {
        update_term_meta($term_id, 'category-banner-id', sanitize_text_field($_POST['category-banner-id']));
    } else {
        update_term_meta($term_id, 'category-banner-id', '');
    }
}
add_action('created_category', 'parkers_save_category_banner', 10, 2);
add_action('edited_category', 'parkers_save_category_banner', 10, 2);