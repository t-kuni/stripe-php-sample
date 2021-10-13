# Stripe-PHP-Sample

StripeをPHPで動かしてみたサンプルです。
Dockerが動く環境が必要です。

# 実行手順

## クローン

```
git clone ssh://git@github.com/t-kuni/stripe-php-sample
cd stripe-php-sample
```

## .envの用意

```
cp .env.example .env
cp environment/.env.example environment/.env
```

`.env`ファイルにStripeのパブリックキーとプライベートキーを記載します

## コンテナのビルド

```
cd environment
docker-compose build
```

## ライブラリのインストール

```
docker-compose run --rm app composer install
```

## コンテナ起動

nginxとphp-fpmが起動します。

```
docker-compose up -d
```

## hostsファイル追記

```
example.com {dockerマシンのIPアドレス}
```
※dockerマシンのIPアドレスは環境により異なります

## アクセス

以下のURLを開いてください。  
※HTTPSでアクセスする必要があります。（HTTPSでしかstripeのAPIが使えません）

```
https://example.com
```

# Documents

公式ドキュメント  
https://stripe.com/docs/payments

テスト用のクレジットカード情報  
https://stripe.com/docs/testing#cards

# 終わりに

お役に立てましたらスターを頂けるとうれしいです！！