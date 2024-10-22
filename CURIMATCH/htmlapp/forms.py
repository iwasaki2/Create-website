from django import forms
from .models import User
from django.contrib.auth.hashers import make_password  # パスワードのハッシュ化に利用

class SignUpForm(forms.ModelForm):
    password = forms.CharField(widget=forms.PasswordInput())
    role = forms.ChoiceField(choices=User.ROLE_CHOICES)

    class Meta:
        model = User
        fields = ['username', 'email', 'password', 'role']

    def save(self, commit=True):
        user = super().save(commit=False)
        user.password = make_password(self.cleaned_data['password'])  # パスワードのハッシュ化
        if commit:
            user.save()
        return user
