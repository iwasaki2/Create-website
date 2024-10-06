<?php
// エラーメッセージの表示を有効にする
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// データベースの接続情報
$servername = "localhost"; // サーバー名
$username = "root"; // あなたのMySQLのユーザー名
$password = ""; // あなたのMySQLのパスワード（空白の場合はそのまま）
$dbname = "curimatch_db"; // 作成したデータベース名

// データベースに接続
$conn = new mysqli($servername, $username, $password, $dbname);

// 接続チェック
if ($conn->connect_error) {
    die("接続失敗: " . $conn->connect_error);
}

// フォームから送信されたデータを取得
$user = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];

// パスワードをハッシュ化
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

// SQL文を準備
$sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$hashed_password')";

// データを挿入
if ($conn->query($sql) === TRUE) {
    // 登録成功時に新しいHTMLファイルを表示
    header('Location: signup.html'); // signup.htmlにリダイレクト
    exit; // スクリプトの実行を終了
} else {
    echo "エラー: " . $sql . "<br>" . $conn->error; // エラーメッセージを表示
}

// 接続を閉じる
$conn->close();
?>
