<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load Composer's autoloader

$response = []; // Initialize response array

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Capture common form data
    $commonFields = [
        'name' => htmlspecialchars(trim($_POST['name'])),
        'email' => htmlspecialchars(trim($_POST['email'])),
        'package' => htmlspecialchars(trim($_POST['package'])),
        'order_id' => htmlspecialchars(trim($_POST['order_id'])),
        'additional_info' => htmlspecialchars(trim($_POST['additional_info'])),
    ];

    // Validate required fields
    if (empty($commonFields['name']) || empty($commonFields['email']) || empty($commonFields['package']) || empty($commonFields['order_id'])) {
        $response['code'] = false;
        $response['err'] = 'All fields are required.';
        echo json_encode($response);
        exit;
    }

    // Initialize an array to hold additional fields based on package
    $additionalFields = [];

    // Capture additional fields based on the selected package
    if ($commonFields['package'] == 'logo design') {
        $additionalFields['logo_name'] = htmlspecialchars(trim($_POST['logo_name']));
        $additionalFields['slogan'] = htmlspecialchars(trim($_POST['slogan']));
        $additionalFields['design_preferences'] = isset($_POST['design_preferences']) ? htmlspecialchars(trim($_POST['design_preferences'])) : 'Not Selected';
    } elseif ($commonFields['package'] == 'Ecommerce Website' || $commonFields['package'] == 'Web Design') {
        $additionalFields['website_description'] = htmlspecialchars(trim($_POST['website-description']));
        $additionalFields['industry'] = htmlspecialchars(trim($_POST['industry']));
        $additionalFields['company_description'] = htmlspecialchars(trim($_POST['company_description']));
        $additionalFields['website_purpose'] = isset($_POST['website_purpose']) ? implode(", ", $_POST['website_purpose']) : '';
        $additionalFields['competitors'] = htmlspecialchars(trim($_POST['competitors']));
        $additionalFields['website_image'] = isset($_POST['website_image']) ? implode(", ", $_POST['website_image']) : '';
        $additionalFields['selected_pages'] = isset($_POST['selected_pages']) ? implode(", ", $_POST['selected_pages']) : '';
        $additionalFields['font_style'] = isset($_POST['font_style']) ? implode(", ", $_POST['font_style']) : '';
        $additionalFields['home_page_features'] = isset($_POST['home_page_features']) ? implode(", ", $_POST['home_page_features']) : '';
        $additionalFields['payment_option'] = htmlspecialchars(trim($_POST['payment_option']));
    } elseif ($commonFields['package'] == 'seo') {
        $additionalFields['international'] = htmlspecialchars(trim($_POST['international']));
        $additionalFields['location'] = htmlspecialchars(trim($_POST['location']));
        $additionalFields['seo_goals'] = htmlspecialchars(trim($_POST['seo_goals']));
        $additionalFields['keywords'] = htmlspecialchars(trim($_POST['keywords']));
        $additionalFields['previous_seo'] = htmlspecialchars(trim($_POST['previous_seo']));
        $additionalFields['report_preferences'] = htmlspecialchars(trim($_POST['report_preferences']));
    } elseif ($commonFields['package'] == 'Web Content') {
        $additionalFields['content'] = htmlspecialchars(trim($_POST['content']));
        $additionalFields['target'] = htmlspecialchars(trim($_POST['target']));
        $additionalFields['guidelines'] = htmlspecialchars(trim($_POST['guidelines']));
        $additionalFields['tone_style'] = htmlspecialchars(trim($_POST['technical']));
        $additionalFields['formatting'] = htmlspecialchars(trim($_POST['formatting']));
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com'; // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'support@websiteinweek.com'; // SMTP username
        $mail->Password   = 'Websiteinweek_123'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Send email to admin
        $mail->setFrom('support@websiteinweek.com', 'Logos Pixel');
        $mail->addAddress('support@websiteinweek.com'); // Send to yourself

        // Content for admin email
        $mail->isHTML(true);
        $mail->Subject = "New Order: {$commonFields['package']} - Order ID: {$commonFields['order_id']}";
        
        // Construct the email body for admin
        $mail->Body = "
            <h2>New Order Details</h2>
            <p><strong>Name:</strong> {$commonFields['name']}</p>
            <p><strong>Email:</strong> {$commonFields['email']}</p>
            <p><strong>Package:</strong> {$commonFields['package']}</p>
            <p><strong>Order ID:</strong> {$commonFields['order_id']}</p>
            <p><strong>Additional Information:</strong> {$commonFields['additional_info']}</p>
        ";

        // Append additional fields based on the package
        foreach ($additionalFields as $key => $value) {
            if (!empty($value)) {
                $mail->Body .= "<p><strong>" . ucfirst(str_replace('_', ' ', $key)) . ":</strong> $value</p>";
            }
        }

        // Handle file upload
        if (isset($_FILES['reference']) && $_FILES['reference']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['reference']['tmp_name'];
            $fileName = basename($_FILES['reference']['name']);
            
            // Attach the file if it exists
            if (file_exists($fileTmpPath)) {
                $mail->addAttachment($fileTmpPath, $fileName);
            } else {
                $response['code'] = false;
                $response['err'] = "Temporary file does not exist.";
                echo json_encode($response);
                exit;
            }
        }

        $mail->send(); // Send the admin email

        // Now send a thank-you email to the user
        $thankYouMail = new PHPMailer(true);
        $thankYouMail->isSMTP();
        $thankYouMail->Host       = 'smtp.hostinger.com'; // Your SMTP server
        $thankYouMail->SMTPAuth   = true;
        $thankYouMail->Username   = 'support@websiteinweek.com'; // SMTP username
        $thankYouMail->Password   = 'Websiteinweek_123'; // SMTP password
        $thankYouMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $thankYouMail->Port       = 587;

        // Send thank-you email to the user
        $thankYouMail->setFrom('support@websiteinweek.com', 'website in week');
        $thankYouMail->addAddress($commonFields['email']); // Send to the user's email

        // Content for thank-you email
        $thankYouMail->isHTML(true);
        $thankYouMail->Subject = "Thank You for Your Order!";
        $thankYouMail->Body = "
            <h2>Thank You for Your Order!</h2>
            <p>Dear {$commonFields['name']},</p>
            <p>Thank you for your order of the <strong>{$commonFields['package']}</strong> package.</p>
            <p>Your Order ID is: <strong>{$commonFields['order_id']}</strong></p>
            <p>We will review your submission and get back to you shortly.</p>
            <p>If you have any questions, feel free to reply to this email.</p>
            <p>Best regards,<br>website in week </p>
        ";

        $thankYouMail->send(); // Send the thank-you email

        // Successful response
        $response['code'] = true;
        $response['success'] = "Thank you for your submission! Your order ID is: {$commonFields['order_id']}";
        echo json_encode($response);
    } catch (Exception $e) {
        $response['code'] = false;
        $response['err'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        echo json_encode($response);
    }
} else {
    $response['code'] = false;
    $response['err'] = 'Invalid request method.';
    echo json_encode($response);
}
?>