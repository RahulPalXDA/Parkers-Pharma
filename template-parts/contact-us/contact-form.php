<?php if (!defined('ABSPATH')) {
    exit;
}
global $post_id;
?>
<section class="contact-us-form"
    style="background-image: url('<?php echo esc_url(get_field('contactus_form_background_image', $post_id)) ?>');">
    <div class="custom-container">
        <div class="cntc-form-inner">
            <h2><?php echo esc_html(get_field('contactus_form_heading', $post_id)); ?></h2>
            <form id="parkers-contact-form" method="POST">
                <?php wp_nonce_field('parkers_contact_form_nonce', 'contact_nonce'); ?>
                <div class="row form-row">
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <label for="first_name"><?php _e('First Name', 'parkers-pharma'); ?></label>
                        <input type="text" class="form-control" name="first_name" id="first_name"
                            placeholder="<?php esc_attr_e('Enter first name', 'parkers-pharma'); ?>" required>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <label for="last_name"><?php _e('Last Name', 'parkers-pharma'); ?></label>
                        <input type="text" class="form-control" name="last_name" id="last_name"
                            placeholder="<?php esc_attr_e('Enter last name', 'parkers-pharma'); ?>">
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <label for="email"><?php _e('Email', 'parkers-pharma'); ?></label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="<?php esc_attr_e('Enter your email', 'parkers-pharma'); ?>" required>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <label for="phone"><?php _e('Phone number', 'parkers-pharma'); ?></label>
                        <input type="tel" class="form-control" name="phone" id="phone"
                            placeholder="<?php esc_attr_e('Enter your phone number', 'parkers-pharma'); ?>">
                    </div>
                    <div class="col-12">
                        <label for="message"><?php _e('How can we help you?', 'parkers-pharma'); ?></label>
                        <textarea class="form-control" rows="5" name="message" id="message"
                            placeholder="<?php esc_attr_e('Write a message *', 'parkers-pharma'); ?>"
                            required></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <div id="form-response" style="margin-bottom: 15px; display: none;"></div>
                        <button type="submit" id="submit-btn" class="global-solid-button" disabled
                            style="cursor: not-allowed;">
                            <?php _e('Send Now', 'parkers-pharma'); ?>
                        </button>
                    </div>
                </div>
            </form>
            <script>
                (function () {
                    const form = document.getElementById('parkers-contact-form');
                    const button = document.getElementById('submit-btn');
                    const responseDiv = document.getElementById('form-response');
                    const inputs = form.querySelectorAll('input, textarea');

                    const patterns = {
                        first_name: /^[A-Za-z\s]{2,50}$/,
                        last_name: /^[A-Za-z\s]{1,50}$/,
                        email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                        phone: /^[\d\-\+\(\)\s]{9,20}$/
                    };

                    const xssPattern = /<script|javascript:/i;

                    function validateField(field) {
                        const name = field.name;
                        const value = field.value.trim();

                        if (xssPattern.test(value)) return false;
                        if (field.tagName === 'TEXTAREA') return value.length > 0 && value.length <= 2000;
                        if (name === 'first_name') return patterns[name].test(value);
                        if (name === 'last_name') return patterns[name].test(value) && value.length > 0;
                        if (name === 'email') return patterns[name].test(value);
                        if (name === 'phone') return patterns[name].test(value) && value.length > 0;
                        if (patterns[name] && value) return patterns[name].test(value);
                        return true;
                    }

                    function updateBorder(field) {
                        const isValid = validateField(field);
                        const isRequired = field.hasAttribute('required');
                        const isEmpty = field.value.trim() === "";

                        if (!isValid || (isRequired && isEmpty && field.dataset.touched)) {
                            field.style.borderColor = "red";
                        } else {
                            field.style.borderColor = "";
                        }
                    }

                    function checkFormValidity() {
                        let allValid = true;
                        inputs.forEach(input => {
                            if (!validateField(input)) allValid = false;
                        });
                        button.disabled = !allValid;
                        button.style.cursor = allValid ? "" : "not-allowed";
                    }

                    inputs.forEach(input => {
                        input.addEventListener('input', function () {
                            this.dataset.touched = 'true';
                            updateBorder(this);
                            checkFormValidity();
                        });
                        input.addEventListener('blur', function () {
                            this.dataset.touched = 'true';
                            updateBorder(this);
                        });
                    });

                    form.addEventListener('submit', async function (e) {
                        e.preventDefault();

                        if (button.disabled) return;

                        button.disabled = true;
                        button.textContent = '<?php echo esc_js(__('Sending...', 'parkers-pharma')); ?>';
                        responseDiv.style.display = 'none';

                        const formData = new FormData(form);
                        formData.append('action', 'parkers_contact_form');
                        formData.append('nonce', '<?php echo wp_create_nonce("parkers_contact_form_nonce"); ?>');

                        try {
                            const response = await fetch('<?php echo admin_url("admin-ajax.php"); ?>', {
                                method: 'POST',
                                body: formData,
                                credentials: 'same-origin'
                            });

                            console.log('Response status:', response.status);
                            const result = await response.json();
                            console.log('Response data:', result);

                            responseDiv.style.display = 'block';

                            if (result.success) {
                                responseDiv.innerHTML = '<p style="color: green; font-weight: 600;">' + result.data.message + '</p>';
                                form.reset();
                                button.disabled = true;
                                button.style.cursor = "not-allowed";
                            } else {
                                responseDiv.innerHTML = '<p style="color: red; font-weight: 600;">' + (result.data?.message || '<?php echo esc_js(__('An error occurred.', 'parkers-pharma')); ?>') + '</p>';
                            }
                        } catch (error) {
                            console.error('Fetch error:', error);
                            responseDiv.style.display = 'block';
                            responseDiv.innerHTML = '<p style="color: red; font-weight: 600;"><?php echo esc_js(__('Network error. Please try again.', 'parkers-pharma')); ?></p>';
                        } finally {
                            button.textContent = '<?php echo esc_js(__('Send Now', 'parkers-pharma')); ?>';
                            checkFormValidity();
                        }
                    });
                })();
            </script>
        </div>
    </div>
</section>