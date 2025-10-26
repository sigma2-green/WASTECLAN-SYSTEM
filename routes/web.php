<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authenticator; // ✅ Add this line

Route::get('/', function () {
    return view('welcome');
});

// 🔹 Sign-up routes
Route::get('/sign-up', [Authenticator::class, 'showSignupForm'])->name('sign-up.form');
Route::post('/sign-up', [Authenticator::class, 'processSignup'])->name('sign-up.post');

// 🔹 Login routes
Route::get('/login', [Authenticator::class, 'showLoginForm'])->name('login');
Route::post('/login', [Authenticator::class, 'login'])->name('login.post');

