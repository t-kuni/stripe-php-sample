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

$charge = \Stripe\Charge::create([
    'amount'      => 999,
    'currency'    => 'jpy',
    'description' => 'Example charge',
    'source'      => $token,
]);
?>

<h1>トークンが発行されました</h1>
<p><?= $token ?></p>

<h1>決済が完了しました。</h1>
<pre>
    <?php var_dump($charge) ?>
</pre>

<h1></h1>

<div>
    <a href="/index.php">トップへ戻る</a>
</div>