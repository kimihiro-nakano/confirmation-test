@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header')
<div class="header-login__button">
    <a href="{{ route('register') }}">
        <button class="header-login__button-submit" type="submit">register</button>
    </a>
</div>
@endsection

@section('content')
<div class="login-form__content">
    <div class="login-form__heading">
        <h2>Login</h2>
    </div>
    <form action="{{ route('login') }}" class="login-form" method="post">
        @csrf
        <div class="login-form__group">
            <div class="login-form__group-title">
                <span class="form__label--item">メールアドレスaaaaaa</span>
            </div>
            <div class="login-form__group-content">
                <div class="login-form__input--text">
                    <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" />
                </div>
                @if ($errors->has('email'))
                <div class="login-form__error">
                    {{ $errors->first('email') }}
                </div>
                @endif
            </div>
        </div>
        <div class="login-form__group">
            <div class="login-form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="login-form__group-content">
                <div class="login-form__input--text">
                    <input type="password" name="password" placeholder="例: coachtech1106" />
                </div>
                <div class="login-form__error">
                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="login-form__button">
            <button class="login-form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection
