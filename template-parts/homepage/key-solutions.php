<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
global $post_id;
?>
<!-- comprehensive solutions sec start -->
<section class="comprehensive-solutions-sec">
    <div class="custom-container">
        <div class="global-header">
            <h5><?php echo esc_html(get_field('solution_section_name', $post_id)); ?></h5>
            <h2><?php echo esc_html(get_field('solutions_section_heading', $post_id)); ?></h2>
        </div>
        <?php if (have_rows('solution_section_cards', $post_id)): ?>
            <div class="row">
                <?php while (have_rows('solution_section_cards', $post_id)):
                    the_row(); ?>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="comprehensive-sol-item">
                            <?php
                            $card_image = get_sub_field('solution_card_image');
                            if (!empty($card_image)): ?>
                                <img src="<?php echo esc_url($card_image['url']); ?>"
                                    alt="<?php echo esc_attr($card_image['alt']); ?>">
                            <?php endif; ?>
                            <div class="cntn-box">
                                <h4><?php echo esc_html(get_sub_field('solution_card_title')); ?></h4>
                                <p><?php echo esc_html(get_sub_field('solution_card_description')); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<!-- Comprehensive Solutions end -->