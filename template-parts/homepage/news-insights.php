<?php
if (!defined('ABSPATH')) {
    exit; 
}
global $post_id;
?>
<!-- stay update news start -->
<section class="stay-update-sec">
    <div class="custom-container">
        <div class="global-header">
            <h5><?php echo esc_html(get_field('news_section_name', $post_id)); ?></h5>
            <h2><?php echo esc_html(get_field('news_section_title', $post_id)); ?></h2>
        </div>
        <?php
        $readmore = get_field('news_section_read_more_text', $post_id);
        $cpt_name = !empty(get_field('cpt_name_field', $post_id)) ? get_field('cpt_name_field', $post_id) : 'post';
        $posts_to_show = !empty(get_field('posts_to_show_field', $post_id)) ? get_field('posts_to_show_field', $post_id) : 3;
        $args = array(
            'post_type' => $cpt_name,
            'posts_per_page' => $posts_to_show,
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $latest_news = new WP_Query($args); ?>
        <div class="row">
            <?php if ($latest_news->have_posts()):
                while ($latest_news->have_posts()):
                    $latest_news->the_post(); ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="news-item">
                            <?php if (has_post_thumbnail()): ?>
                                <a href="<?php the_permalink(); ?>">
                                    <div class="image-box">
                                        <?php the_post_thumbnail('large'); ?>
                                    </div>
                                </a>
                            <?php endif; ?>
                            <div class="cntn-box">
                                <h6><?php echo get_the_date(); ?></h6>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <p><?php echo wp_trim_words(get_the_excerpt(), 18, '...'); ?></p>
                                <a href="<?php the_permalink(); ?>"
                                    class="global-light-button"><?php echo esc_html($readmore); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <?php echo '<p>' . esc_html__('No posts found.', 'parkers-pharma') . '</p>'; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- stay update news end -->