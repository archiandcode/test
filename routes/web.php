<?php

use App\Http\Controllers\KnifeController;
use App\Http\Controllers\KnifeTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'form'])->name('auth.loginForm');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login');

    Route::get('/register', [RegisterController::class, 'form'])->name('auth.registerForm');
    Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('knife-types', KnifeTypeController::class)->except(['show']);

    Route::resource('knives', KnifeController::class);
});
