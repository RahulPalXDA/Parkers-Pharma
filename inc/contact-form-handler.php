<?php
if (!defined('ABSPATH')) {
    exit;
}

function parkers_contact_form_scripts()
{
    if (is_page_template('templates/contact.php')) {
        wp_localize_script('jquery', 'parkers_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('parkers_contact_form_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'parkers_contact_form_scripts');

function parkers_contact_form_handler()
{
    error_log('Parkers Contact Form: Handler triggered');
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'parkers_contact_form_nonce')) {
        wp_send_json_error(array('message' => __('Security check failed.', 'parkers-pharma')), 403);
        exit;
    }

    $patterns = array(
        'first_name' => '/^[A-Za-z\s]{2,50}$/',
        'last_name' => '/^[A-Za-z\s]{1,50}$/',
        'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        'phone' => '/^[\d\-\+\(\)\s]{9,20}$/',
        'message' => '/^[\s\S]{1,2000}$/'
    );

    $xss_pattern = '/<script|javascript:/i';

    $fields = array('first_name', 'last_name', 'email', 'phone', 'message');
    $data = array();
    $errors = array();

    foreach ($fields as $field) {
        $value = isset($_POST[$field]) ? trim($_POST[$field]) : '';
        $value = stripslashes($value);

        // Check for XSS attempts (script tags)
        if (preg_match($xss_pattern, $value)) {
            wp_send_json_error(array('message' => __('Invalid input detected.', 'parkers-pharma')), 400);
            exit;
        }

        if ($field === 'first_name' && empty($value)) {
            $errors[] = __('First name is required.', 'parkers-pharma');
        }
        if ($field === 'last_name' && empty($value)) {
            $errors[] = __('Last name is required.', 'parkers-pharma');
        }
        if ($field === 'email' && empty($value)) {
            $errors[] = __('Email is required.', 'parkers-pharma');
        }
        if ($field === 'phone' && empty($value)) {
            $errors[] = __('Phone number is required.', 'parkers-pharma');
        }
        if ($field === 'message' && empty($value)) {
            $errors[] = __('Message is required.', 'parkers-pharma');
        }

        if (!empty($value) && isset($patterns[$field])) {
            if (!preg_match($patterns[$field], $value)) {
                $errors[] = sprintf(__('%s is invalid.', 'parkers-pharma'), ucfirst(str_replace('_', ' ', $field)));
            }
        }

        // Use WordPress sanitization (no HTML encoding needed for plain text email)
        $data[$field] = sanitize_text_field($value);
    }

    // Re-sanitize email and message with appropriate functions
    $data['email'] = sanitize_email($_POST['email'] ?? '');
    $data['message'] = sanitize_textarea_field($_POST['message'] ?? '');

    if (!empty($errors)) {
        wp_send_json_error(array('message' => implode(' ', $errors)), 400);
        exit;
    }
    // Store submission in database as backup
    $submission_id = wp_insert_post(array(
        'post_type' => 'contact_submission',
        'post_status' => 'private',
        'post_title' => 'Contact: ' . $data['first_name'] . ' ' . $data['last_name'],
        'post_content' => $data['message'],
        'meta_input' => array(
            'contact_email' => $data['email'],
            'contact_phone' => $data['phone'],
            'contact_first_name' => $data['first_name'],
            'contact_last_name' => $data['last_name'],
            'submission_date' => current_time('mysql')
        )
    ));

    // Send email with form data
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    // Using working subject format
    $subject = '[' . $site_name . '] Contact Form - New Message';
    $email_body = "You have received a new contact form message.\n\n";
    $email_body .= "Sender Details:\n";
    $email_body .= "Name: " . $data['first_name'] . " " . $data['last_name'] . "\n";
    $email_body .= "Email: " . $data['email'] . "\n";
    $email_body .= "Phone: " . $data['phone'] . "\n\n";
    $email_body .= "Message:\n" . $data['message'] . "\n\n";
    $email_body .= "Sent at: " . current_time('mysql');

    // Set From name to site name instead of WordPress
    $headers = array('From: ' . $site_name . ' <' . $admin_email . '>');
    $sent = wp_mail($admin_email, $subject, $email_body, $headers);

    // Log for debugging
    if (!$sent) {
        error_log('Parkers Contact Form: Email failed to ' . $admin_email . ' | Submission ID: ' . $submission_id);
    } else {
        error_log('Parkers Contact Form: Email sent successfully to ' . $admin_email);
    }

    // Success response
    if ($submission_id) {
        wp_send_json_success(array(
            'message' => __('Thank you! Your message has been sent successfully.', 'parkers-pharma')
        ));
    } else {
        wp_send_json_error(array('message' => __('Failed to process submission. Please try again.', 'parkers-pharma')), 500);
    }
    exit;
}
add_action('wp_ajax_parkers_contact_form', 'parkers_contact_form_handler');
add_action('wp_ajax_nopriv_parkers_contact_form', 'parkers_contact_form_handler');

function parkers_add_test_email_page()
{
    add_submenu_page(
        'edit.php?post_type=contact_submission',
        'Test Email',
        'Test Email',
        'manage_options',
        'parkers-test-email',
        'parkers_test_email_page'
    );
}
add_action('admin_menu', 'parkers_add_test_email_page');

function parkers_test_email_page()
{
    $message = '';

    if (isset($_POST['send_test_email']) && check_admin_referer('parkers_test_email_nonce')) {
        $admin_email = get_option('admin_email');
        $site_name = get_bloginfo('name');

        $subject = '[' . $site_name . '] Test Email';
        $body = "This is a test email from your contact form.\n\n";
        $body .= "If you received this email, your email configuration is working correctly.\n\n";
        $body .= "Sent at: " . current_time('mysql');

        $sent = wp_mail($admin_email, $subject, $body);

        if ($sent) {
            $message = '<div class="notice notice-success"><p>Test email sent successfully to <strong>' . esc_html($admin_email) . '</strong>. Please check your inbox (and spam folder).</p></div>';
        } else {
            $message = '<div class="notice notice-error"><p>Failed to send test email. Please check your email configuration.</p></div>';
        }
    }

    ?>
    <div class="wrap">
        <h1>Test Email Configuration</h1>
        <?php echo $message; ?>
        <p>Click the button below to send a test email to
            <strong><?php echo esc_html(get_option('admin_email')); ?></strong>
        </p>
        <form method="post">
            <?php wp_nonce_field('parkers_test_email_nonce'); ?>
            <p>
                <button type="submit" name="send_test_email" class="button button-primary">Send Test Email</button>
            </p>
        </form>
        <hr>
        <h2>Email Configuration Info</h2>
        <table class="form-table">
            <tr>
                <th>Admin Email</th>
                <td><?php echo esc_html(get_option('admin_email')); ?></td>
            </tr>
            <tr>
                <th>Site Name</th>
                <td><?php echo esc_html(get_bloginfo('name')); ?></td>
            </tr>
        </table>
    </div>
    <?php
}
