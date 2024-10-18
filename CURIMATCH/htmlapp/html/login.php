<?php
session_start(); // セッションを開始

// フォームからのデータを取得
$login_email = $_POST['login_email'];
$login_password = $_POST['login_password'];

// データベース接続
$mysqli = new mysqli('localhost', 'root', '0000', 'curimatch_db');

// 接続チェック
if ($mysqli->connect_error) {
    die('接続エラー: ' . $mysqli->connect_error);
}

// ユーザー情報の取得
$query = $mysqli->prepare("SELECT id, password FROM users WHERE email = ?");
$query->bind_param("s", $login_email);
$query->execute();
$query->store_result();

// ユーザーが見つかった場合
if ($query->num_rows > 0) {
    $query->bind_result($user_id, $hashed_password);
    $query->fetch();

    // パスワードが正しいか確認
    if (password_verify($login_password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id; // セッションにユーザーIDを保存
        header("Location:upload.html"); // リダイレクト
        exit();
    } else {
        echo "パスワードが間違っています。";
    }
} else {
    echo "そのメールアドレスは登録されていません。";
}

$query->close();
$mysqli->close();
?>
