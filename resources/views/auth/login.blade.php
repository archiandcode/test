@extends('adminlte::auth.login')

@section('auth_header', 'Вход в систему')

@section('auth_body')
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf

        <div class="input-group mt-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
            </div>
        </div>
        @error('email')
        <div class="text-danger small">{{ $message }}</div>
        @enderror

        <div class="input-group mt-3 mb-3">
            <input type="password" name="password" class="form-control" placeholder="Пароль" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>
        @error('password')
        <div class="text-danger small">{{ $message }}</div>
        @enderror


        <button type="submit" class="btn btn-primary btn-block">Войти</button>
    </form>
@endsection

@section('auth_footer')
    <p class="my-0">
        <a href="{{ route('auth.registerForm') }}">Регистрация нового аккаунта</a>
    </p>
@endsection
