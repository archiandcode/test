<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\KnifeController;
use App\Http\Controllers\KnifeTypeController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'form'])->name('auth.loginForm');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login');

    Route::get('/register', [RegisterController::class, 'form'])->name('auth.registerForm');
    Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('knife-types', KnifeTypeController::class)->except(['show']);

    Route::resource('knives', KnifeController::class);

    Route::resource('listings', ListingController::class);
    Route::get('/my-listings', [ListingController::class, 'myListings'])->name('listings.my');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{listing}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/delete/{cart}', [CartController::class, 'delete'])->name('cart.delete');
});

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('auth.loginForm');
    }

    $user = Auth::user();

    if ($user->is_admin) {
        return redirect()->route('knife-types.index');
    }

    return redirect()->route('listings.index');
});
