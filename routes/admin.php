<?php

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('adminlogin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('adminloginform')->middleware('adminguest');
    Route::post('login', [LoginController::class, 'adminlogin'])->name('adminlogin');
    Route::post('logout', [LoginController::class, 'adminlogout'])->name('adminlogout');
    Route::get('dashboard', [LoginController::class, 'validate_admin'])->name('validate_admin');
});

// Two Factor controller for Admin.
Route::get('admin/2fa', [TwoFactorController::class, 'showTwoFactorForm'])->name('2fa');
Route::post('admin/twofa', [TwoFactorController::class, 'verifyTwoFactor'])->name('twofalogin');
Route::get('admin/forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('admin.forgetpassword');
Route::post('admin/send-request', [ForgotPasswordController::class, 'sendPasswordRequest'])->name('sendpasswordrequest');
Route::get('/admin/reset-password/{email}', [ForgotPasswordController::class, 'resetPassword'])->name('resetview');
Route::post('/reset-password-admin', [ForgotPasswordController::class, 'validateResetPasswordToken'])->name('restpass');

// Everything About Admin Route ends here
