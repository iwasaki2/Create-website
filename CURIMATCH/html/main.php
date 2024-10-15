<?php
// データベース接続
$conn = new mysqli('localhost', 'root', '0000', 'curimatch_db');

// 接続エラーチェック
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// アップロードデータを取得するSQLクエリ
$sql = "SELECT * FROM uploads ORDER BY created_at DESC"; // 新しい投稿が上に来るように
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿された制作物</title>
    <link rel="stylesheet" href="main.css"> <!-- CSSファイルをリンク -->
</head>
<body>
    <h1>投稿された制作物</h1>

    <div class="uploads-container">
        <?php
        if ($result->num_rows > 0) {
            // 各投稿を表示
            while ($row = $result->fetch_assoc()) {
                echo "<div class='upload-item'>";
                echo "<h2>" . htmlspecialchars($row['description']) . "</h2>";
                
                // メディアが動画か画像かで表示方法を変更
                if (strpos($row['media_url'], '.mp4') !== false || strpos($row['media_url'], '.webm') !== false) {
                    echo "<video controls width='400'>";
                    echo "<source src='" . htmlspecialchars($row['media_url']) . "' type='video/mp4'>";
                    echo "お使いのブラウザは動画をサポートしていません。";
                    echo "</video>";
                } else {
                    echo "<img src='" . htmlspecialchars($row['media_url']) . "' alt='Uploaded Image' width='400'>";
                }
                
                echo "</div>";
            }
        } else {
            echo "<p>投稿はまだありません。</p>";
        }
        ?>
    </div>

    <a href="upload.html">新しい投稿をする</a>

</body>
</html>

<?php
// データベース接続を閉じる
$conn->close();
?>
