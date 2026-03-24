<?php

use App\Http\Controllers\Admin\SouldevDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\CustomPasswordResetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', [HomeController::class, 'index'])->name('frontend.index');

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('frontend.index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/souldev', [SouldevDashboardController::class, 'index'])->name('admin.souldev');
});

Route::middleware('guest')->group(function () {
    Route::get('/password/forgot-password', [CustomPasswordResetController::class, 'showForgotPasswordForm'])
        ->name('password.custom.forgot');
    Route::post('/password/forgot-password/send-otp', [CustomPasswordResetController::class, 'sendOtp'])
        ->name('password.custom.send-otp');
    Route::post('/password/forgot-password/verify-otp', [CustomPasswordResetController::class, 'verifyOtp'])
        ->name('password.custom.verify-otp');
    Route::get('/password/reset-password', [CustomPasswordResetController::class, 'showResetPasswordForm'])
        ->name('password.custom.reset-form');
    Route::post('/password/reset-password', [CustomPasswordResetController::class, 'resetPassword'])
        ->name('password.custom.reset');
});
