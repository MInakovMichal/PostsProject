<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Common\Auth\Infrastructure\Http\Controllers\LoginController;
use Common\Auth\Infrastructure\Http\Controllers\RegisterController;
use Common\Auth\Infrastructure\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    Route::post('register', [RegisterController::class, 'register']);

    Route::get('login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('login', [LoginController::class, 'login']);
});

Route::get('verify-email2/{id}/{hash}', [VerificationController::class, 'verifyUserEmail'])
    ->middleware(['throttle:6,1'])
    ->name('verification.verify');

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [VerificationController::class, 'displayEmailNotVerifiedMessage'])
        ->name('verification.notice');

//    Route::get('verify-email2/{id}/{hash}', [VerificationController::class, 'verifyUserEmail'])
//        ->middleware(['signed', 'throttle:6,1'])
//        ->name('verification.verify');

    Route::post('email/verification-notification', [VerificationController::class, 'resendVerificationEmail'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('logout', [LoginController::class, 'logout'])
        ->name('logout');
});
