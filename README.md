# VisualBox

学校教員のプロジェクト、タスクを管理・共有できるアプリです。

-   自分のタスクを可視化し把握できる
-   プロジェクトの各タスクの進行状況を可視化し把握できる
-   プロジェクトのメンバーに管理者、編集、閲覧、いずれかの権限を付与できる

[![Image from Gyazo](https://i.gyazo.com/5cb35cbfec5b3012f6d385f7b9cbf755.png)](https://gyazo.com/5cb35cbfec5b3012f6d385f7b9cbf755)

## 制作背景

私は前職で小学校の教員をしていました。

そこでは口頭での説明や紙媒体の情報共有が多く、記録漏れしてしまったり、机の上が紙であふれてしまったりすることがありました。

そこで、タスクの管理や共有、連絡、要望などを Web アプリケーションを通して残しておくことができれば、タスク漏れや不必要な紙での情報共有が回避できると思い VisualBox を開発しました。

## 使用技術

フロントエンド

-   HTML
-   CSS
-   TailwindCSS
-   JavaScript

バックエンド

-   PHP 8.0.11
-   Laravel 8.61.0
-   MySQL 8.0.27
-   PHPUnit

インフラ・コード管理

-   Git/GitHub
-   Docker
-   AWS（VPC・EC2・RDS・Memcached・Route53・ACM・LB・EB）

## 機能一覧

|     | 主な機能             |
| --- | -------------------- |
| 1   | アカウント登録機能   |
| 2   | 認証機能             |
| 3   | プロジェクト作成機能 |
| 4   | プロジェクト編集機能 |
| 5   | メンバー変更機能     |
| 6   | 権限付与機能         |
| 7   | タスク作成機能       |
| 8   | タスク編集機能       |
| 9   | コメント機能         |
| 10  | 検索詳細機能         |
| 11  | 認可機能             |

## URL

URL: https://visualbox.link/

ゲストログインボタンで簡単にログインできます。

## ER 図

[![Image from Gyazo](https://i.gyazo.com/a567bd8fe5e83106137049ee801b5e61.png)](https://gyazo.com/a567bd8fe5e83106137049ee801b5e61)

URL:https://drive.google.com/file/d/1Tqdri-Et1m5uYzX-Xn6voV-PXiwNfE45/view?usp=sharing

## インフラ構成図

[![Image from Gyazo](https://i.gyazo.com/66db460cc11bff75eb4c1b6433e53e68.png)](https://gyazo.com/66db460cc11bff75eb4c1b6433e53e68)
