<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$response = ['success' => false, 'errors' => []];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $subject = htmlspecialchars(trim($_POST['subject'] ?? 'No subject'));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validate required fields
    if (empty($name)) {
        $response['errors']['name'] = 'Name is required';
    }
    if (empty($email)) {
        $response['errors']['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['errors']['email'] = 'Invalid email format';
    }
    if (empty($message)) {
        $response['errors']['message'] = 'Message is required';
    }

    if (!empty($response['errors'])) {
        echo json_encode($response);
        exit;
    }

    try {
        // Admin email
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'support@websiteinweek.com';
        $mail->Password = 'Websiteinweek_123';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('support@websiteinweek.com', 'Website in Week');
        $mail->addAddress('support@websiteinweek.com');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "New Contact Form: $subject";
        $mail->Body = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Subject:</strong> $subject</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        ";

        $mail->send();

        // Thank you email to user
        $thankYouMail = new PHPMailer(true);
        $thankYouMail->isSMTP();
        $thankYouMail->Host = 'smtp.hostinger.com';
        $thankYouMail->SMTPAuth = true;
        $thankYouMail->Username = 'support@websiteinweek.com';
        $thankYouMail->Password = 'Websiteinweek_123';
        $thankYouMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $thankYouMail->Port = 587;

        $thankYouMail->setFrom('support@websiteinweek.com', 'Website in Week');
        $thankYouMail->addAddress($email);

        $thankYouMail->isHTML(true);
        $thankYouMail->Subject = "Thank you for contacting us";
        $thankYouMail->Body = "
            <h3>Dear $name,</h3>
            <p>Thank you for reaching out to us! We have received your message and will get back to you soon.</p>
            <p><strong>Your message:</strong></p>
            <p>$message</p>
            <p>Best regards,<br>Website in Week</p>
        ";

        $thankYouMail->send();

        $response['success'] = true;
        $response['message'] = 'Thank you! Your message has been sent successfully.';
    } catch (Exception $e) {
        $response['errors']['system'] = "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
} else {
    $response['errors']['system'] = 'Invalid request method.';
}

echo json_encode($response);