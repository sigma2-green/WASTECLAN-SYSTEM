<?php
use App\Http\Controllers\Authenticator;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');

// 🟩 Sign-up routes
Route::get('/sign-up', [Authenticator::class, 'showSignupForm'])->name('sign-up.form');
Route::post('/sign-up', [Authenticator::class, 'processSignup'])->name('sign-up.post');

// 🟨 Login routes
Route::get('/login', [Authenticator::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [Authenticator::class, 'login'])->name('login.post');

// 🟥 Logout
Route::post('/logout', [Authenticator::class, 'logout'])->name('logout');

// 🟦 Dashboard (protected)
Route::get('/dashboard', function () {
    return view('3.dashboard');
})->middleware('auth')->name('dashboard');


