# ララチャット<br>〜未経験エンジニアによる未経験エンジニアのためのチャット〜
## アプリケーション概要
未経験者同士でチャットで教え合い、インプット・アウトプットができるアプリケーションです。<br>
## URL
http://18.181.136.195 <br>
接続可能時刻は午前9時から午後10時までです。<br>
上記意外で利用したい場合は,TwitterのDM等でご連絡ください。
## テスト用アカウント
テストメールアドレス：kenji@test<br>
テストパスワード：kenjitest
## 利用方法
- エンジニア未経験者同士で各言語ごとにチャットで教えあったり、ダイレクトメッセージを使って任意の相手に直接質問することができます。　<br>
- 個人用メモと掲示板への投稿ができるので、不明点を記録・検索することができ、インプット・アウトプットが簡単にできます。　<br>
![laravel_gif](https://user-images.githubusercontent.com/76867234/118641353-03a68200-b815-11eb-8670-b9635c5c24e2.gif)

## 目指した課題解決
プログラミング学習は挫折が多いと言われる理由に <br>
1. 同じレベルの仲間がいない <br>
2. 未経験者だとコミュニティに入って質問することに抵抗があり、不明点が解決できない <br>
3. 知識の発信場所がない <br>
といったことがあり、エンジニア未経験者同士で各言語ごとのチャット・メモ・投稿ができることで、挫折者を減らすことを目指しています。
## 機能一覧
機能 | 詳細 
-|-
ユーザー登録、ログイン機能 | トップページにユーザー登録・ログインボタン表示
グループチャット機能 | 各言語ごとにメッセージ送信ができる
ダイレクトメッセージ機能 | 任意の相手にダイレクトメッセージ送信ができる
メモ・プロフィール（CRUD） | メモ・プロフィールを作成・編集・削除ができる
画像投稿機能 | 画像の投稿、変更ができる
掲示板投稿機能 | メモ作成時に掲示板へ投稿するか選択ができる
各トーク検索、掲示板記事検索機能 | 各画面内のトークの検索ができる・掲示板の記事検索ができる
ページネーション機能 | ページングができる
スクロール機能　| 無限スクロールができる
## 実装予定機能一覧
- 同期通信または非同期通信機能
## 使用技術
- HTML/CSS
- PHP 7.3.28
- Laravel 7.30.4
- MySQL 8.0.23
- Docker/Docker-compose
- AWS(EC2,S3)
## インフラ構成図
<img width="715" alt="スクリーンショット 2021-05-22 15 07 14" src="https://user-images.githubusercontent.com/76867234/119216591-7a8e9400-bb0f-11eb-8f9c-fe1dac3cdf33.png">

## 設計書
https://docs.google.com/spreadsheets/d/1uefRjptR_vnOvrtEsCRGRicU7ncljS-qMpQGg38R348/edit?usp=sharing
## ローカル環境での動作確認方法
1. git clone https://github.com/zkenkenz/laravel_chat2.git
1. cd laradock
    1. cp env-example .env
    2. docker-compose up -d php-fpm nginx mysql phpmyadmin workspace
    3. docker-compose exec workspace bash
    4. composer install
    5. php artisan storage:link
1. cd melpit 
    1. cp .env.example .env
    2. php artisan key:generate
1. 動作確認　http://localhost/
