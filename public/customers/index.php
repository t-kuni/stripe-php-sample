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

$customers = \Stripe\Customer::all(["limit" => 10]);

?>

<script src="https://js.stripe.com/v3/"></script>

<h1>顧客一覧</h1>

<table border="1" style="border-collapse: collapse">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    <?php foreach ($customers as $customer) { ?>
        <tr>
            <td><?= $customer->id ?></td>
            <td><?= $customer->name ?></td>
            <td><?= $customer->email ?></td>
        </tr>
    <?php } ?>
</table>