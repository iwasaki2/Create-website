from django.shortcuts import render, redirect
from django.contrib.auth import authenticate, login as auth_login
from django.contrib import messages
from .forms import SignUpForm

# 各種ページ表示ビュー
def index(request):
    return render(request, 'htmlapp/index.html')

def about(request):
    return render(request, 'htmlapp/about.html')

def company(request):
    return render(request, 'htmlapp/company.html')

def futures(request):
    return render(request, 'htmlapp/futures.html')

def information(request):
    return render(request, 'htmlapp/information.html')

def service(request):
    return render(request, 'htmlapp/service.html')

def upload(request):
    return render(request, 'htmlapp/upload.html')

# ユーザー認証関連
def login(request):
    if request.method == "POST":
        login_email = request.POST['login_email']
        login_password = request.POST['login_password']
        user = authenticate(request, username=login_email, password=login_password)

        if user is not None:
            auth_login(request, user)
            return redirect('upload')
        else:
            messages.error(request, "メールアドレスまたはパスワードが間違っています")
    
    return render(request, 'htmlapp/login.html')

# 新規登録処理
def signup(request):  # 関数名をsignupに変更
    if request.method == 'POST':
        form = SignUpForm(request.POST)
        if form.is_valid():
            form.save()
            return redirect('login')  # 登録成功後、ログインページにリダイレクト
    else:
        form = SignUpForm()

    return render(request, 'htmlapp/signup.html', {'form': form})