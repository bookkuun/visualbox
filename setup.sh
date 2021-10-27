#!/usr/bin/env bash

# 環境変数ファイルの作成
cp .env.production .env

# パッケージインストール
composer install

# マイグレーション
php artisan migrate:fresh --seed

# セットアップ
npm install
npm run dev

php artisan serve --host 0.0.0.0 --port=80
