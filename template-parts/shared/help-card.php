<?php
if (!defined('ABSPATH')) {
    exit; 
}
global $post_id;
?>
<!-- help card start -->
<section class="here-help-sec">
    <div class="custom-container">
        <div class="here-help-box">
            <div class="content-box">
                <h2><?php echo get_field('help_card_title', $post_id); ?></h2>
                <p><?php echo esc_html(get_field('help_card_desctiotion', $post_id)); ?></p>
                <?php
                $help_cta_link = get_field('help_card_cta', $post_id);
                if ($help_cta_link):
                    $help_cta_link_url = $help_cta_link['url'];
                    $help_cta_link_title = $help_cta_link['title'];
                    $help_cta_link_target = $help_cta_link['target'] ? $help_cta_link['target'] : '_self';
                    ?>
                    <a class="global-solid-button" href="<?php echo esc_url($help_cta_link_url); ?>"
                        target="<?php echo esc_attr($help_cta_link_target); ?>"><?php echo esc_html($help_cta_link_title); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- here to help end -->