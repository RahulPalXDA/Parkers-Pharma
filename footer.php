<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
$top_ftr_space = get_query_var('top_ftr_space');
?>
<!-- footer start -->
<footer class="footer <?php echo $top_ftr_space ? 'top-ftr-space' : ''; ?>">
    <div class="custom-container">
        <div class="flex-box">
            <div class="footer-logo">
                <?php the_custom_logo(); ?>
            </div>
            <div class="footer-nav">
                <h3 class="ftr-header"><?php esc_html_e('Quick Links', 'parkers-pharma'); ?></h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => false,
                    'walker' => new Footer_Menu_Walker(),
                ));
                ?>
            </div>
            <div class="footer-nav">
                <h3 class="ftr-header"><?php esc_html_e('Social media', 'parkers-pharma'); ?></h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'social',
                    'container' => false,
                ));
                ?>
            </div>
            <div class="footer-nav">
                <h3 class="ftr-header"><?php esc_html_e('Contact Us', 'parkers-pharma'); ?></h3>
                <ul>
                    <li><span class="icon-box"><i class="fa-solid fa-location-dot"></i></span> <span
                            class="ftr-cntc-info"><?php echo get_field('contact_address', 'option'); ?></span>
                    </li>
                    <li>
                        <?php
                        $contact_phone = get_field('contact_phone', 'option');
                        if ($contact_phone):
                            $contact_phone_url = $contact_phone['url'];
                            $contact_phone_title = $contact_phone['title'];
                            $contact_phone_target = $contact_phone['target'] ? $contact_phone['target'] : '_self';
                            ?>
                            <a href="<?php echo esc_url($contact_phone_url); ?>"
                                target="<?php echo esc_attr($contact_phone_target); ?>"><span class="icon-box"><i
                                        class="fa-solid fa-phone"></i></span><span
                                    class="ftr-cntc-info"><?php echo esc_html($contact_phone_title); ?></a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php
                        $contact_email = get_field('contact_email', 'option');
                        if ($contact_email):
                            $contact_email_url = $contact_email['url'];
                            $contact_email_title = $contact_email['title'];
                            $contact_email_target = $contact_email['target'] ? $contact_email['target'] : '_self';
                            ?>
                            <a href="<?php echo esc_url($contact_email_url); ?>"
                                target="<?php echo esc_attr($contact_email_target); ?>"><span class="icon-box"><i
                                        class="fa-solid fa-envelope"></i></span><span
                                    class="ftr-cntc-info"><?php echo esc_html($contact_email_title); ?></a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
            <div class="footer-nav">
                <h3 class="ftr-header"><?php esc_html_e('Newsletter', 'parkers-pharma'); ?></h3>
                <div class="subscribe-section">
                    <input type="email" placeholder="<?php esc_attr_e('Enter email address', 'parkers-pharma'); ?>"
                        class="email-input">
                    <button class="global-solid-button"><?php esc_html_e('SUBSCRIBE', 'parkers-pharma'); ?></button>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>Copyright © <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?> -
                <?php echo esc_html(get_field('footer_reserved_text', 'option')); ?>
            </p>
            <?php if (have_rows('footer_links', 'option')): ?>
                <ul>
                    <?php while (have_rows('footer_links', 'option')):
                        the_row();
                        $footer_link = get_sub_field('footer_link');
                        if ($footer_link):
                            $footer_link_url = $footer_link['url'];
                            $footer_link_title = $footer_link['title'];
                            $footer_link_target = $footer_link['target'] ? $footer_link['target'] : '_self';
                            ?>
                            <li><a href="<?php echo esc_url($footer_link_url); ?>"
                                    target="<?php echo esc_attr($footer_link_target); ?>"><?php echo esc_html($footer_link_title); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</footer>
<!-- footer end -->
<?php wp_footer(); ?>
</body>

</html>