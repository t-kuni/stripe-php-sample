# Stripe-PHP-Sample

StripeをPHPで動かしてみたサンプルです。
Dockerが動く環境が必要です。

# 実行手順

## クローン

```
git clone ssh://git@github.com/t-kuni/stripe-php-sample
cd stripe-sample
```

## .envの用意

```
cp .env.sample .env
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
docker-compose up 
```

## hostsファイル追記

```
example.com {dockerマシンのIPアドレス}
```
windowsの場合は大体`192.168.99.100`です

## SSL証明書のインストール

`environment/web/certs/server.crt`を「信用できるルート証明書」として端末にインストールする。

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