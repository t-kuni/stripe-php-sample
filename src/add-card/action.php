<?php
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

<h1>顧客(ID:<?= $customerId ?>)にカードを追加しました</h1>
<table border="1">
    <tr>
        <th>Brand</th>
        <td><?= $card->brand ?></td>
    </tr>
    <tr>
        <th>Last4</th>
        <td><?= $card->last4 ?></td>
    </tr>
</table>

<div>
    <a href="/index.php">トップへ戻る</a>
</div>