#!/usr/bin/env bash

# 環境変数ファイルの作成
cp .env.example .env

# パッケージインストール
composer install

# LaravelのAPP_KEY生成
php artisan key:generate

# マイグレーション
# php artisan migrate:fresh --seed

# セットアップ
npm install
npm run dev

php artisan serve --host 0.0.0.0 --port=80
