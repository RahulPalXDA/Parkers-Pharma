<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
global $post_id;
?>
<!-- about agri veta start -->
<div class="about-agri-veta-sec">
    <div class="custom-container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="image-box">
                    <div class="global-header">
                        <h5><?php echo esc_html(get_field('about_section_name', $post_id)); ?></h5>
                        <h2><?php echo esc_html(get_field('about_section_title', $post_id)); ?></h2>
                    </div>
                    <?php
                    $section_image = get_field('about_section_image', $post_id);
                    if (!empty($section_image)): ?>
                        <img src="<?php echo esc_url($section_image['url']); ?>"
                            alt="<?php echo esc_attr($section_image['alt']); ?>">
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div class="content-box">
                    <p><?php echo esc_html(get_field('about_section_desctiption', $post_id)); ?></p>
                    <?php
                    $about_cta_link = get_field('about_section_cta', $post_id);
                    if ($about_cta_link):
                        $about_cta_link_url = $about_cta_link['url'];
                        $about_cta_link_title = $about_cta_link['title'];
                        $about_cta_link_target = $about_cta_link['target'] ? $about_cta_link['target'] : '_self';
                        ?>
                        <a class="global-solid-button" href="<?php echo esc_url($about_cta_link_url); ?>"
                            target="<?php echo esc_attr($about_cta_link_target); ?>"><?php echo esc_html($about_cta_link_title); ?></a>
                    <?php endif; ?>
                    <?php if (have_rows('about_section_counter', $post_id)): ?>
                        <div class="abt-feature-cards">
                            <?php while (have_rows('about_section_counter', $post_id)):
                                the_row(); ?>
                                <div class="abt-card">
                                    <h3><?php echo esc_html(get_sub_field('counter_number')); ?>
                                        <?php echo esc_html(get_sub_field('counter_postfix')); ?>
                                    </h3>
                                    <h5><?php echo esc_html(get_sub_field('counter_title')); ?></h5>
                                    <p><?php echo esc_html(get_sub_field('counter_description')); ?></p>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- about agri veta end -->