<?php
if (!defined('ABSPATH')) {
    exit;
}
global $post_id;

$terms = get_terms(array(
    'taxonomy' => 'resources_cat',
    'hide_empty' => true
));

$categories = [];

if (!empty($terms) && !is_wp_error($terms)) {
    foreach ($terms as $term) {
        $categories[$term->slug] = $term->name;
    }
}
?>
<!-- download resource start -->
<section class="download-resource-sec">
    <div class="custom-container">
        <div class="global-header">
            <h6><?php echo wp_kses_post(get_field('upper_paragraph', $post_id)); ?></h6>
        </div>

        <ul class="nav nav-pills pdf-tab-list" id="pills-tab" role="tablist">
            <?php
            $i = 0;
            foreach ($categories as $slug => $name) {
                $active_class = ($i === 0) ? 'active' : '';
                ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?php echo esc_attr($active_class); ?>" id="<?php echo esc_attr($slug); ?>-tab"
                        data-bs-toggle="pill" data-bs-target="#<?php echo esc_attr($slug); ?>" type="button" role="tab">
                        <?php echo esc_html($name); ?>
                    </button>
                </li>
                <?php
                $i++;
            }
            ?>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <?php
            $j = 0;
            foreach ($categories as $slug => $name) {
                $pane_active_class = ($j === 0) ? 'show active' : '';

                $args = array(
                    'post_type' => 'resources',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'resources_cat',
                            'field' => 'slug',
                            'terms' => $slug
                        )
                    )
                );
                $query = new WP_Query($args);
                ?>
                <div class="tab-pane fade <?php echo esc_attr($pane_active_class); ?>" id="<?php echo esc_attr($slug); ?>"
                    role="tabpanel">
                    <?php if ($query->have_posts()):
                        while ($query->have_posts()):
                            $query->the_post();
                            $file = get_field('file'); // Ensure your ACF field name is 'file'
                            $file_url = is_array($file) ? $file['url'] : $file;
                            ?>
                            <div class="download-res-item">
                                <h5 class="mb-0"><?php the_title(); ?></h5>
                                <?php if ($file_url): ?>
                                    <a href="<?php echo esc_url($file_url); ?>" download class="global-solid-button">
                                        <?php _e('DOWNLOAD PDF', 'parkers-pharma'); ?>
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="no-file"><?php _e('Coming Soon', 'parkers-pharma'); ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                    else: ?>
                        <p><?php _e('No resources found in this category.', 'parkers-pharma'); ?></p>
                    <?php endif; ?>
                </div>
                <?php
                $j++;
            } ?>
        </div>
    </div>
</section>
<!-- download resource end -->