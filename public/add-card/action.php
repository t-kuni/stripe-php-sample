<?php
/*
 * クレカ情報を保存する
 */

require_once('../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create('../../');
$dotenv->load();

$secretKey = getenv('STRIPE_SECRET_KEY');
$publicKey = getenv('STRIPE_PUBLIC_KEY');

\Stripe\Stripe::setApiKey($secretKey);

$token = $_POST['stripeToken'];
$customerId = $_POST['customer-id'];

$card = \Stripe\Customer::createSource(
    $customerId,
    [
        'source' => $token,
    ]
);
?>

<h1>カードを追加しました</h1>
<p>顧客ID: <?= $customerId ?></p>
<p>Brand: <?= $card->brand ?></p>
<p>Last4: <?= $card->last4 ?></p>

<div>
    <a href="/index.php">トップへ戻る</a>
</div>