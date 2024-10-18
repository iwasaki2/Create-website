"""
URL configuration for curimatch_project project.

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/5.1/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.contrib import admin
from django.urls import path
from htmlapp.views import index, about, company, futures, information, login, service, signup, upload  # 必要なビューをインポート

urlpatterns = [
    path('admin/', admin.site.urls),  # 管理サイトのURL
    path('', index, name='index'),  # トップページのURL
    path('about/', about, name='about'),  # AboutページのURL
    path('company/', company, name='company'),  # CompanyページのURL
    path('futures/', futures, name='futures'),  # FuturesページのURL
    path('information/', information, name='information'),  # InformationページのURL
    path('login/', login, name='login'),  # LoginページのURL
    path('service/', service, name='service'),  # ServiceページのURL
    path('signup/', signup, name='signup'),  # SignupページのURL
    path('upload/', upload, name='upload'),  # UploadページのURL
]
