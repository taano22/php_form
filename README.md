## 開発環境
	* プログラミング言語
		* PHP 7.1.x
		* HTML5
		* CSS
		* Javascript
	* ライブラリ
		* jQuery 3.6.3(CDN)
	* エディタ
		* Visual Studio Code 1.47.3
	* サーバー
		* Xfreeサーバー(無料レンタルサーバー)
	* データベース
		* MySQL 5.0.95
	* OS
		* Windows 11

## 実装に費やした時間
	* 実装期間:8日間
	* 実装合計時間:38時間

## 実装中に工夫したところ
	* 利便性向上のため、メールアドレスやデータベース接続情報は変数に格納して最上位に置きました。
	* ユーザー目線を意識して機能や表示を作成しました。例えば画像のプレビュー表示、ファイル形式や必須・任意項目の明示などです。
	* 画像の保存方法に関して、画像データをそのままデータベースに登録すると容量が大きくなってしまうため、ディレクトリに保存して
	その画像名をデータベースに保存するようにしました。その際ファイル名はランダムな文字列に変更されるようにしました。
	* ファイル変数のチェックする機能やSQLインジェクション対策などのセキュリティ対策を意識しました。

## 実装中に問題となったこと
	* 確認画面での画像表示に関して、当初はフォームページから確認ページに移動する際にディレクトリに画像ファイルを保存してそのパスを使用していました。
	入力修正のたびに余計なファイルが保存されるため、後にセッションを使用して表示するように変更しました。
	* メール文中の変数$bodyをもともと$messageで記述していたため、ユーザー入力項目の$messageと被り動作不具合が起ていました。
	* データベースに"0"が登録されないことに気づきコードを修正しました。
	* データベース接続やメール送信に関して、最初に動作確認を行ったとき、どちらも失敗したためいくつかの記述方法を試し成功した方法を採用しました。

## 改善点
	* 事前に手順を詳しく決めずにプログラム作成を開始してしまったため、今後は事前に詳しく設計を行い記載するなどします。
	* 全て作り終えてから整えたコード部分が多かったため、複数人で作成することも考え今後は各パートごとに整えながら作ることを意識します。

## 行った動作テスト
	* 作成中は単体テストを意識して、各機能を作成するごとに簡単なテストを行った。
	* すべて作成し終えた後は、結合テストとしてフォーム入力から送信完了画面までの動作およびメール内容やデータベース登録内容を確認した。
	* 具体的なテスト内容としては、設定した規定値を外れた場合の動作、多種類の文字入力や画像アップロードなど。

## その他
	ファイル内のデータベース情報やメールアドレスなどはセキュリティ上削除しています。	

## 参考資料又は参考サイト
* 超初心者向け！Linux環境(CentOS)の構築方法～VMware編～
https://ramin.hatenablog.com/entry/2019/03/28/013158
* CentOS とは？ CentOS7 ISOダウンロード方法
https://nw-engineer.work/centos7iso/
* WindowsにLinux仮想環境を構築する
https://www.bioerrorlog.work/entry/install-linux-on-win
* 【初心者向け】Ubuntu 22.04 LTS(日本語)のインストール手順【VirtualBox】
https://invisiblepotato.com/ubuntu06/
* PHPでお問い合わせフォームを作る
https://qiita.com/s79ns/items/62ce69fef20258f35534
* PHPを使ってデータベースに接続。フォームから入力されたデータをDBに登録する方法
https://kasumiblog.org/php-db-form-post-register/
* 【PHP】都道府県などセレクトボックスの値をSESSIONで渡す。入力フォーム⇔確認画面→送信の流れ。
http://blog.livedoor.jp/suitablescript/archives/51474384.html
* 【PHP】確認画面で画像を保存せず表示
https://qiita.com/ryouya3948/items/66294cb445663f2a9d95
* PHP 画像のアップロード
https://qiita.com/ryo-futebol/items/11dea44c6b68203228ff
* PHPでのエラーチェック方法を解説【try-catchは不要です】
https://akiblog10.com/php-errors/
* [PHP] フォームからアップロードした画像をメールに添付する方法
https://gen-s.jp/2020/11/13/php-%E3%83%95%E3%82%A9%E3%83%BC%E3%83%A0%E3%81%8B%E3%82%89%E3%82%A2%E3%83%83%E3%83%97%E3%83%AD%E3%83%BC%E3%83%89%E3%81%97%E3%81%9F%E7%94%BB%E5%83%8F%E3%82%92%E3%83%A1%E3%83%BC%E3%83%AB%E3%81%AB/
* 【jQuery】画像をアップロードしてプレビューを表示
https://web-emo.com/jquery-preview-img/
* 【HTML】初心者でも簡単にできるお問い合わせフォームの作り方を解説【CSS】
https://zero-plus.io/media/make-a-form/
* jQueryを使って文字数カウントを表示させる方法
https://qiita.com/yusuke_prg/items/29453a6b8a751aedc7b7
* PHPのセキュリティ対策
https://laboradian.com/sec-php/
* ホワイトハッカーへの道　二歩目 ファイルアップロード機能の脆弱性を考える
https://qiita.com/ichimura/items/0c4e5d2dd6fe8b55018e
* PDOでATTR_EMULATE_PREPARESを適切に設定してないとSQLインジェクションの原因になるかも（MySQL編）
https://qiita.com/stk2k/items/c46cc921a4f7b6e4bab2
