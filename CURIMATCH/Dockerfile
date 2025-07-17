# ベースイメージとして Python 3.8 を使用
FROM python:3.8

# 作業ディレクトリを設定
WORKDIR /app

# 依存関係ファイルをコピー
COPY requirements.txt .

# 依存関係をインストール
RUN pip install --no-cache-dir -r requirements.txt

# プロジェクトの全ファイルをコピー
COPY . .

# ポート 8000 を公開
EXPOSE 8000

# サーバーを起動
CMD ["python", "manage.py", "runserver", "0.0.0.0:8000"]

