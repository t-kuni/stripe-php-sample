<?php

require_once('../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create('../../');
$dotenv->load();

$secretKey = getenv('STRIPE_SECRET_KEY');
$publicKey = getenv('STRIPE_PUBLIC_KEY');

\Stripe\Stripe::setApiKey($secretKey);

$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items'           => [[
        'name'        => 'T-shirt',
        'description' => 'Comfortable cotton t-shirt',
        'images'      => ['https://example.com/t-shirt.png'],
        'amount'      => 500,
        'currency'    => 'jpy',
        'quantity'    => 1,
    ]],
    'success_url'          => 'https://example.com/success',
    'cancel_url'           => 'https://example.com/cancel',
]);

?>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const publicKey = '<?= $publicKey ?>';

    var stripe = Stripe(publicKey);

    function onClick() {
        stripe.redirectToCheckout({
            sessionId: '<?= $session->id ?>'
        }).then(function (result) {
            // If `redirectToCheckout` fails due to a browser or network
            // error, display the localized error message to your customer
            // using `result.error.message`.
        });
    }
</script>

<button onclick="onClick()">決済</button>