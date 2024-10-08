<?php
// データベースの接続情報
$servername = "localhost"; // サーバー名
$username = "root"; // あなたのMySQLのユーザー名
$password = "0000"; // あなたのMySQLのパスワード（空白の場合はそのまま）
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

// 既存ユーザーを確認
$sql_check = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    // すでにユーザーが存在する場合、ログインページにリダイレクト
    header('Location: login.html');
    exit(); // スクリプトの実行を終了
} else {
    // パスワードをハッシュ化
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // 新しいユーザーを挿入
    $sql_insert = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$hashed_password')";

    if ($conn->query($sql_insert) === TRUE) {
        // 登録成功時に登録完了ページへリダイレクト
        header('Location: login.html'); // signup_success.htmlにリダイレクト
        exit; // スクリプトの実行を終了
    } else {
        echo "エラー: " . $sql_insert . "<br>" . $conn->error; // エラーメッセージを表示
    }
}

// 接続を閉じる
$conn->close();
?>
