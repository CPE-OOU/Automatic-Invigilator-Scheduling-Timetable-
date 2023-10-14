<?php

use App\Http\Controllers\Admin\ClearCacheController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Settings;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/home.php';
require __DIR__ . '/admin.php';
// require __DIR__ . '/user.php';
// require __DIR__ . '/botman.php';



// Auth::routes();

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');

