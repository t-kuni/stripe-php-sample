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

?>

<script src="https://js.stripe.com/v3/"></script>

<h1>顧客IDを元に決済します</h1>

<form action="/action/charge-by-customer.php" method="post" id="payment-form">
    <div>
        <label for="customer-id">顧客ID</label>
        <input type="text" id="customer-id" name="customer-id" placeholder="xxxxxx" />
    </div>

    <div>
        <label for="amount">金額</label>
        <input type="text" id="amount" name="amount" placeholder="10000" />
    </div>

    <button>決済実行</button>
</form>