<!-- footer start -->
<footer class="footer top-ftr-space">
    <div class="custom-container">
        <div class="flex-box">
            <div class="footer-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/footer-logo.png" alt="">
            </div>
            <div class="footer-nav">
                <h3 class="ftr-header">Quick Links</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => false,
                    'walker' => new Footer_Menu_Walker(),
                ));
                ?>
            </div>
            <div class="footer-nav">
                <h3 class="ftr-header">Social media</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'social',
                    'container' => false,
                ));
                ?>
            </div>
            <div class="footer-nav">
                <h3 class="ftr-header">Contact Us</h3>
                <ul>
                    <li><span class="icon-box"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/location-icon.png"
                                alt=""></span> <span class="ftr-cntc-info">AGRI-VETA LTD 26 b Marsland Road Manchester
                            M333HQ England</span>
                    </li>
                    <li><a href="#"><span class="icon-box"><img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/call-icon.png"
                                    alt=""></span><span class="ftr-cntc-info">+1 (555) 123-4567</span></a></li>
                    <li><a href="#"><span class="icon-box"><img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/mail-icon.png"
                                    alt=""></span><span class="ftr-cntc-info">info@agri-veta.com</span></a>
                    </li>
                </ul>
            </div>
            <div class="footer-nav">
                <h3 class="ftr-header">Newsletter</h3>
                <div class="subscribe-section">
                    <input type="email" placeholder="Enter email address" class="email-input">
                    <button class="global-solid-button">SUBSCRIBE</button>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <p>Copyright © <?php echo date('Y'); ?> <?php echo get_bloginfo('name'); ?> - All Rights Reserved.</p>
            <ul>
                <li><a href="#">Privacy & Cookie Policy</a></li>
                <li><a href="#">Terms and Conditions</a></li>
            </ul>
        </div>
    </div>
</footer>
<!-- footer end -->
<?php wp_footer(); ?>
</body>

</html>