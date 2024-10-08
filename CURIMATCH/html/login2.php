<?php
// SQLiteデータベース接続
$dbFile = 'curimatch_db.sqlite'; // SQLiteデータベースファイル
$conn = new PDO("sqlite:$dbFile");

// 接続エラーチェック
if (!$conn) {
    die("Connection failed: " . $conn->errorInfo()[2]);
}

// フォームからのデータを取得
$email = $_POST['login_email'];
$password = $_POST['login_password'];

// SQLクエリを実行してユーザー情報を取得
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // パスワードが一致するか確認
    if (password_verify($password, $row['password'])) {
        echo "Login successful!";
        // ログイン後の処理 (例: セッションの開始)
        session_start();
        $_SESSION['username'] = $row['username'];
        header('Location: futures.html'); // ログイン成功後にダッシュボードにリダイレクト
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "No user found with that email.";
}

// 接続を閉じる
$conn = null;
?>
