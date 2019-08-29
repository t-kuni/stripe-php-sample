<?php
require_once('../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::create('../../');
$dotenv->load();

$secretKey = getenv('STRIPE_SECRET_KEY');
$publicKey = getenv('STRIPE_PUBLIC_KEY');

\Stripe\Stripe::setApiKey($secretKey);
?>

<script src="https://js.stripe.com/v3/"></script>

<h1>カード追加</h1>

<form action="/add-card/action.php" method="post" id="payment-form" style="width: 400px;">
    <div class="form-row">
        <div>
            <label for="customer-id">顧客ID</label>
            <input type="text" id="customer-id" name="customer-id" placeholder="xxxx" />
        </div>
        <label for="card-element">
            クレジットカード情報
        </label>

        <div id="card-element">
            <!-- ここにクレジットカード情報入力欄が挿入される -->
        </div>

        <!-- ここにエラーメッセージが表示される -->
        <div id="card-errors" role="alert"></div>
    </div>

    <button>カード追加</button>
</form>

<script>
    const publicKey = '<?= $publicKey ?>';

    var stripe = Stripe(publicKey);
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    var style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            color: "#32325d",
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
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
    // stripeサーバでトークンに変換してからアプリのサーバにポストする
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>