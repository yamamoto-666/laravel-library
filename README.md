# Laravel Library Management

Laravelで開発した、著者と本を管理するWebアプリケーションです。
CRUD処理を中心に、認証、画像アップロード、検索、並べ替え、ページネーションなど、Webアプリ開発の基本機能を実装しています。

## 主な機能

- ユーザー登録・ログイン・ログアウト
- 著者の登録・一覧表示・編集・削除
- 本の登録・一覧表示・詳細表示・編集・削除
- カバー画像のアップロード・更新・削除
- 著者未設定（ANONYMOUS）の本への対応
- タイトル・著者名・出版年による検索
- タイトル・出版年・登録日時による並べ替え
- 一覧画面のページネーション
- 削除前の確認画面・確認モーダル
- バリデーションとCSRF対策
- 認証済みユーザーだけが管理画面を利用できるアクセス制御

## 使用技術

- PHP 8.3+
- Laravel 13
- Laravel UI
- MySQL / SQLite
- Blade
- Bootstrap 5
- JavaScript
- Vite
- Pest

## データ構成

- Authorは複数のBookを持ちます。
- Bookは1人のAuthorに属します。
- Authorを削除した場合、関連するBookの `author_id` は `null` になります。
- BookはAuthorを設定せず、ANONYMOUSとして登録することもできます。

## セットアップ

### 必要な環境

- PHP 8.3以上
- Composer
- Node.js / npm
- SQLite、またはMySQL

### インストール

```bash
git clone <repository-url>
cd laravel-library
composer install
npm install
cp .env.example .env
php artisan key:generate
```

`.env` のデータベース設定を環境に合わせて変更したあと、次を実行します。

```bash
php artisan migrate
php artisan storage:link
npm run build
php artisan serve
```

ブラウザで `http://localhost:8000` を開き、ユーザー登録後に利用できます。

## テスト

```bash
php artisan test
```

## このアプリで学んだこと

- LaravelにおけるMVCの役割
- Eloquent ORMを使ったCRUD処理
- `belongsTo` リレーションと外部キー
- バリデーション処理
- ファイルの保存と古い画像の削除
- クエリビルダーによる部分一致検索と条件付き検索
- `orderBy()` と `paginate()` を組み合わせた一覧表示
- Blade、Bootstrapを使った画面作成
- 認証ミドルウェアによるアクセス制御

## 今後追加したい機能

- 機能テストの拡充
- 読書ステータス（未読・読書中・読了）
- お気に入り機能
- ログインユーザーごとの本棚
- カテゴリー・レビュー・評価機能
