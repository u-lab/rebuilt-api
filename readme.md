# Rebuilt Api

## 概説

[ポートフォリオ作成サービス](https://github.com/u-lab/rebuilt)のREST API

## 環境構築

```bash
// ライブラリインストール
$ composer install

// envのコピーとkeyの生成
$ composer clone-install

// データベースのマイグレーション
$ php artisan migrate --seed

// サーバー起動
$ php artisan serve
```

## 環境

- Laravel 6.x
- PHP 7.3
- mysql

## エンドポイント

- 個人ページ GET (/api/v1/pages/{user})

  - 作品一覧 GET (/api/v1/pages/{user}/storages)

    - 作品ページ GET (/api/v1/pages/{user}/storages/{storageID})

- パンくずリスト GET (/api/v1/breadcrumbs?url=hoge

- サイトマップ GET (/api/v1/sitemap)

- ログイン POST (/api/v1/login)

- 新規登録 POST (/api/v1/register)

### 会員用

会員用のみのアクセス制限をかける。

- プロフィール一覧  GET (/api/v1/profiles)

- 作品一覧 GET (/api/v1/storages)

### ユーザー系

- ユーザー削除 DELETE (/api/v1/users)

- 自分のプロフィール GET  (/api/v1/users/profile)

  - プロフィール編集 PATCH (/api/v1/users/profile)

- 自分のポートフォリオ GET (/api/v1/users/page)

  - ポートフォリオ編集 PATCH (/api/v1/users/page)

- 自分の作品一覧 GET  (/api/v1/users/storages)

  - 作品追加 POST (/api/v1/users/storages)

  - 作品取得 GET (/api/v1/users/storages/{ storageID })

  - 作品編集 PATCH (/api/v1/users/storages/{ storageID })

  - 作品削除 DELETE (/api/v1/users/storages/{ storageID })

- ログアウト POST (/api/v1/logout)

### 管理者

TODO: 後日対応
