<?php
// データベース接続
$conn = new mysqli('localhost', 'root', '', 'curimatch_db');

// 接続エラーチェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// フォームからのデータを取得
$email = $_POST['login_email'];
$password = $_POST['login_password'];

// SQLクエリを実行してユーザー情報を取得
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // パスワードが一致するか確認
    if (password_verify($password, $row['password'])) {
        echo "Login successful!";
        // ログイン後の処理 (例: セッションの開始)
        session_start();
        $_SESSION['username'] = $row['username'];
        header('Location: dashboard.php'); // ログイン成功後にダッシュボードにリダイレクト
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "No user found with that email.";
}

$conn->close();
?>
