<?php
if (!defined('ABSPATH')) {
    exit;
}
global $post_id;

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'category_name' => 'case-studies',
);

$query = new WP_Query($args);
?>
<section class="similar-blog-sec">
    <div class="custom-container">
        <div class="global-header">
            <h2><?php echo esc_html(get_field('case_studies_heading', 'option')); ?></h2>
        </div>
        <?php if ($query->have_posts()): ?>
            <div class="row">
                <?php while ($query->have_posts()):
                    $query->the_post(); ?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="comprehensive-sol-item simi-blog">
                            <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>"
                                alt="<?php the_title(); ?>">
                            <div class="cntn-box">
                                <a href="<?php the_permalink(); ?>">
                                    <h4><?php the_title(); ?></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>