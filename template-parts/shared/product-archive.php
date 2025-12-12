<?php
if (!defined('ABSPATH')) {
    exit;
}

$is_product_category = is_tax('product_cat');

if ($is_product_category) {
    $term = get_queried_object();
    $upper_header = !empty($term->description) ? $term->description : '';
} else {
    $upper_header = get_field('products_archive_text', 'option');
}
?>
<section class="product-listing-sec">
    <div class="custom-container">
        <?php if (!empty($upper_header)): ?>
            <h4 class="upper-header"><?php echo wp_kses_post($upper_header); ?></h4>
        <?php endif; ?>
        <?php if (have_posts()): ?>
            <div class="row">
                <?php while (have_posts()):
                    the_post(); ?>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="product-list-sec">
                            <div class="image-box">
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                            <div class="cntn-box">
                                <?php $terms = get_the_terms(get_the_ID(), 'product_cat');
                                if ($terms && !is_wp_error($terms)) {
                                    echo "<h6>" . esc_html(implode(', ', wp_list_pluck($terms, 'name'))) . "</h6>";
                                }
                                ?>
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 26); ?></p>
                                <a href="<?php the_permalink(); ?>"
                                    class="global-light-button"><?php echo esc_html__('View Details', 'parkers-pharma'); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="parkers-pagination">
                        <?php
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => __('&laquo; Previous', 'parkers-pharma'),
                            'next_text' => __('Next &raquo;', 'parkers-pharma'),
                        ));
                        ?>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <p><?php esc_html_e('No products found.', 'parkers-pharma'); ?></p>
        <?php endif; ?>
    </div>
</section>