# ProjectMoreChargers
[English](./README.md)
## プロジェクトの説明
ProjectMoreChargersは、ユーザーが充電ステーションを建設してほしい場所と一部のユーザー情報を提出できるプラットフォームです。このデータは、充電ステーションのプロバイダーが建設プロジェクトの参考にすることができます。

## デモ
プロジェクトはAWSにデプロイされており、[http://demo.morechargers.com](http://demo.morechargers.com).からアクセスできます。

### Test accounts:
- **User**:
- id: user@user.com
- password: password
- **Provider**:
- id: provider@provider.com
- password: password
- **Admin**:
- id: admin@admin.com
- password: password
## テクノロジースタック For Demo
- **フロントエンド**: Vue.js, Tailwind CSS
- **バックエンド**: Laravel
- **コンテナ化**: DockerとLaravel Sail
- **認証**: Laravel Sanctum
- **テスト**: PHPUnit
- **クラウドプラットフォーム**: AWS (ECS on EC2, Route53)

## インストール

### 必要条件
DockerとDocker Composeがインストールされていることを確認してください。

### インストール手順
1. リポジトリをクローンします
   ```bash
   git clone [リポジトリのリンク]
   ```
2. `.env.example`を基に、`.env`と`.env.testing`ファイルを作成します。
3. Laravel Sailを使用してプロジェクトを開始します
   ```bash
   ./vendor/bin/sail up
   ```

## 使い方
- **デモ**: プロジェクトはAWSにデプロイされており、[http://demo.morechargers.com](http://demo.morechargers.com).からアクセスできます。

- **ユーザータイプ**:
    - **匿名ユーザー**: 充電ステーションの希望場所についての調査を記入できます。
    - **ユーザーアカウント**: 登録後、ユーザーは調査を記入し、充電ステーションの場所をアップロードし、個人情報を更新し、アカウントを削除することができます。
    - **プロバイダーアカウント**: 登録後、プロバイダーはユーザーが記入した調査を表示し、ユーザーアカウントで利用可能なすべての操作を実行することができます。
    - **管理者アカウント**: 全権限を持ち、アカウントの削除、ユーザー情報の更新、調査の記入、ダッシュボードへのアクセスを含みます。

## 機能
- **ユーザー**:
    - 登録、ログイン
    - 充電ステーションの場所についての調査を記入
    - 個人情報の更新
    - アカウントの削除

- **プロバイダー**:
    - ユーザーが利用可能なすべての機能
    - ユーザーが記入した調査の表示

- **管理者**:
    - プロバイダーが利用可能なすべての機能
    - アカウントの削除
    - ダッシュボードの表示（ユーザー数、調査数、充電ステーション会社の数を含む）

## スクリーンショット
<img src="./githubimgs/home.png" alt="Home" width="800"/>
<img src="./githubimgs/login.png" alt="Login" width="800"/>
<img src="./githubimgs/signup.png" alt="SingUp" width="800"/>
<img src="./githubimgs/profile.png" alt="Profile" width="800"/>
<img src="./githubimgs/survey.png" alt="Survey" width="800"/>
<img src="./githubimgs/dashboard.png" alt="DashBoard" width="800"/>

## ライセンス
このプロジェクトは[MITライセンス](https://opensource.org/license/mit/)の下でライセンスされています。
