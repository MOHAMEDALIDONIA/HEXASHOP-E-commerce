<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\ConfirmablePasswordController;
use App\Http\Controllers\AdminAuth\EmailVerificationNotificationController;
use App\Http\Controllers\AdminAuth\EmailVerificationPromptController;
use App\Http\Controllers\AdminAuth\NewPasswordController;
use App\Http\Controllers\AdminAuth\PasswordController;
use App\Http\Controllers\AdminAuth\PasswordResetLinkController;
use App\Http\Controllers\AdminAuth\RegisteredUserController;
use App\Http\Controllers\AdminAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create']);

    // Route::post('register', [RegisteredUserController::class, 'store'])->name('admin.register');

    Route::get('login', [AuthenticatedSessionController::class, 'create']);

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('admin.login');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('view.forgot.password');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('send.link');

    Route::get('reset-password/{token}/{email}', [NewPasswordController::class, 'create'])->name('view.reset.password');

    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('store.reset.password');
});

//logout

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.admin');
######################################################################################################

// Route::middleware('auth:admin')->group(function () {
//     Route::get('verify-email', EmailVerificationPromptController::class)
//                 ->name('verification.notice');

//     Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
//                 ->middleware(['signed', 'throttle:6,1'])
//                 ->name('verification.verify');

//     Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//                 ->middleware('throttle:6,1')
//                 ->name('verification.send');

//     Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
//                 ->name('password.confirm');

//     Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

//     Route::put('password', [PasswordController::class, 'update'])->name('password.update');

//     Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.admin');
// });