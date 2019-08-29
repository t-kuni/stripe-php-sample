<?php
require_once('../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create('../../');
$dotenv->load();

$secretKey = getenv('STRIPE_SECRET_KEY');
$publicKey = getenv('STRIPE_PUBLIC_KEY');

\Stripe\Stripe::setApiKey($secretKey);

$token = $_POST['stripeToken'];
$email = $_POST['email'];
$name  = $_POST['name'];

$customer = \Stripe\Customer::create([
    'source' => $token, // クレジットカードトークン
    'email'  => $email, // メールアドレス
    'name'   => $name,  // 顧客の名前
]);
?>

<h1>顧客情報(Customer)が作成されました</h1>
<table border="1">
    <tr>
        <th>クレジットカードトークン</th>
        <td><?= $token ?></td>
    </tr>
    <tr>
        <th>メールアドレス</th>
        <td><?= $email ?></td>
    </tr>
    <tr>
        <th>顧客ID</th>
        <td><?= $customer->id ?></td>
    </tr>
</table>

<div>
    <a href="/index.php">トップへ戻る</a>
</div>