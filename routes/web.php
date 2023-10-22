<?php

use App\Http\Controllers\Admin\ClearCacheController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Settings;
use App\Http\Controllers\LecturerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExaminationVenueController;

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
Route::post('/register', [RegisterController::class, 'postRegistration'])->name('register.post');

Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('post-login', [LoginController::class, 'postLogin'])->name('login.post'); 
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => 'auth'], function () {

  // Lecturer Routes
  Route::resource('lecturers', LecturerController::class);

  // Course Routes
  Route::resource('courses', CourseController::class);

  // Department Routes
  Route::resource('departments', DepartmentController::class);

  // Examination Venue Routes
  Route::resource('venues', ExaminationVenueController::class);

});
