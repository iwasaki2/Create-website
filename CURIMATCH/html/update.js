// 1枚までのファイルアップロード制限
document.getElementById('file-upload').addEventListener('change', function(event) {
    const files = event.target.files;

    // ファイルが1つを超えているかを確認
    if (files.length > 1) {
        alert("動画や写真は1枚のみアップロードできます。");
        event.target.value = ""; // ファイル選択をリセット
    } else {
        updatePreview(event.target, 'preview');
    }
});

// 各セクションに対して最大3つまでのファイルアップロード制限
function addFileUploadLimit(sectionId) {
    document.getElementById(sectionId).addEventListener('change', function(event) {
        const files = event.target.files;

        // ファイルが3つを超えているかを確認
        if (files.length > 3) {
            alert("このセクションでは最大3枚までのファイルをアップロードできます。");
            event.target.value = ""; // ファイル選択をリセット
        } else {
            updatePreview(event.target, 'preview');
        }
    });
}

function updatePreview(inputElement, previewId) {
    const preview = document.getElementById(previewId);
    preview.innerHTML = ''; // 既存のプレビューをクリア
    preview.style.display = 'flex'; // プレビューを表示

    const files = inputElement.files;

    Array.from(files).forEach(file => {
        const reader = new FileReader();

        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'preview-item'; // プレビューアイテムのクラス名を設定

            const media = document.createElement(file.type.startsWith('image/') ? 'img' : 'video');
            media.src = e.target.result;
            media.controls = true; // 動画にコントロールを追加
            div.appendChild(media);

            // 削除ボタンを作成
            const span = document.createElement('span');
            span.textContent = '×';
            span.onclick = function() {
                div.remove(); // 削除ボタンがクリックされたら要素を削除
                if (preview.children.length === 0) {
                    preview.style.display = 'none'; // プレビューが空なら非表示
                }
            };
            div.appendChild(span);

            preview.appendChild(div);
        };

        reader.readAsDataURL(file); // ファイルを読み込む
    });
}

// 制作予定の内容など各セクションに対して制限を適用
addFileUploadLimit('content-file');
addFileUploadLimit('schedule-file');
addFileUploadLimit('funding-file');
addFileUploadLimit('rewards-file');
addFileUploadLimit('achievements-file');
addFileUploadLimit('portfolio-file');
