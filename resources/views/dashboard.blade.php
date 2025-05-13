@extends('adminlte::page')

@section('title', 'Панель')

@section('content')
    <h2>Добро пожаловать, {{ Auth::user()->name }}!</h2>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Выйти</button>
    </form>
@endsection
