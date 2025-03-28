            <!-- main-footer -->
            <footer class="main-footer">
            <div class="widget-section">
                <div class="pattern-layer">
                    <div class="pattern-1" style="background-image: url(assets/images/shape/shape-21.webp);"></div>
                    <div class="pattern-2" style="background-image: url(assets/images/shape/shape-22.webp);"></div>
                    <div class="pattern-3" style="background-image: url(assets/images/shape/shape-23.webp);"></div>
                    <div class="pattern-4 float-bob-x" style="background-image: url(assets/images/shape/shape-24.webp);"></div>
                    <div class="pattern-5 float-bob-y" style="background-image: url(assets/images/shape/shape-25.webp);"></div>
                </div>
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget logo-widget">
                                <figure class="footer-logo"><a href="index.html"><img src="assets/images/WIW-1.webp" alt=""></a></figure>
                                <p>Website in Week delivers fast, high-quality web design, development, and digital marketing solutions. Elevate your online presence with our expert services.</p>
                                <h3><a href="mailto:support@websiteinweek.com">support@websiteinweek.com</a></h3>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h3>Top Links</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list clearfix">
                                        <li><a href="about.php">About Us</a></li>
                                        <li><a href="contact.php">Contact Us</a></li>
                                        <li><a href="pricing.php">Pricing</a></li>
                                        <li><a href="portfolio.php">Portfolio</a></li>
                                        <li><a href="faq.php">FAQs</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget links-widget">
                                <div class="widget-title">
                                    <h3>Services</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list clearfix">
                                        <li><a href="service-details.php#digital_marketing">Digital Marketing Services</a></li>
                                        <li><a href="service-details.php#website_development">Website Development</a></li>
                                        <li><a href="service-details.php#graphic_design">Graphic Design</a></li>
                                        <li><a href="service-details.php#search">Search Engine Optimization</a></li>
                                        <li><a href="service-details.php#animation">3D/ 2D Animation</a></li>
                                        <li><a href="service-details.php#mobile_app_development">Mobile App Development</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget subscribe-widget">
                                <div class="widget-title">
                                    <h3>Subscribe</h3>
                                </div>
                                <div class="widget-content">
                                    <p>Subscribe for exclusive updates and insights straight to your inbox!</p>
                                    <form method="post" action="contact.html">
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="infoflex@info.com" required>
                                            <button type="submit"><img src="assets/images/icons/icon-22.webp" alt=""></button>
                                        </div>
                                    </form>
                                    <ul class="footer-menu">
                                        <li><a href="terms_condition.php">Terms & Conditions</a></li>
                                        <li><a href="privacy_policy.php">Privacy Policy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="bottom-inner">
                        <p>&copy; Copyright <?php echo date('Y'); ?> <a href="index.php">Website In Week</a> - All Rights Reserved.</p>
                        <ul class="social-links">
                            <li><a href="index.html"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="index.html"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="index.html"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="index.html"><i class="fab fa-pinterest-p"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- main-footer end -->



        <!--Scroll to top-->
        <div class="scroll-to-top">
            <div>
                <div class="scroll-top-inner">
                    <div class="scroll-bar">
                        <div class="bar-inner"></div>
                    </div>
                    <div class="scroll-bar-text">Go To Top</div>
                </div>
            </div>
        </div>
        <!-- Scroll to top end -->
    
<!-- jQuery plugins (must come after jQuery) -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/owl.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/jquery.fancybox.js"></script>
<script src="assets/js/appear.js"></script>
<script src="assets/js/isotope.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/nav-tool.js"></script>
<script src="assets/js/jquery.lettering.min.js"></script>
<script src="assets/js/jquery.circleType.js"></script>

<!-- Main JS -->
<script src="assets/js/script.js"></script>

<!-- Initialize all scripts -->
<script>
$(document).ready(function() {
    // Accordion functionality
    $('.accordion .acc-btn').click(function() {
        // Close all other accordion items
        $('.accordion .acc-btn').not(this).removeClass('active');
        $('.accordion .acc-content').not($(this).next()).slideUp(300).removeClass('current');
        
        // Toggle current item
        $(this).toggleClass('active');
        $(this).next('.acc-content').slideToggle(300).toggleClass('current');
    });
    
    // Initialize - open the first item if it has active-block class
    if ($('.accordion.block.active-block').length) {
        $('.accordion.block.active-block .acc-btn').addClass('active');
        $('.accordion.block.active-block .acc-content').addClass('current').show();
    }

    // Initialize other plugins
    if(typeof $.fn.owlCarousel === 'function') {
        $('.owl-carousel').owlCarousel();
    }
    if(typeof $.fn.fancybox === 'function') {
        $('[data-fancybox]').fancybox();
    }
    if(typeof WOW === 'function') {
        new WOW().init();
    }
    if(typeof $.fn.niceSelect === 'function') {
        $('select').niceSelect();
    }
    // Add other plugin initializations as needed
});
</script>