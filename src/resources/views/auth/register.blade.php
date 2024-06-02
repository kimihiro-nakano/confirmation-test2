@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header')
<div class="header-login__button">
    <a href="{{ route('login') }}">
        <button class="header-login__button-submit" type="button">login</button>
    </a>
</div>
@endsection

@section('content')
<div class="register-form__content">
    <div class="register-form__heading">
        <h2>Register</h2>
    </div>
    <form action="{{ route('register') }}" class="register-form" method="post">
        @csrf
        <div class="register-form__group">
            <div class="register-form__group-title">
                <span class="form__label--item">お名前</span>
            </div>
            <div class="register-form__group-content">
                <div class="register-form__input--text">
                    <input type="text" name="name" placeholder="例: 山田  太郎" value="{{ old('name') }}" />
                </div>
                <div class="register-form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="register-form__group">
            <div class="register-form__group-title">
                <span class="form__label--item">メールアドレス</span>
            </div>
            <div class="register-form__group-content">
                <div class="register-form__input--text">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
                </div>
                @if ($errors->has('email'))
                <div class="register-form__error">
                    {{ $errors->first('email') }}
                </div>
                @endif
            </div>
        </div>
        <div class="register-form__group">
            <div class="register-form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="register-form__group-content">
                <div class="register-form__input--text">
                    <input type="password" name="password" placeholder="例: coachtech1106" />
                </div>
                <div class="register-form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="register-form__button">
            <button class="register-form__button-submit" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection