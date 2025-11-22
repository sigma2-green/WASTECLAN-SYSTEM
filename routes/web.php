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
Route::get('/', fn() => view('welcome'))->name('home');

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
// Dashboards by role
// ----------------------------
Route::middleware('auth')->group(function () {

    // Resident dashboard
    Route::get('/dashboard', function () {
        if (auth()->user()->role !== 'resident') abort(403, 'Unauthorized');
        return view('3.dashboard');
    })->name('resident.dashboard');

    // Collector dashboard
    Route::get('/collector', function () {
        if (auth()->user()->role !== 'collector') abort(403, 'Unauthorized');
        return view('3.collector');
    })->name('collector.dashboard');

    Route::get('/collectors/routes', function () {
        if (auth()->user()->role !== 'collector') abort(403);
        return view('collectors.routes');
    })->name('routes');

    Route::get('/collectors/bin', function () {
        if (auth()->user()->role !== 'collector') abort(403);
        return view('collectors.bin');
    })->name('bins');

    Route::get('/collectors/safety-reports', function () {
        if (auth()->user()->role !== 'collector') abort(403);
        return view('collector.safety_reports');
    })->name('safety_reports');

    Route::resource('safety-reports', SafetyReportController::class);

    // Admin dashboard
    Route::get('/admin', function () {
        if (auth()->user()->role !== 'admin') abort(403, 'Unauthorized');
        return view('3.admin');
    })->name('admin.dashboard');

    Route::get('/admin/analytics', function () {
        if (auth()->user()->role !== 'admin') abort(403);
        return view('admin.analytics');
    })->name('analytics');

    Route::get('/admin/manage_collection', function () {
        if (auth()->user()->role !== 'admin') abort(403);
        return view('admin.manage_collection');
    })->name('manage_collection');

    Route::get('/admin/report_management', function () {
        if (auth()->user()->role !== 'admin') abort(403);
        return view('admin.report_management');
    })->name('report_management');

    // ----------------------------
    // Profile routes (universal)
    // ----------------------------
    Route::get('/profile', [Authenticator::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [Authenticator::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/update', [Authenticator::class, 'updateProfile'])->name('profile.update');

    // ----------------------------
    // Resident-specific routes
    // ----------------------------
    Route::get('/collect', function () {
        if (auth()->user()->role !== 'resident') abort(403);
        return view('residents.collect');
    })->name('collect');

    Route::get('/issues', function () {
        if (auth()->user()->role !== 'resident') abort(403);
        return view('residents.issues');
    })->name('issues');

    Route::resource('residents', ResidentController::class);
    Route::resource('bins', BinController::class);
    Route::resource('pickups', PickupController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('sortings', SortingController::class);
    Route::resource('incentives', IncentiveController::class);

    Route::get('/settings', [ResidentController::class, 'settings'])->name('settings');
    Route::delete('/account/delete', [ResidentController::class, 'destroyAccount'])->name('account.destroy');

    // ----------------------------
    // Other resource routes (all auth-protected)
    // ----------------------------
    Route::resource('collectors', CollectorController::class);
    Route::resource('routes', RouteController::class);
    Route::resource('route-stops', RouteStopController::class);
    Route::resource('incentive-transactions', incentive_transactions::class);
});

// ----------------------------
// Static pages (public)
// ----------------------------
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
