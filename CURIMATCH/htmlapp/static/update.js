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
            updatePreview(event.target, sectionId + '-preview');
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
            const previewContainer = document.createElement('div');
            previewContainer.className = 'preview-item'; // プレビューアイテムのクラス名を設定
            previewContainer.style.position = 'relative';
            previewContainer.style.width = '100px'; // プレビューアイテムのサイズ
            previewContainer.style.height = '100px';

            const media = document.createElement(file.type.startsWith('image/') ? 'img' : 'video');
            media.src = e.target.result;
            media.style.width = '100%';
            media.style.height = '100%';
            if (file.type.startsWith('video/')) {
                media.controls = true; // 動画にコントロールを追加
            }

            const removeBtn = document.createElement('span');
            removeBtn.textContent = '×'; // ×マーク
            removeBtn.style.position = 'absolute';
            removeBtn.style.top = '0';
            removeBtn.style.right = '0';
            removeBtn.style.cursor = 'pointer';
            removeBtn.style.background = 'rgba(255, 0, 0, 0.7)';
            removeBtn.style.color = 'white';
            removeBtn.style.padding = '5px';
            removeBtn.style.borderRadius = '50%';

            // 削除ボタンがクリックされた時の処理
            removeBtn.addEventListener('click', function() {
                preview.removeChild(previewContainer); // プレビューから削除
                inputElement.value = ''; // ファイル選択をリセット
            });

            previewContainer.appendChild(media); // メディアをコンテナに追加
            previewContainer.appendChild(removeBtn); // コンテナに削除ボタンを追加
            preview.appendChild(previewContainer); // プレビューエリアにコンテナを追加
        };

        reader.readAsDataURL(file); // ファイルを読み込み、プレビューに表示
    });
}

// 各セクションに対して制限を適用
addFileUploadLimit('content-file');
addFileUploadLimit('schedule-file');
addFileUploadLimit('funding-file');
addFileUploadLimit('rewards-file');
addFileUploadLimit('achievements-file');
addFileUploadLimit('portfolio-file');
