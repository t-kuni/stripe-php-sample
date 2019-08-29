<?php
require_once('../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create('../../');
$dotenv->load();

$secretKey = getenv('STRIPE_SECRET_KEY');
$publicKey = getenv('STRIPE_PUBLIC_KEY');

\Stripe\Stripe::setApiKey($secretKey);

$customerId = $_POST['customer-id'];

$cards = \Stripe\Customer::allSources(
    $customerId,
    [
        'limit' => 3,
        'object' => 'card',
    ]
);
?>

<h1>顧客(ID:<?= $customerId ?>)のカード一覧を取得しました</h1>

<table border="1" style="border-collapse: collapse">
    <tr>
        <th>ブランド</th>
        <th>4文字</th>
    </tr>
    <?php foreach ($cards as $card) { ?>
        <tr>
            <td><?= $card->brand ?></td>
            <td><?= $card->last4 ?></td>
        </tr>
    <?php } ?>
</table>

<div>
    <a href="/index.php">トップへ戻る</a>
</div>