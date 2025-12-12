<?php if (!defined('ABSPATH')) {
    exit;
}

global $post_id;

$is_product_archive = is_post_type_archive('product');
$is_product_category = is_tax('product_cat');
$is_single_product = is_singular('product');
$is_category = (is_tax() || is_category() || is_tag());

$banner_image = '';
$page_title = '';
$side_image = null;

if ($is_product_archive) {
    $banner_image = get_field('product_archive_banner_background', 'option');
    $page_title = post_type_archive_title('', false);
    $banner_side_image = get_field('product_archive_product_image', 'option');
    if (!empty($banner_side_image)) {
        $side_image = array(
            'url' => $banner_side_image['url'],
            'alt' => $banner_side_image['alt']
        );
    }
} elseif ($is_product_category) {
    $term = get_queried_object();
    $banner_image = get_field('product_archive_banner_background', 'option');
    $page_title = single_term_title('', false);
    $image_id = get_term_meta($term->term_id, 'category-image-id', true);
    if ($image_id) {
        $image_url = wp_get_attachment_image_url($image_id, 'full');
        if ($image_url) {
            $side_image = array(
                'url' => $image_url,
                'alt' => $term->name
            );
        }
    }
} elseif ($is_single_product) {
    $banner_image = get_field('banner_background', $post_id);
    $page_title = get_the_title($post_id);
} elseif ($is_category) {
    $term = get_queried_object();
    $page_title = $term->name;
    $banner_image = '';

    // Check current term and ancestors for banner image
    $terms_to_check = array_merge([$term->term_id], get_ancestors($term->term_id, $term->taxonomy));
    foreach ($terms_to_check as $term_id) {
        $banner_id = get_term_meta($term_id, 'category-banner-id', true);
        if ($banner_id) {
            $banner_image = wp_get_attachment_image_url($banner_id, 'full');
            break;
        }
    }
    // Fallback to default banner from options
    if (empty($banner_image)) {
        $banner_image = get_field('default_banner_image', 'option');
    }
} else {
    $banner_image = get_field('banner_image', $post_id);
    $page_title = is_singular() ? get_the_title() : get_the_title($post_id);
}
?>
<!-- inner short banner start -->
<section class="inner-short-banner" style="background-image: url('<?php echo esc_url($banner_image); ?>'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;">
    <div class="banner-overlay"></div>
    <div class="custom-container">
        <div class="text-wrapper">
            <?php parkers_breadcrumbs(); ?>
            <h1><?php echo esc_html($page_title); ?></h1>
        </div>
        <?php if (!empty($side_image)): ?>
            <div class="banner-product-image">
                <img src="<?php echo esc_url($side_image['url']); ?>" alt="<?php echo esc_attr($side_image['alt']); ?>">
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- inner short banner end -->