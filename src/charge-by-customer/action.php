<?php
require_once('../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create('../../');
$dotenv->load();

$secretKey = getenv('STRIPE_SECRET_KEY');
$publicKey = getenv('STRIPE_PUBLIC_KEY');

\Stripe\Stripe::setApiKey($secretKey);

$customerId = $_POST['customer-id'];
$amount     = $_POST['amount'];

$charge = \Stripe\Charge::create([
    'amount'   => $amount,     // 金額
    'currency' => 'jpy',       // 単位
    'customer' => $customerId, // 顧客ID
]);
?>

<h1>顧客IDを元に決済しました。</h1>
<table border="1">
    <tr>
        <th>顧客ID</th>
        <td><?= $customerId ?></td>
    </tr>
    <tr>
        <th>金額</th>
        <td><?= $amount ?>円</td>
    </tr>
</table>

<div>
    <a href="/index.php">トップへ戻る</a>
</div>