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
$email = $_POST['email'];

$customer = \Stripe\Customer::create([
    'source' => $token,
    'email' => $email,
]);
?>

<h1>トークンが発行されました</h1>
<p><?= $token ?></p>
<p><?= $email ?></p>

<h1>顧客情報を保存しました</h1>
<p>ID: <?= $customer->id ?></p>
<pre>
    <?php var_dump($customer) ?>
</pre>