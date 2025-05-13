@extends('adminlte::auth.register')

@section('auth_header', 'Регистрация')

@section('auth_body')
    <form action="{{ route('auth.register') }}" method="POST">
        @csrf

        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Имя" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-user"></span></div>
            </div>
        </div>
        @error('name')
        <div class="text-danger small">{{ $message }}</div>
        @enderror

        <div class="input-group mt-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
            </div>
        </div>
        @error('email')
        <div class="text-danger small">{{ $message }}</div>
        @enderror

        <div class="input-group mt-3">
            <input type="password" name="password" class="form-control" placeholder="Пароль" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>
        @error('password')
        <div class="text-danger small">{{ $message }}</div>
        @enderror


        <div class="input-group mb-3 mt-3">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Подтвердите пароль" required>
            <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
    </form>
@endsection

@section('auth_footer')
    <p class="my-0">
        <a href="{{ route('auth.loginForm') }}">Уже есть аккаунт?</a>
    </p>
@endsection
