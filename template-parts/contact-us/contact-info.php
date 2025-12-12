<?php if (!defined('ABSPATH')) {
    exit;
} ?>
<!-- contact info start -->
<section class="contact-info-sec">
    <div class="custom-container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-item">
                    <span>
                        <i class="fa-solid fa-location-dot"></i>
                    </span>
                    <h4><?php esc_html_e('Address', 'parkers-pharma'); ?></h4>
                    <p><?php echo get_field('contact_address', 'option'); ?></p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-item">
                    <span>
                        <i class="fa-solid fa-phone"></i>
                    </span>
                    <h4><?php esc_html_e('Phone number', 'parkers-pharma'); ?></h4>
                    <?php
                    $contact_phone = get_field('contact_phone', 'option');
                    if ($contact_phone):
                        $contact_phone_url = $contact_phone['url'];
                        $contact_phone_title = $contact_phone['title'];
                        $contact_phone_target = $contact_phone['target'] ? $contact_phone['target'] : '_self';
                        ?>
                        <p><a href="<?php echo esc_url($contact_phone_url); ?>"
                                target="<?php echo esc_attr($contact_phone_target); ?>"><?php echo esc_html($contact_phone_title); ?></a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                <div class="contact-info-item">
                    <span>
                        <i class="fa-solid fa-envelope"></i>
                    </span>
                    <h4><?php esc_html_e('Email address', 'parkers-pharma'); ?></h4>
                    <?php
                    $contact_email = get_field('contact_email', 'option');
                    if ($contact_email):
                        $contact_email_url = $contact_email['url'];
                        $contact_email_title = $contact_email['title'];
                        $contact_email_target = $contact_email['target'] ? $contact_email['target'] : '_self';
                        ?>
                        <p><a href="<?php echo esc_url($contact_email_url); ?>"
                                target="<?php echo esc_attr($contact_email_target); ?>"><?php echo esc_html($contact_email_title); ?></a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact info end -->