<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncentiveController;
// Incentive CRUD operations


Route::apiResource('incentives', IncentiveController::class);

// Admin approval
Route::post('incentives/{id}/approve', [IncentiveController::class, 'approve']);

// Pay incentive via M-Pesa
Route::post('incentives/{id}/pay', [IncentiveController::class, 'payIncentive']);

// M-Pesa callback
Route::post('mpesa/callback', [IncentiveController::class, 'mpesaCallback'])->name('mpesa.callback');
