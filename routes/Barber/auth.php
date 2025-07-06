<?php

use App\Http\Controllers\Barber\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Barber\ProfileController;
use App\Http\Controllers\Barber\Auth\PasswordController;
use App\Http\Controllers\Barber\Auth\NewPasswordController;
use App\Http\Controllers\Barber\Auth\PasswordResetLinkController;

use App\Http\Controllers\Barber\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Barber\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Barber\Auth\VerifyEmailController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest:barber')->prefix('barber')->name('barber.')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth:barber')->prefix('barber')->name('barber.')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['auth:barber', 'signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
     // Rutas protegidas con correo verificado
    Route::middleware('barber.verified')->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\Barber\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        
    });
});

