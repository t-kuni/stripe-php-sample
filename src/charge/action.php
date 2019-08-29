<?php
require_once('../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create('../../');
$dotenv->load();

$secretKey = getenv('STRIPE_SECRET_KEY');
$publicKey = getenv('STRIPE_PUBLIC_KEY');

\Stripe\Stripe::setApiKey($secretKey);

$token  = $_POST['stripeToken'];

$charge = \Stripe\Charge::create([
    'amount'      => 999,              // 金額
    'currency'    => 'jpy',            // 単位
    'description' => 'Example charge', // 名目
    'source'      => $token,           // クレジットカードトークン
]);
?>

<h1>決済成功</h1>
<table border="1">
    <tr>
        <th>クレジットカードトークン</th>
        <td><?= $token ?></td>
    </tr>
</table>

<div>
    <a href="/index.php">トップへ戻る</a>
</div>