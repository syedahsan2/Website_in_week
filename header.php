<!-- Fav Icon -->
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Tenor+Sans&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Core CSS Files -->
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/font-awesome-all.css" rel="stylesheet">
<link href="assets/css/flaticon.css" rel="stylesheet">

<!-- Plugins CSS -->
<link href="assets/css/owl.css" rel="stylesheet">
<link href="assets/css/jquery.fancybox.min.css" rel="stylesheet">
<link href="assets/css/animate.css" rel="stylesheet">
<link href="assets/css/aos.css" rel="stylesheet">
<link href="assets/css/nice-select.css" rel="stylesheet">

<!-- Theme CSS -->
<link href="assets/css/elpath.css" rel="stylesheet">
<link href="assets/css/color.css" id="jssDefault" rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">

<!-- Module CSS -->
<link href="assets/css/module-css/page-title.css" rel="stylesheet">
<link href="assets/css/module-css/contact.css" rel="stylesheet">
<link href="assets/css/module-css/funfact.css" rel="stylesheet">
<link href="assets/css/module-css/team.css" rel="stylesheet">
<link href="assets/css/module-css/banner.css" rel="stylesheet">
<link href="assets/css/module-css/about.css" rel="stylesheet">
<link href="assets/css/module-css/service.css" rel="stylesheet">
<link href="assets/css/module-css/chooseus.css" rel="stylesheet">
<link href="assets/css/module-css/gallery.css" rel="stylesheet">
<link href="assets/css/module-css/testimonial.css" rel="stylesheet">
<link href="assets/css/module-css/clients.css" rel="stylesheet">
<link href="assets/css/module-css/video.css" rel="stylesheet">
<link href="assets/css/module-css/working.css" rel="stylesheet">
<link href="assets/css/module-css/cta.css" rel="stylesheet">
<link href="assets/css/module-css/news.css" rel="stylesheet">
<link href="assets/css/module-css/pricing.css" rel="stylesheet">
<link href="assets/css/module-css/faq.css" rel="stylesheet">

<!-- Responsive CSS -->
<link href="assets/css/responsive.css" rel="stylesheet">

