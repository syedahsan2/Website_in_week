<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_your_secret_key_here');

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price' => $input['priceId'],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => $input['successUrl'],
        'cancel_url' => $input['cancelUrl'],
        'metadata' => [
            'package_name' => $input['packageName']
        ],
    ]);

    echo json_encode(['id' => $session->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>