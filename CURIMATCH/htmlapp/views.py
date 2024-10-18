from django.shortcuts import render, redirect
from django.contrib.auth import authenticate, login as auth_login
from django.contrib import messages

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

def login(request):
    if request.method == "POST":
        login_email = request.POST['login_email']
        login_password = request.POST['login_password']

        # ユーザーを認証する
        user = authenticate(request, username=login_email, password=login_password)

        if user is not None:
            # 認証に成功した場合、ユーザーをログインさせる
            auth_login(request, user)  # 組み込みlogin関数の別名を使用
            return redirect('upload')  # 成功後にリダイレクト
        else:
            messages.error(request, "メールアドレスまたはパスワードが間違っています")

    return render(request, 'htmlapp/login.html')  # GETリクエスト時にはログインページを表示

def service(request):
    return render(request, 'htmlapp/service.html')

def signup(request):
    return render(request, 'htmlapp/signup.html')

def upload(request):
    return render(request, 'htmlapp/upload.html')
