<?php
if (!defined('ABSPATH')) {
    exit;
}

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post',
    'posts_per_page' => get_option('posts_per_page'),
    'post_status' => 'publish',
    'paged' => $paged,
    'category_name' => 'press-events',
);

$query = new WP_Query($args);
?>
<!-- news events start -->
<section class="news-event-lists-sec">
    <div class="custom-container">
        <div class="global-header">
            <h6><?php echo wp_kses_post(get_field('prec_section_upper_paragraph', 'option')); ?></h6>
        </div>
        <?php if ($query->have_posts()): ?>
            <div class="row">
                <?php while ($query->have_posts()):
                    $query->the_post(); ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="news-events-item">
                            <div class="thumbnail-box">
                                <!-- <span class="play-icon"><i class="fa-solid fa-play"></i></span> -->
                                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>"
                                    alt="<?php the_title(); ?>">
                            </div>
                            <div class="cntn-box">
                                <h3><?php the_title(); ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="parkers-pagination">
                        <nav class="pagination">
                            <div class="nav-links">
                                <?php
                                $big = 999999999;
                                echo paginate_links(array(
                                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                    'format' => '?paged=%#%',
                                    'current' => max(1, $paged),
                                    'total' => $query->max_num_pages,
                                    'prev_text' => __('&laquo; Previous', 'parkers-pharma'),
                                    'next_text' => __('Next &raquo;', 'parkers-pharma'),
                                ));
                                ?>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</section>
<!-- news events end -->