<?php
require_once('../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create('../../');
$dotenv->load();

$secretKey = getenv('STRIPE_SECRET_KEY');
$publicKey = getenv('STRIPE_PUBLIC_KEY');

\Stripe\Stripe::setApiKey($secretKey);

?>

<script src="https://js.stripe.com/v3/"></script>

<h1>カード一覧</h1>

<form action="/card-list/action.php" method="post" id="payment-form" style="width: 400px;">
    <div>
        <label for="customer-id">顧客ID</label>
        <input type="text" id="customer-id" name="customer-id" placeholder="xxxxxx" />
    </div>

    <button>カード一覧表示</button>
</form>