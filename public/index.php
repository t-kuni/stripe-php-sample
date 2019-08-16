<?php
/*
 * クレカ情報を保存する
 */

require_once('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create('../');
$dotenv->load();

$secretKey = getenv('STRIPE_SECRET_KEY');
$publicKey = getenv('STRIPE_PUBLIC_KEY');

\Stripe\Stripe::setApiKey($secretKey);

// Create a Customer:
$customer = \Stripe\Customer::create([
    'source' => 'tok_mastercard',
    'email' => 'vartkg+1@gmail.com',
]);

// Charge the Customer instead of the card:
$charge = \Stripe\Charge::create([
    'amount' => 1000,
    'currency' => 'usd',
    'customer' => $customer->id,
]);

// YOUR CODE: Save the customer ID and other info in a database for later.

// When it's time to charge the customer again, retrieve the customer ID.
//$charge = \Stripe\Charge::create([
//    'amount' => 1500, // $15.00 this time
//    'currency' => 'usd',
//    'customer' => $customer_id, // Previously stored, then retrieved
//]);

?>

<script src="https://js.stripe.com/v3/"></script>

<form action="/charge" method="post" id="payment-form">
    <div class="form-row">
        <label for="card-element">
            Credit or debit card
        </label>
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display Element errors. -->
        <div id="card-errors" role="alert"></div>
    </div>

    <button>Submit Payment</button>
</form>

<script>
    const publicKey = '<?= $publicKey ?>';

    var stripe = Stripe(publicKey);
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    var style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            color: "#32325d",
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // 入力変更時のリスナー
    // バリデーションメッセージを表示する
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // submit時のリスナー
    // stripeサーバでトークンに変換してからアプリのサーバにポストする
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });
</script>