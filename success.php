<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>WIW - Package Form</title>
<?php
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_your_secret_key_here');

try {
    // Retrieve the session ID
    $session_id = $_GET['session_id'] ?? null;
    
    if (!$session_id) {
        throw new Exception("No session ID provided");
    }

    // Retrieve the Stripe session
    $session = \Stripe\Checkout\Session::retrieve($session_id);
    
    // Get the package name from metadata
    $packageName = $session->metadata->package_name ?? 'Unknown Package';
    
    // Generate a simple order ID
    $order_id = 'ORD-' . substr(md5(uniqid()), 0, 8);
    
    // Get the amount paid
    $amount = $session->amount_total ? ($session->amount_total / 100) : 0;
    $currency = strtoupper($session->currency);
    
} catch (Exception $e) {
    // Handle errors gracefully
    $error = $e->getMessage();
}
?>
<!-- Fav Icon -->
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
<style>
.contact-section {
    background-color: #1a1a1a;
    color: #e0e0e0;
}

.form-inner {
    background-color: #2d2d2d;
    border-radius: 8px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.form-inner h2 {
    color: #ffffff;
    margin-bottom: 20px;
    font-size: 24px;
    border-bottom: 1px solid #444;
    padding-bottom: 10px;
}

.form-control {
    background-color: #333;
    border: 1px solid #444;
    color: #e0e0e0;
    padding: 12px 15px;
    margin-bottom: 15px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.form-control:focus {
    background-color: #3a3a3a;
    border-color: #555;
    color: #fff;
    box-shadow: 0 0 0 0.2rem rgba(90, 90, 90, 0.25);
}

.form-label label {
    color: #bbb;
    margin-bottom: 8px;
    display: block;
}

.checkbox-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 10px;
    margin-top: 10px;
}

.form-check {
    margin-bottom: 8px;
}

.form-check-input {
    background-color: #333;
    border: 1px solid #555;
}

.form-check-label {
    color: #ccc;
    margin-left: 5px;
}

.radio-group {
    margin: 15px 0;
}

.theme-btn {
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 20px;
}

.theme-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(74, 107, 255, 0.3);
}

/* File input styling */
input[type="file"] {
    color: #bbb;
}

input[type="file"]::file-selector-button {
    background-color: #444;
    color: #e0e0e0;
    border: 1px solid #555;
    padding: 8px 12px;
    border-radius: 4px;
    margin-right: 10px;
    cursor: pointer;
}

/* Placeholder text color */
::placeholder {
    color: #888 !important;
    opacity: 1;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .checkbox-grid {
        grid-template-columns: 1fr;
    }
    
    .form-inner {
        padding: 20px;
    }
}
</style>
</head>


