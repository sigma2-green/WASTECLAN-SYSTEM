<?php

use App\Http\Controllers\Authenticator;
use App\Http\Controllers\BinController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\incentive_transactions;
use App\Http\Controllers\IncentiveController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RouteStopController;
use App\Http\Controllers\SafetyReportController;
use App\Http\Controllers\SortingController;
use Illuminate\Support\Facades\Route;

// ----------------------------
// Home
// ----------------------------
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ----------------------------
// Sign-up routes
// ----------------------------
Route::get('/sign-up', [Authenticator::class, 'showSignupForm'])->name('sign-up.form');
Route::post('/sign-up', [Authenticator::class, 'processSignup'])->name('sign-up.post');

// ----------------------------
// Login routes
// ----------------------------
Route::get('/login', [Authenticator::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [Authenticator::class, 'login'])->name('login.post');

// ----------------------------
// Logout
// ----------------------------
Route::post('/logout', [Authenticator::class, 'logout'])->name('logout');

// ----------------------------
// Dashboard (protected)
// ----------------------------
Route::get('/dashboard', function () {
    return view('3.dashboard');
})->middleware('auth')->name('dashboard');

// ----------------------------
// Profile routes (universal for all users)
// ----------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [Authenticator::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [Authenticator::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [Authenticator::class, 'updateProfile'])->name('profile.update');
});

// ----------------------------
// Resident dashboard routes
// ----------------------------
Route::middleware('auth')->group(function () {
    Route::view('/collect', 'residents.collect')->name('collect');
    Route::view('/issues', 'residents.issues')->name('issues');

    // Resource routes
    Route::resource('residents', ResidentController::class);
    Route::resource('bins', BinController::class);
    Route::resource('pickups', PickupController::class);
    Route::resource('reports', ReportController::class);

    // Sorting routes
    Route::resource('sortings', SortingController::class);

    // Incentives
    Route::resource('incentives', IncentiveController::class);
});

// ----------------------------
// Collector dashboard routes
// ----------------------------
Route::middleware(['auth', 'role:collector'])->group(function () {
    Route::get('/collector', fn() => view('3.collector'))->name('collector.dashboard');
    Route::get('/collectors/routes', fn() => view('collectors.routes'))->name('routes');
    Route::get('/collectors/bin', fn() => view('collectors.bin'))->name('bins');
    Route::get('/collectors/safety-reports', fn() => view('collector.safety_reports'))->name('safety_reports');

    Route::resource('safety-reports', SafetyReportController::class);
});

// ----------------------------
// Admin dashboard routes
// ----------------------------
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', fn() => view('3.admin'))->name('admin');
    Route::get('/admin/analytics', fn() => view('admin.analytics'))->name('analytics');
    Route::get('/admin/manage_collection', fn() => view('admin.manage_collection'))->name('manage_collection');
    Route::get('/admin/report_management', fn() => view('admin.report_management'))->name('report_management');
});

// ----------------------------
// Other resource routes
// ----------------------------
Route::resource('collectors', CollectorController::class);
Route::resource('routes', RouteController::class);
Route::resource('route-stops', RouteStopController::class);
Route::resource('incentive-transactions', incentive_transactions::class);

Route::get('/profile/edit', [Authenticator::class, 'editProfile'])->name('profile.edit');


//STATIC PAGES 
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Settings page for logged-in resident
Route::middleware('auth')->group(function () {
    Route::get('/settings', [ResidentController::class, 'settings'])->name('settings');
    Route::delete('/account/delete', [ResidentController::class, 'destroyAccount'])->name('account.destroy');
});






