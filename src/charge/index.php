<?php
require_once('../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create('../../');
$dotenv->load();

$secretKey = getenv('STRIPE_SECRET_KEY');
$publicKey = getenv('STRIPE_PUBLIC_KEY');

\Stripe\Stripe::setApiKey($secretKey);

?>

<script src="https://js.stripe.com/v3/"></script>

<h1>決済(Charge)</h1>

<form action="/charge/action.php" method="post" id="payment-form" style="width: 400px;">
    <div class="form-row">
        <label for="card-element">クレジットカード情報</label>

        <div id="card-element">
            <!-- ここにクレジットカード情報入力欄が挿入される -->
        </div>

        <!-- ここにエラーメッセージが表示される -->
        <div id="card-errors" role="alert"></div>
    </div>

    <button>決済実行</button>
</form>

<script>
    const publicKey = '<?= $publicKey ?>';

    var stripe = Stripe(publicKey);
    var elements = stripe.elements();

    // スタイルのカスタマイズ
    var style = {
        base: {
            fontSize: '16px',
            color: "#32325d",
        }
    };

    // クレジットカード情報入力欄の構築
    var card = elements.create('card', {style: style});
    card.mount('#card-element');

    // 入力変更時のリスナー
    // バリデーションメッセージを表示する
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // submit時のリスナー
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        // Stripeサーバにクレジットカード情報を送信してクレジットカードトークンを取得する
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // クレジットカードトークンを時サーバにsubmitする
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        form.submit();
    }
</script>