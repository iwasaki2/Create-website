document.getElementById('file-upload').addEventListener('change', function(event) {
    const file = event.target.files[0]; // アップロードされたファイルを取得
    const preview = document.getElementById('preview'); // プレビュー表示エリア
    preview.innerHTML = ''; // プレビューエリアをクリア

    if (file) {
        const reader = new FileReader();
        
        // ファイルの種類に応じてプレビューを表示
        reader.onload = function(e) {
            const url = e.target.result;
            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = url;
                img.style.maxWidth = '100%'; // プレビュー画像のサイズを調整
                preview.appendChild(img);
            } else if (file.type.startsWith('video/')) {
                const video = document.createElement('video');
                video.src = url;
                video.controls = true;
                preview.appendChild(video);
            }
        };
        
        reader.readAsDataURL(file); // ファイルを読み込み、プレビューに表示
    }
});
