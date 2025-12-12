<?php
if (!defined('ABSPATH')) {
    exit; 
}
global $post_id;
?>
<!-- educational resource start -->
<section class="education-resource-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="cntn-box">
                    <div class="global-header">
                        <h5><?php echo esc_html(get_field('resources_section_name', $post_id)); ?></h5>
                        <h2><?php echo esc_html(get_field('resources_section_heading', $post_id)); ?></h2>
                        <p><?php echo esc_html(get_field('resources_section_description', $post_id)); ?></p>
                        <?php
                        $resources_cta_link = get_field('resources_section_cta', $post_id);
                        if ($resources_cta_link):
                            $resources_cta_link_url = $resources_cta_link['url'];
                            $resources_cta_link_title = $resources_cta_link['title'];
                            $resources_cta_link_target = $resources_cta_link['target'] ? $resources_cta_link['target'] : '_self';
                            ?>
                            <a class="global-solid-button" href="<?php echo esc_url($resources_cta_link_url); ?>"
                                target="<?php echo esc_attr($resources_cta_link_target); ?>"><?php echo esc_html($resources_cta_link_title); ?></a>
                        <?php endif; ?>
                    </div>
                    <?php
                    $section_featured_image = get_field('resources_section_featured_image', $post_id);
                    if (!empty($section_featured_image)): ?>
                        <div class="cntn-rgt-thumb">
                            <img src="<?php echo esc_url($section_featured_image['url']); ?>"
                                alt="<?php echo esc_attr($section_featured_image['alt']); ?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php $section_side_image = get_field('resources_section_side_image', $post_id);
            if (!empty($section_side_image)): ?>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="image-box">
                        <img src="<?php echo esc_url($section_side_image['url']); ?>"
                            alt="<?php echo esc_attr($section_side_image['alt']); ?>">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- educational resource end -->