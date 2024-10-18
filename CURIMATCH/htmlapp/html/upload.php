<?php
// セッション開始
session_start();

// データベース接続
$conn = new mysqli('localhost', 'root', '0000', 'curimatch_db');

// 接続エラーチェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ファイルがアップロードされたか確認
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media'])) {
    
    // セッションからユーザーIDを取得
    if (!isset($_SESSION['user_id'])) {
        echo "ログインしていないか、セッションが無効です。";
        exit();
    }

    $user_id = $_SESSION['user_id']; // ユーザーID
    $description = $conn->real_escape_string($_POST['description']); // 説明書きをサニタイズ

    // アップロードされたファイルの情報
    $files = $_FILES['media'];
    $total_files = count($files['name']); // アップロードされたファイルの総数

    $upload_success = true; // アップロード成功フラグ

    for ($i = 0; $i < $total_files; $i++) {
        // 各ファイルの情報を取得
        $file_name = basename($files['name'][$i]); // ファイル名
        $target_dir = "uploads/"; // アップロード先のディレクトリ
        $target_file = $target_dir . uniqid() . "_" . $file_name; // 一意のファイル名を生成

        // ファイルのアップロード処理
        if (move_uploaded_file($files['tmp_name'][$i], $target_file)) {
            // データベースにファイル情報を保存
            $sql = "INSERT INTO uploads (user_id, media_url, description) VALUES ('$user_id', '$target_file', '$description')";
            if ($conn->query($sql) === TRUE) {
                echo "ファイルのアップロードに成功しました: " . $file_name . "<br>";
            } else {
                echo "エラー: " . $conn->error . "<br>";
                $upload_success = false; // アップロードが失敗した
            }
        } else {
            echo "ファイルのアップロードに失敗しました: " . $file_name . "<br>";
            echo "エラーコード: " . $files['error'][$i]; // エラーコードを表示
            $upload_success = false; // アップロードが失敗した
        }
    }

    // すべてのファイルのアップロードが成功した場合にリダイレクト
    if ($upload_success) {
        header("Location: main.php");
        exit(); // スクリプトを終了
    }
} else {
    echo "ファイルが選択されていません。";
}

// データベース接続を閉じる
$conn->close();
?>
