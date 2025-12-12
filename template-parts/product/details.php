<?php
if (!defined('ABSPATH')) {
    exit;
}
global $post_id;
?>
<section class="product-details-sec">
    <div class="custom-container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="product-image-box">
                    <?php echo wp_kses_post(get_the_post_thumbnail()); ?>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="product-info-rgt">
                    <?php $terms = get_the_terms(get_the_ID(), 'product_cat');
                    if ($terms && !is_wp_error($terms)) {
                        echo "<h6>" . esc_html(implode(', ', wp_list_pluck($terms, 'name'))) . "</h6>";
                    }
                    ?>
                    <h2>
                        <?php the_title(); ?>
                    </h2>
                    <?php the_content(); ?>
                    <?php if (have_rows('upper_points', $post_id)): ?>
                        <div class="product-table-lists">
                            <?php while (have_rows('upper_points', $post_id)):
                                the_row(); ?>
                                <div class="detail-list">
                                    <h3><?php echo get_sub_field('upper_points_name'); ?></h3>
                                    <p><?php echo get_sub_field('upper_point_descripton'); ?></p>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <?php if (!empty(get_field('mode_of_application', $post_id))): ?>
                    <div class="btm-proct-details-box">
                        <h3><?php esc_html_e('Mode of Application', 'parkers-pharma'); ?></h3>
                        <?php the_field('mode_of_application', $post_id); ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty(get_field('type_of_pest_controlled', $post_id))): ?>
                    <div class="btm-proct-details-box">
                        <h3><?php esc_html_e('Type of Pest Controlled', 'parkers-pharma'); ?></h3>
                        <?php the_field('type_of_pest_controlled', $post_id); ?>
                    </div>
                <?php endif; ?>
                <?php if (have_rows('lower_points', $post_id)): ?>
                    <div class="product-table-lists">
                        <?php while (have_rows('lower_points', $post_id)):
                            the_row(); ?>
                            <div class="detail-list">
                                <h3><?php echo get_sub_field('lower_points_name'); ?></h3>
                                <p><?php echo get_sub_field('lower_point_descripton'); ?></p>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>