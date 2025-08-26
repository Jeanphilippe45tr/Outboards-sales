</main> <!-- Close main content from header -->

<!-- Footer Section -->
<footer class="main-footer">
    <!-- Footer Top Section -->
    <div class="footer-top">
        <div class="container">
            <div class="footer-columns">
                <!-- Company Info -->
                <div class="footer-column">
                    <div class="footer-logo">
                        <img src="<?php echo SITE_URL; ?>assets/images/icons/logo-white.png"
                            alt="MarinePower Outboards">
                        <span>MarinePower</span>
                    </div>
                    <p>Providing premium outboard motors and marine solutions since 1995. Our expertise ensures you get
                        the perfect motor for your boating needs.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="<?php echo SITE_URL; ?>index.php">Home</a></li>
                        <li><a href="<?php echo SITE_URL; ?>pages/products/">Products</a></li>
                        <li><a href="<?php echo SITE_URL; ?>pages/about.php">About Us</a></li>
                        <li><a href="<?php echo SITE_URL; ?>pages/contact.php">Contact</a></li>
                        <li><a href="<?php echo SITE_URL; ?>pages/faq.php">FAQ</a></li>
                        <li><a href="<?php echo SITE_URL; ?>pages/warranty.php">Warranty</a></li>
                    </ul>
                </div>

                <!-- Product Categories -->
                <div class="footer-column">
                    <h3>Product Categories</h3>
                    <ul>
                        <li><a href="<?php echo SITE_URL; ?>pages/products/category.php?type=2-stroke">2-Stroke
                                Motors</a></li>
                        <li><a href="<?php echo SITE_URL; ?>pages/products/category.php?type=4-stroke">4-Stroke
                                Motors</a></li>
                        <li><a href="<?php echo SITE_URL; ?>pages/products/category.php?type=electric">Electric
                                Motors</a></li>
                        <li><a href="<?php echo SITE_URL; ?>pages/products/category.php?type=portable">Portable
                                Motors</a></li>
                        <li><a href="<?php echo SITE_URL; ?>pages/products/category.php?hp=high">High Horsepower</a>
                        </li>
                        <li><a href="<?php echo SITE_URL; ?>pages/accessories.php">Accessories</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="footer-column">
                    <h3>Contact Information</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>123 Marine Drive, Tampa, FL 33601</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>1-800-MARINE-1 (1-800-627-4631)</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@marinepower.com</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <span>Mon-Fri: 8:00 AM - 6:00 PM<br>Sat: 9:00 AM - 4:00 PM</span>
                        </div>
                    </div>
                </div>

                <!-- Newsletter -->
                <div class="footer-column">
                    <h3>Newsletter</h3>
                    <p>Subscribe to our newsletter for the latest products, promotions, and boating tips.</p>
                    <form class="newsletter-form">
                        <label>
                            <input type="email" placeholder="Your email address" required>
                        </label>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom Section -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <div class="copyright">
                    <p>&copy; <?php echo date('Y'); ?> MarinePower Outboards. All rights reserved.</p>
                </div>
                <div class="footer-bottom-links">
                    <a href="<?php echo SITE_URL; ?>pages/privacy.php">Privacy Policy</a>
                    <a href="<?php echo SITE_URL; ?>pages/terms.php">Terms of Service</a>
                    <a href="<?php echo SITE_URL; ?>pages/sitemap.php">Sitemap</a>
                </div>
                <div class="payment-methods">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-amex"></i>
                    <i class="fab fa-cc-discover"></i>
                    <i class="fab fa-paypal"></i>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="<?php echo SITE_URL; ?>assets/js/main.js"></script>
<?php
// Load page-specific JS if defined
if (isset($page_js)) {
    echo '<script src="' . SITE_URL . 'assets/js/' . $page_js . '"></script>';
}
?>
</body>
</html>