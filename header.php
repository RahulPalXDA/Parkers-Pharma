<!DOCTYPE html>
<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <!-- top bar start -->
    <section class="top-bar">
        <div class="custom-container">
            <ul class="call-us-box">
                <li><span><?php echo esc_html(get_field('topbar_text', 'option')); ?></span>
                    <?php
                    $topbar_link = get_field('text_link', 'option');
                    if ($topbar_link):
                        $topbar_link_url = $topbar_link['url'];
                        $topbar_link_title = $topbar_link['title'];
                        $topbar_link_target = $topbar_link['target'] ? $topbar_link['target'] : '_self';
                        ?>
                        <a href="<?php echo esc_url($topbar_link_url); ?>"
                            target="<?php echo esc_attr($topbar_link_target); ?>"><?php echo esc_html($topbar_link_title); ?></a>
                    <?php endif; ?>
            </ul>
        </div>
    </section>
    <!-- top bar end -->
    <!-- top navbar start -->
    <nav class="top-navbar navbar navbar-expand-lg" id="topNavBar">
        <div class="custom-container">
            <div class="navbar-wrapper">
                <?php the_custom_logo(); ?>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbar-content">
                    <div class="hamburger-toggle">
                        <div class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="navbar-content">
                    <div class="only_mobile_view">
                        <div class="mobile_logo">
                            <?php the_custom_logo(); ?>
                        </div>
                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbar-content">
                            <div class="hamburger-toggle">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/close-btn.png"
                                    alt="<?php esc_attr_e('Close', 'parkers-pharma'); ?>">
                            </div>
                        </button>
                    </div>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'navbar-nav',
                        'container' => false,
                        'walker' => new Header_Menu_Walker(),
                    ));
                    ?>
                    <div class="conatact-btn">
                        <?php
                        $header_button_link = get_field('header_button', 'option');
                        if ($header_button_link):
                            $header_button_link_url = $header_button_link['url'];
                            $header_button_link_title = $header_button_link['title'];
                            $header_button_link_target = $header_button_link['target'] ? $header_button_link['target'] : '_self';
                            ?>
                            <a class="global-solid-button" href="<?php echo esc_url($header_button_link_url); ?>"
                                target="<?php echo esc_attr($header_button_link_target); ?>"><?php echo esc_html($header_button_link_title); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- top navbar end -->