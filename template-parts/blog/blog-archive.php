<?php
if (!defined('ABSPATH')) {
    exit;
}
global $post_id;
?>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'posts_per_page' => get_option('posts_per_page'),
    'post_status' => 'publish',
    'paged' => $paged,
);

$query = new WP_Query($args);
?>
<section class="blog-list-sec">
    <div class="custom-container">
        <div class="upper-header">
            <h2><?php echo esc_html(get_field('blog_section_heading', 'option')); ?></h2>
        </div>
        <?php if ($query->have_posts()): ?>
            <div class="row">
                <?php while ($query->have_posts()):
                    $query->the_post(); ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="news-item space-up-reduce">
                            <div class="image-box">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>"
                                        alt="<?php the_title(); ?>">
                                </a>
                            </div>
                            <div class="cntn-box">
                                <h6><span><i class="fa-solid fa-calendar-days"></i></span><?php echo get_the_date(); ?></h6>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php the_excerpt(); ?>
                                <a href="<?php the_permalink(); ?>" class="global-light-button">Learn More</a>
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