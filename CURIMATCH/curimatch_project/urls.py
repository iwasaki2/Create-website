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
from django.urls import path
from .views import index, about, company, futures, information, login, service, signup, upload

urlpatterns = [
    path('', index, name='index'),
    path('about/', about, name='about'),
    path('company/', company, name='company'),
    path('futures/', futures, name='futures'),
    path('information/', information, name='information'),
    path('login/', login, name='login'),
    path('service/', service, name='service'),
    path('signup/', signup, name='signup'),
    path('upload/', upload, name='upload'),
]