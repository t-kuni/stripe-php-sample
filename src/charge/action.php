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

$token  = $_POST['stripeToken'];
$amount = $_POST['amount'];

$charge = \Stripe\Charge::create([
    'amount'      => 999,
    'currency'    => 'jpy',
    'description' => 'Example charge',
    'source'      => $token,
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