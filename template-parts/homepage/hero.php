<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
global $post_id;
?>
<!-- hero banner -->
<section class="home-hero-banner">
    <div class="hero-poster"></div>
    <div class="video-blocker"></div>
    <iframe id="heroVideo" data-video="<?php echo esc_attr(get_field('video_link', $post_id)); ?>"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen>
    </iframe>

    <div class="custom-container">
        <div class="hero-banner-inner">
            <h1><?php echo wp_kses_post(get_field('hero_text', $post_id)); ?></h1>
            <div class="banner-video-button" id="videoPlayBtn">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/play-button.png" alt=""
                    class="play-btn-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pause-button.png" alt=""
                    class="pause-btn-icon">
            </div>
        </div>
    </div>
</section>
<!-- hero banner -->