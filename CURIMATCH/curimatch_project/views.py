from django.shortcuts import render

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
    return render(request, 'htmlapp/login.html')

def service(request):
    return render(request, 'htmlapp/service.html')

def signup(request):
    return render(request, 'htmlapp/signup.html')

def upload(request):
    return render(request, 'htmlapp/upload.html')
