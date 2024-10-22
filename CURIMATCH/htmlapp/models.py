from django.db import models

# ユーザーモデル (users テーブル)
class User(models.Model):
    ROLE_CHOICES = [
        ('creator', 'クリエイター'),
        ('sponsor', 'スポンサー'),
    ]

    username = models.CharField(max_length=50)
    email = models.EmailField(max_length=100, unique=True)
    password = models.CharField(max_length=255)
    role = models.CharField(max_length=10, choices=ROLE_CHOICES, default='creator')
    created_at = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return self.username

# アップロードモデル (uploads テーブル)
class Upload(models.Model):
    user = models.ForeignKey(User, on_delete=models.CASCADE)  # usersテーブルとのリレーション
    media_url = models.CharField(max_length=255)
    description = models.TextField()
    created_at = models.DateTimeField(auto_now_add=True)

    def __str__(self):
        return self.description
