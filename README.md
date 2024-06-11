# confirmation-test
お問い合わせフォーム

環境構築

Dockerビルド

1. git clone リンク
2. docker-compose up -d build

※Mysqlは、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.ymlファイルを編集してください。

Laravel環境構築

1. docker-compose exec php bash
2. composer install
3. .env.exampleファイルから .envを作成し、環境変数を変更
4. php artisan key:generate
4. php artisan migrate
5. php artisan db:seed

使用技術

- PHP 7.4.9
- Laravel 8.75
- Mysql 8.0.26
- Node.js v20.14.0　  ※最終日に追加、使用してないと思います
- npm 10.7.0  　※最終日に追加、使用してないと思います
- bootstrap 5.1.3　  ※最終日に追加、使用してないと思います
- Jetstream 2.9  　※最終日に追加、使用してないと思います

URL

- 開発環境 : http://localhost/
- phpMyAdmin : http://localhost:8080/

※　未完成です。管理画面の途中です。
  管理画面のモーダルウィンドウを使用する際、調べてbootstrap等をインストールしました。
  
  