<!-- page wrapper -->
<body>

    <div class="boxed_wrapper">

    <?php include "header.php" ?>
    

        <!-- page-title -->
        <section class="page-title">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url(assets/images/shape/shape-54.webp);"></div>
                <div class="pattern-2" style="background-image: url(assets/images/shape/shape-55.webp);"></div>
                <div class="pattern-3" style="background-image: url(assets/images/shape/shape-43.webp);"></div>
                <div class="pattern-4" style="background-image: url(assets/images/shape/shape-4.webp);"></div>
                <div class="pattern-5" style="background-image: url(assets/images/shape/shape-56.webp);"></div>
                <div class="pattern-6" style="background-image: url(assets/images/shape/shape-57.webp);"></div>
                <div class="pattern-7 rotate-me" style="background-image: url(assets/images/shape/shape-58.webp);"></div>
                <div class="pattern-8" style="background-image: url(assets/images/shape/shape-50.webp);"></div>
            </div>
            <div class="auto-container">
                <div class="inner-box">
                    <div class="content-box">
                    <?php
                        // Capture package name, order ID, and price from the URL query parameters
                        $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;
                        $planName = isset($_GET['planName']) ? $_GET['planName'] : null;
                        $price = isset($_GET['price']) ? $_GET['price'] : null;

                        // If order ID, plan name, or price is missing, show an error
                        if (!$order_id || !$planName || !$price) {
                            echo "<h1>Error: Invalid order or package.</h1>";
                            exit;
                        }

                        // Display the success message with the plan name and price
                        echo "<h1> Thank you for Your Purchase!</h1>";
                        echo "<h1>You selected the <strong>" . htmlspecialchars($planName) . "</strong> package.</h1>";
                        echo "<h1>Amount:" . htmlspecialchars($price) . "</h1>";
                        ?>
                        
                        <ul class="bread-crumb">
                            <li><a href="index.html">Home</a></li>
                            <li>Price Table</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- page-title end -->

        <section class="contact-section pt_120 pb_120 ">
            <div class="auto-container">
                <div class="form-inner">
                    <form action="pack_formsub.php" method="POST" enctype="multipart/form-data" class=" form-grid">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <input type="hidden" name="package" value="<?php echo $planName; ?>">
                        
                        <!-- Specific fields for each package -->
                        <?php if ($planName == 'Logo Design'): ?>
                            
                            <div class="form-group">
                            <h2>Enter  YOUR Information*</h2>

                            <input type="text" id="name" name="name" placeholder="Name" rows="5" class="form-control" required></input>

                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" required></input>
                                <h2>Enter LOGO Information*</h2>

                                <input id="logo-description" name="logo-description" rows="5" placeholder="Logo Name" class="form-control" required></input>
                                
                                <input id="logo-description" name="logo-description" rows="5" placeholder="Slogan or Tagline" class="form-control" required></input>

                                <input type="file" id="reference" name="reference" class="form-control">

                                <textarea id="additional_info" name="additional_info" rows="5"  placeholder="Additional Information" class="form-control"></textarea>

                                <h2>Design/Style </br> Preferences</h2>
                                    <div class="radio-group">
                                        <div class="form-check">
                                            <input type="radio" id="word-mark" name="website-description" value="Word" class="form-check-input">
                                            <label for="word-mark" class="form-check-label">Word Mark</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="pictorial-mark" name="website-description" value="Pictorial" class="form-check-input">
                                            <label for="pictorial-mark" class="form-check-label">Pictorial Mark</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="abstract-mark" name="website-description" value="Abstract" class="form-check-input">
                                            <label for="abstract-mark" class="form-check-label">Abstract Mark</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="letter-form" name="website-description" value="Letter Form" class="form-check-input">
                                            <label for="letter-form" class="form-check-label">Letter Form</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="emblem" name="website-description" value="Emblem" class="form-check-input">
                                            <label for="emblem" class="form-check-label">Emblem</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="mascot" name="website-description" value="Mascot" class="form-check-input">
                                            <label for="mascot" class="form-check-label">Mascot</label>
                                        </div>
                                        </div>
                                </br>
                                        <div class="form-check">
                                                <input type="checkbox" id="informational" name="website-description[]" value="Informational" class="form-check-input">
                                                <label for="informational" class="form-check-label"> I agree to the Terms and Conditions and Privacy Policy</label>
                                        </div>
                                        <button type="submit" class="theme-btn ">Submit Now!</button>

                                    </div>    

                        <?php endif; ?>

                        <?php if ($planName == 'Ecommerce Website' || $planName == 'Web Design'): ?>
                            <div class="form-group">
                            <h2>Enter Your  Information*</h2>
                            <input type="text" id="name" name="name" placeholder="Name" rows="5" class="form-control" required></input>

                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" required></input>

                            <h2>Enter  Web Design Information*</h2>

                                <div class="form-grid">

                                <input id="website-description" name="website-description" class="form-control" placeholder="What does your company do?">

                                <input id="website-description" name="website-description" class="form-control" placeholder="Who are your major competitors?">

                                <input type="file" id="reference" name="reference" placeholder="Reference" class="form-control">

                                    <!-- Industry Dropdown -->
                                    <div class="form-label">
                                        
                                        <label for="website-description">Industry *:</label>
                                    </div>
                                    <div class="form-row">
                                    <div class="form-input">
                                        <select id="website-description" name="website-description" class="form-control" required>
                                        <option value="">Select Industry</option>
                                        <option>Architectural</option>
                                        <option>Art</option>
                                        <option>Automotive</option>
                                        <option>Catalogues</option>
                                        <option>Children</option>
                                        <option>Communication</option>
                                        <option>Construction</option>
                                        <option>Consultation</option>
                                        <option>Craft</option>
                                        <option>Education</option>
                                        <option>Engineering</option>
                                        <option>Entertainment</option>
                                        <option>Environmental</option>
                                        <option>Fashion</option>
                                        <option>Financial</option>
                                        <option>Food</option>
                                        <option>Health</option>
                                        <option>Human resource</option>
                                        <option>Insurance</option>
                                        <option>Matrimony</option>
                                        <option>Medical</option>
                                        <option>Music</option>
                                        <option>Navigation</option>
                                        <option>News</option>
                                        <option>Religious</option>
                                        <option>Social</option>
                                        <option>Spa</option>
                                        <option>Sports</option>
                                        <option>Technology</option>
                                        <option>Travel</option>
                                        <option>Other</option>
                                        </select>
                                    </div>
                                    </div>
                                    <br/> <br/>
                                    <!-- Purpose of Website (Checkboxes) -->
                                    <div class="form-row">
                                        <div class="form-label">
                                            <label for="website-description">What is the purpose of your website? Select all that apply:</label>
                                        </div>
                                        <div class="form-input checkbox-grid">
                                            <div class="form-check">
                                            <input type="checkbox" id="informational" name="website-description[]" value="Informational" class="form-check-input">
                                            <label for="informational" class="form-check-label">Informational</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="promote-service" name="website-description[]" value="Promote Service" class="form-check-input">
                                            <label for="promote-service" class="form-check-label">Promote Service</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="promote-products" name="website-description[]" value="Promote Products" class="form-check-input">
                                            <label for="promote-products" class="form-check-label">Promote Products</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="downloadable-info" name="website-description[]" value="Downloadable Info" class="form-check-input">
                                            <label for="downloadable-info" class="form-check-label">Downloadable Info</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="sell-service" name="website-description[]" value="Sell Service" class="form-check-input">
                                            <label for="sell-service" class="form-check-label">Sell Service</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="sell-products" name="website-description[]" value="Sell Products" class="form-check-input">
                                            <label for="sell-products" class="form-check-label">Sell Products</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="showcase" name="website-description[]" value="Showcase" class="form-check-input">
                                                <label for="showcase" class="form-check-label">Showcase</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="advertisement" name="website-description[]" value="Advertisement" class="form-check-input">
                                            <label for="advertisement" class="form-check-label">Advertisement</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="e-commerce" name="website-description[]" value="E-Commerce" class="form-check-input">
                                            <label for="e-commerce" class="form-check-label">E-Commerce</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="branding-awareness" name="website-description[]" value="Branding/Awareness" class="form-check-input">
                                            <label for="branding-awareness" class="form-check-label">Branding/Awareness</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="community-service" name="website-description[]" value="Community Service" class="form-check-input">
                                            <label for="community-service" class="form-check-label">Community Service</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="enhance-image" name="website-description[]" value="Enhance Image" class="form-check-input">
                                            <label for="enhance-image" class="form-check-label">Enhance Image</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="edge-on-competition" name="website-description[]" value="Edge On Competition" class="form-check-input">
                                            <label for="edge-on-competition" class="form-check-label">Edge On Competition</label>
                                            </div>
                                            <div class="form-check">
                                            <input type="checkbox" id="generate-leads" name="website-description[]" value="Generate Leads" class="form-check-input">
                                            <label for="generate-leads" class="form-check-label">Generate Leads</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="promote-idea" name="website-description[]" value="Promote An Idea" class="form-check-input">
                                                <label for="promote-idea" class="form-check-label">Promote An Idea</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="other" name="website-description[]" value="Other" class="form-check-input">
                                                <label for="other" class="form-check-label">Other</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Competitors -->
                                    <div class="form-row">
                                        <div class="form-input">
                                        </div>
                                    </div>

                                    <!-- Website Image (Checkboxes) -->
                                    <div class="form-row">
                                        <div class="form-label">
                                            <label for="website-description">Describe the Image your website must communicate? Select all that apply:</label>
                                        </div>
                                        <div class="form-input checkbox-grid">
                                            <div class="form-check">
                                                <input type="checkbox" id="Cutting Edge" name="website-description[]" value="Cutting Edge" class="form-check-input">
                                                <label for="Cutting Edge" class="form-check-label">Cutting Edge</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Traditional" name="website-description[]" value="Traditional" class="form-check-input">
                                                <label for="Traditional" class="form-check-label">Traditional</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Modern" name="website-description[]" value="Modern" class="form-check-input">
                                                <label for="Modern" class="form-check-label">Modern</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Flashy" name="website-description[]" value="Flashy" class="form-check-input">
                                                <label for="Flashy" class="form-check-label">Flashy</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Glamorous" name="website-description[]" value="Glamorous" class="form-check-input">
                                                <label for="Glamorous" class="form-check-label">Glamorous</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="HightTech" name="website-description[]" value="HighTech" class="form-check-input">
                                                <label for="HightTech" class="form-check-label">HighTech</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Futuristic" name="website-description[]" value="Futuristic" class="form-check-input">
                                                <label for="Futuristic" class="form-check-label">Futuristic</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Corporate" name="website-description[]" value="Corporate" class="form-check-input">
                                                <label for="Corporate" class="form-check-label">Corporate</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Feminine" name="website-description[]" value="Feminine" class="form-check-input">
                                                <label for="Feminine" class="form-check-label">Feminine</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Content Driven" name="website-description[]" value="Content Driven" class="form-check-input">
                                                <label for="Content Driven" class="form-check-label">Content Driven</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Conservative" name="website-description[]" value="Conservative" class="form-check-input">
                                                <label for="Conservative" class="form-check-label">Conservative</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="community-service" name="website-description[]" value="Community Service" class="form-check-input">
                                                <label for="community-service" class="form-check-label">Community Service</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Friendly For Children" name="website-description[]" value="Friendly For Children" class="form-check-input">
                                                <label for="Friendly For Children" class="form-check-label">Friendly For Children</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Friendly For Children" name="website-description[]" value="Family Oriented" class="form-check-input">
                                                <label for="Friendly For Children" class="form-check-label">Friendly For Children</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="International" name="website-description[]" value="International" class="form-check-input">
                                                <label for="International" class="form-check-label">International</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Exciting" name="website-description[]" value="Exciting" class="form-check-input">
                                                <label for="Exciting" class="form-check-label">Exciting</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Simple Clean" name="website-description[]" value="Simple Clean" class="form-check-input">
                                                <label for="Simple Clean" class="form-check-label">Simple Clean</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Industrial" name="website-description[]" value="Industrial" class="form-check-input">
                                                <label for="Industrial" class="form-check-label">Industrial</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Inspirational" name="website-description[]" value="Inspirational" class="form-check-input">
                                                <label for="Inspirational" class="form-check-label">Inspirational</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Colorful" name="website-description[]" value="Colorful" class="form-check-input">
                                                <label for="Colorful" class="form-check-label">Colorful</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Humorous" name="website-description[]" value="Humorous" class="form-check-input">
                                                <label for="Humorous" class="form-check-label">Humorous</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Soft" name="website-description[]" value="Soft" class="form-check-input">
                                                <label for="Soft" class="form-check-label">Soft</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Elegant" name="website-description[]" value="Elegant" class="form-check-input">
                                                <label for="Elegant" class="form-check-label">Elegant</label>
                                            </div>                                
                                            <div class="form-check">
                                                <input type="checkbox" id="Nature" name="website-description[]" value="Nature" class="form-check-input">
                                                <label for="Nature" class="form-check-label">Nature</label>
                                            </div>                                
                                            <div class="form-check">
                                                <input type="checkbox" id="Complex" name="website-description[]" value="Complex" class="form-check-input">
                                                <label for="Complex" class="form-check-label">Complex</label>
                                            </div>                                
                                            <div class="form-check">
                                                <input type="checkbox" id="Progressive" name="website-description[]" value="Progressive" class="form-check-input">
                                                <label for="Progressive" class="form-check-label">Progressive</label>
                                            </div>                                
                                            <div class="form-check">
                                                <input type="checkbox" id="Service Oriented" name="website-description[]" value="Service Oriented" class="form-check-input">
                                                <label for="Service Oriented" class="form-check-label">Service Oriented</label>
                                            </div>                            

                                            <div class="form-check">
                                                <input type="checkbox" id="other-1" name="website-description[]" value="other-1" class="form-check-input">
                                                <label for="other-1" class="form-check-label">Other</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-label">
                                            <label for="website-description">Select which pages do you want in your website :</label>
                                        </div>
                                        <div class="form-input checkbox-grid">
                                        <div class="form-check">
                                        <input type="checkbox" id="Home" name="website-description[]" value="Home" class="form-check-input">
                                        <label for="Home" class="form-check-label">Home</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="About Us / About" name="website-description[]" value=" About Us / About" class="form-check-input">
                                            <label for="About Us / About" class="form-check-label"> About Us / About</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="Our Services / Services" name="website-description[]" value="Our Services / Services" class="form-check-input">
                                            <label for="Our Services / Services" class="form-check-label">Our Services / Services</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="Our Products / Products" name="website-description[]" value="Our Products / Products" class="form-check-input">
                                            <label for="Our Products / Products" class="form-check-label">Our Products / Products</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="FAQ's" name="website-description[]" value="FAQ's" class="form-check-input">
                                            <label for="FAQ's" class="form-check-label">FAQ's</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="Contact Us" name="website-description[]" value="Contact Us / Contact" class="form-check-input">
                                            <label for="Contact Us" class="form-check-label">Contact Us / Contact</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="Portfolio" name="website-description[]" value="Portfolio / Showcase" class="form-check-input">
                                            <label for="Portfolio" class="form-check-label">Portfolio / Showcase</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="customer-service" name="website-description[]" value="Customer Service" class="form-check-input">
                                            <label for="customer-service" class="form-check-label">Customer Service</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="Newsletter SignUp" name="website-description[]" value="Newsletter SignUp" class="form-check-input">
                                            <label for="Newsletter SignUp" class="form-check-label">Newsletter SignUp</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="Employment Facility" name="website-description[]" value="Employment Facility" class="form-check-input">
                                            <label for="Employment Facility" class="form-check-label">Employment Facility</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="Information Careers" name="website-description[]" value="Information Careers" class="form-check-input">
                                            <label for="Information Careers" class="form-check-label">Information Careers</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="Online Registration" name="website-description[]" value="Online Registration" class="form-check-input">
                                            <label for="Online Registration" class="form-check-label">Online Registration</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="Press Release" name="website-description[]" value="Press Release" class="form-check-input">
                                            <label for="Press Release" class="form-check-label">Press Release</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="Testimonials" name="website-description[]" value="Testimonials" class="form-check-input">
                                            <label for="Testimonials" class="form-check-label">Testimonials</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="Management Bios" name="website-description[]" value="Management Bios" class="form-check-input">
                                            <label for="Management Bios" class="form-check-label">Management Bios</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="promote-idea" name="website-description[]" value="Quote Request" class="form-check-input">
                                            <label for="promote-idea" class="form-check-label">Quote Request</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="promote-idea" name="website-description[]" value="Pricing" class="form-check-input">
                                            <label for="promote-idea" class="form-check-label">Pricing</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="promote-idea" name="website-description[]" value="Direction" class="form-check-input">
                                            <label for="promote-idea" class="form-check-label">Direction</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" id="promote-idea" name="website-description[]" value="Dealer Information" class="form-check-input">
                                            <label for="promote-idea" class="form-check-label">Dealer Information</label>
                                        </div>
                                        
                                        <div class="form-check">
                                            <input type="checkbox" id="other-2" name="website-description[]" value="Other-2" class="form-check-input">
                                            <label for="other-2" class="form-check-label">Other</label>
                                        </div>
                                
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="form-label">
                                            <label for="website-description">Select Any :</label>
                                        </div>                                    
                                        <div class="radio-group">

                                                <div class="form-check">

                                                <input type="radio" id="own-photos" name="website-description" value="own Photos" class="form-check-input">
                                                <label for="own-photos" class="form-check-label">I would like to use my own photos</label>

                                                </div>

                                                <div class="form-check">
                                                <input type="radio" id="stock-photos" name="website-description" value="Stock Photos" class="form-check-input">

                                                <label for="stock-photos" class="form-check-label">I would like to use stock photos</label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                        <!-- Purpose of Website (Checkboxes) -->
                                        <div class="form-row">
                                            <div class="form-label">
                                                <label for="website-description">Select a font style :</label>
                                            </div>
                                            <div class="form-input checkbox-grid">
                                            <div class="form-check">
                                                <input type="checkbox" id="Arial" name="website-description[]" value="Arial" class="form-check-input">
                                                <label for="Arial" class="form-check-label">Arial</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Verdana" name="website-description[]" value="Verdana" class="form-check-input">
                                                <label for="Verdana" class="form-check-label">Verdana</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="TrebuchetMS" name="website-description[]" value="TrebuchetMS" class="form-check-input">
                                                <label for="TrebuchetMS" class="form-check-label">TrebuchetMS</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="TimesNewRoman" name="website-description[]" value="TimesNewRoman" class="form-check-input">
                                                <label for="TimesNewRoman" class="form-check-label">TimesNewRoman</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="CenturyGothic" name="website-description[]" value="CenturyGothic" class="form-check-input">
                                                <label for="CenturyGothic" class="form-check-label">CenturyGothic</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Georgia" name="website-description[]" value="Georgia" class="form-check-input">
                                                <label for="Georgia" class="form-check-label">Georgia</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Roboto" name="website-description[]" value="Roboto" class="form-check-input">
                                                <label for="Roboto" class="form-check-label">Roboto</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="Lato" name="website-description[]" value="Lato" class="form-check-input">
                                                <label for="Lato" class="form-check-label">Lato</label>
                                            </div>
                                            
                                            <div class="form-check">
                                                <input type="checkbox" id="other" name="website-description[]" value="Other" class="form-check-input">
                                                <label for="other" class="form-check-label">Other</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="other-3" name="website-description[]" value="Other-3" class="form-check-input">
                                                <label for="other-3" class="form-check-label">Other</label>
                                            </div>
                                            </div>
                                        </div> 
                                        
                                            <!-- Purpose of Website (Checkboxes) -->
                                            <div class="form-row">
                                                <div class="form-label">
                                                    <label for="website-description">Features required on home page :</label>
                                                </div>
                                                <div class="form-input checkbox-grid">
                                                <div class="form-check">
                                                    <input type="checkbox" id="StaticBanner" name="website-description[]" value="StaticBanner" class="form-check-input">
                                                    <label for="StaticBanner" class="form-check-label">StaticBanner</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="WelcomeText" name="website-description[]" value="WelcomeText" class="form-check-input">
                                                    <label for="WelcomeText" class="form-check-label">WelcomeText</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="ListOfProducts" name="website-description[]" value="ListOfProducts" class="form-check-input">
                                                    <label for="ListOfProducts" class="form-check-label">ListOfProducts</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="ListOfServices" name="website-description[]" value="ListOfServices" class="form-check-input">
                                                    <label for="ListOfServices" class="form-check-label">ListOfServices</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="Testimonial" name="website-description[]" value="Testimonial" class="form-check-input">
                                                    <label for="Testimonial" class="form-check-label">Testimonial</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="AffiliatesLogos" name="website-description[]" value="AffiliatesLogos" class="form-check-input">
                                                    <label for="AffiliatesLogos" class="form-check-label">AffiliatesLogos</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="News" name="website-description[]" value="News" class="form-check-input">
                                                    <label for="News" class="form-check-label">News</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="IndividualsProfile" name="website-description[]" value="IndividualsProfile" class="form-check-input">
                                                    <label for="IndividualsProfile" class="form-check-label">IndividualsProfile</label>
                                                </div>
                                                
                                                <div class="form-check">
                                                    <input type="checkbox" id="Blog" name="website-description[]" value="Blog" class="form-check-input">
                                                    <label for="Blog" class="form-check-label">Blog</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="Gallery" name="website-description[]" value="Gallery" class="form-check-input">
                                                    <label for="Gallery" class="form-check-label">Gallery</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="other-4" name="website-description[]" value="other-4" class="form-check-input">
                                                    <label for="other-4" class="form-check-label">Other</label>
                                                </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                        <div class="form-label">
                                            <label for="website-description">Select Payment Option :</label>
                                        </div>                                    
                                        <div class="radio-group">

                                                <div class="form-check">
                                                <input type="radio" id="Paypal" name="website-description" value="Paypal" class="form-check-input">
                                                <label for="Paypal" class="form-check-label"> By Paypal</label>

                                                </div>

                                                <div class="form-check">
                                                <input type="radio" id="Credit Card" name="website-description" value="Credit" class="form-check-input">
                                                <label for="Credit Card" class="form-check-label">By Credit Card</label>

                                                </div>
                                                <button type="" class="theme-btn">Submit Now!</button>

                                            </div>
                                        </div>
                                    </div>
            
                            </div>
                            
                        <?php endif; ?>

                        <?php if ($planName == 'seo'): ?>
                            <div class="form-group">
                            <h2>Enter Your Information* </h2>
                            <input type="text" id="name" name="name" placeholder="Name" rows="5" class="form-control" required></input>

                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" required></input>
                            
                            <h2>Enter SEO Information*</h2>


                            <input id="website-description" name="international" placeholder="Have you done SEO before? If yes, what worked or didn’t work?" rows="5" class="form-control" ></input>
                            <input id="website-description" name="Location" placeholder="Do you have specific keywords in mind, or should we research them for you?" rows="5" class="form-control" required></input>
                            <div class="radio-group">
                            <div class="form-label">
                            <label for="website-description">How do you prefer to receive reports and updates? (Email, WhatsApp, etc.)</label>
                            </div>
                                    <div class="form-check">
                                        <input type="radio" id="yes" name="website-description" value="Yes" class="form-check-input">
                                        <label for="yes" class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="No" name="website-description" value="No" class="form-check-input">
                                        <label for="no" class="form-check-label">No</label>
                                    </div>
                                <textarea id="website-description" placeholder="What is your website URL and business niche?" name="Website URL" rows="5" class="form-control" required></textarea>
                                <textarea id="website-description" placeholder="What are your main SEO goals? (More traffic, leads, sales, or brand awareness?)" name="goals" rows="5" class="form-control" required></textarea>

                                <button type="" class="theme-btn form_pack_btn btn ">Submit Now!</button>

                            </div>
                        <?php endif; ?>

                        <?php if ($planName == 'Web Content'): ?>
                            <div class="form-group">
                            <h2>Enter Yours Information*</h2>
                            <input type="text" id="name" name="name" placeholder="Name" rows="5" class="form-control" required></input>

                            <input type="email" id="email" name="email" placeholder="Email" class="form-control" required></input>
                            <h2>Enter Web Content Information*</h2>


                            <textarea id="website-description" placeholder="What is the topic or niche of your content?" name="content" rows="5" class="form-control" required></textarea>

                            <textarea id="website-description" placeholder="What is the target audience for your content?" name="target" rows="5" class="form-control" required></textarea>

                            <textarea id="website-description" name="guidelines" rows="5" class="form-control" placeholder="Do you have specific keywords or SEO guidelines to follow?" required></textarea>
                            <textarea id="website-description" name="technical" placeholder="What is your preferred tone and style? (Formal, conversational, technical, etc.)" rows="5" class="form-control" required></textarea>
                            
                            <textarea id="website-description" placeholder="Do you need any specific formatting or references?" name="formatting" rows="5" class="form-control" required></textarea>
                        
                                <button type="" class="theme-btn form_pack_btn ">Submit Now!</button>

                            </div>
                        <?php endif; ?>
                        <!-- Common Fields -->

                    </form>
                </div>
            </div>
        </section>

        <?php include "footer.php" ?>
        
    </div>


</body>
</html>
