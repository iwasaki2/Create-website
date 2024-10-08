<?php
// データベースの接続情報
$dbname = "curimatch_db.sqlite"; // SQLiteデータベースファイル名

// データベースに接続
try {
    $conn = new PDO("sqlite:$dbname");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage();
}

// フォームから送信されたデータを取得
$user = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];

// 既存ユーザーを確認
$sql_check = "SELECT * FROM users WHERE email=:email";
$stmt = $conn->prepare($sql_check);
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    // すでにユーザーが存在する場合、ログインページにリダイレクト
    header('Location: login.html');
    exit();
} else {
    // パスワードをハッシュ化
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // 新しいユーザーを挿入
    $sql_insert = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    if ($stmt->execute()) {
        // 登録成功時に登録完了ページへリダイレクト
        header('Location: login.html');
        exit();
    } else {
        echo "エラー: " . $sql_insert;
    }
}

// 接続を閉じる
$conn = null;
?>