<!-- Load jQuery FIRST in head -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stripe = Stripe('pk_test_your_publishable_key_here'); // Replace with your key
    
    // Handle all "Get Started" buttons
    document.querySelectorAll('.stripe-link').forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();
            
            // Get package details from data attributes
            const priceId = button.dataset.price;
            const packageName = button.dataset.name;
            const buttonText = button.innerHTML;
            
            // Show loading state
            button.disabled = true;
            button.innerHTML = '<span>Processing...</span>';
            
            try {
                // Create checkout session
                const response = await fetch('create-checkout-session.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        priceId: priceId,
                        packageName: packageName,
                        successUrl: `${window.location.origin}/success.php?session_id={CHECKOUT_SESSION_ID}`,
                        cancelUrl: window.location.href
                    }),
                });
                
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                const session = await response.json();
                
                // Redirect to Stripe Checkout
                const result = await stripe.redirectToCheckout({
                    sessionId: session.id
                });
                
                if (result.error) {
                    throw result.error;
                }
                
            } catch (error) {
                console.error('Error:', error);
                alert('Payment failed to start. Please try again.');
                
                // Reset button
                button.disabled = false;
                button.innerHTML = buttonText;
            }
        });
    });
});
</script>
        <!-- mouse-pointer -->
        <div class="mouse-pointer" id="mouse-pointer"></div>
        <!-- mouse-pointer end -->


        <!-- preloader -->

        <!-- preloader end -->


        <!--Search Popup-->


        <!-- sidebar cart item -->
        <div class="xs-sidebar-group info-group info-sidebar">
            <div class="xs-overlay xs-bg-black"></div>
            <div class="xs-overlay xs-overlay-2 xs-bg-black"></div>
            <div class="xs-overlay xs-overlay-3 xs-bg-black"></div>
            <div class="xs-overlay xs-overlay-4 xs-bg-black"></div>
            <div class="xs-overlay xs-overlay-5 xs-bg-black"></div>
            <div class="xs-sidebar-widget">
                <div class="sidebar-widget-container">
                    <div class="widget-heading">
                        <a href="#" class="close-side-widget">X</a>
                    </div>
                    <div class="sidebar-textwidget">
                        <div class="sidebar-info-contents">
                            <div class="content-inner">
                                <div class="logo">
                                    <a href="index.php"><img src="assets/images/WIW-2.webp" alt="" /></a>
                                </div>
                                <div class="text">
                                    <h3>We Are Creative Digital Agency.</h3>
                                    <p>​Website in Week delivers responsive, visually stunning websites in seven days, specializing in WordPress, Elementor, WooCommerce, SEO, and digital marketing to enhance your online presence.​
                                    </p>
                                </div>
                                <div class="info-box">
                                    <h3>Conatct Us</h3>
                                    <ul class="info clearfix">
                                        <li><div class="icon"><i class="icon-37"></i></div>54B, Tailstoi Town 5238 MT, La city, IA 522364</li>
                                        <li><div class="icon"><i class="icon-36"></i></div><a href="mailto:contact@example.com">contact@example.com</a></li>
                                        <li><div class="icon"><i class="icon-35"></i></div><a href="tel:18004567890">+1800 456 7890</a></li>
                                    </ul>
                                </div>
                                <div class="subscribe-inner">
                                    <h3>Newsletter Subscription</h3>
                                    <form action="contact.html" method="post">
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Enter Email Address" required="">
                                            <button type="submit" class="theme-btn">subscribe now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END sidebar widget item -->


        <!-- main header -->
        <header class="main-header">
            <!-- header-lower -->
            <div class="header-lower">
                <div class="outer-container">
                    <div class="outer-box">
                        <div class="left-column">
                            <div class="logo-box">
                                <figure class="logo"><a href="index.php"><img src="assets/images/WIW-1.webp" alt=""></a></figure>
                            </div>
                            <div class="menu-area">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler">
                                    <i class="icon-bar"></i>
                                    <i class="icon-bar"></i>
                                    <i class="icon-bar"></i>
                                </div>
                                <nav class="main-menu navbar-expand-md navbar-light clearfix">
                                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                        <ul class="navigation clearfix">
                                            <li><a href="index.php">Home</a>
                                            </li> 
                                            <li><a href="about.php">About Us</a></li> 
                                            <li><a href="service.php">Services</a></li>
                                            <li><a href="pricing.php">Pricing</a></li>  
                                            <li><a href="portfolio.php">Portfolio</a></li>
                                            <li><a href="contact.php">Contact</a></li> 
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                        <div class="menu-right-content">
                            <div class="nav-btn nav-toggler navSidebar-button clearfix"><img src="assets/images/icons/icon-1.webp" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>

            <!--sticky Header-->
            <div class="sticky-header">
                <div class="auto-container">
                    <div class="outer-box">
                        <div class="logo-box">
                            <figure class="logo"><a href="index.php"><img src="assets/images/WIW-1.webp" alt=""></a></figure>
                        </div>
                        <div class="menu-area">
                            <nav class="main-menu clearfix">
                                <!--Keep This Empty / Menu will come through Javascript-->
                            </nav>
                        </div>
                        <div class="menu-right-content">
                            <div class="nav-btn nav-toggler navSidebar-button clearfix"><img src="assets/images/icons/icon-1.webp" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- main-header end -->


        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>
            
            <nav class="menu-box">
                <div class="nav-logo"><a href="index.php"><img src="assets/images/WIW-1.webp" alt="" title=""></a></div>
                <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
                <div class="contact-info">
                    <h4>Contact Info</h4>
                    <ul>
                        <li>Chicago 12, Melborne City, USA</li>
                        <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                        <li><a href="mailto:info@example.com">info@example.com</a></li>
                    </ul>
                </div>
                <div class="social-links">
                    <ul class="clearfix">
                        <li><a href="index.html"><span class="fab fa-twitter"></span></a></li>
                        <li><a href="index.html"><span class="fab fa-facebook-square"></span></a></li>
                        <li><a href="index.html"><span class="fab fa-pinterest-p"></span></a></li>
                        <li><a href="index.html"><span class="fab fa-instagram"></span></a></li>
                        <li><a href="index.html"><span class="fab fa-youtube"></span></a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- End Mobile Menu -->