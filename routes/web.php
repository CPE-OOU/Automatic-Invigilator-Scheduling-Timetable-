<?php

use App\Http\Controllers\Admin\ClearCacheController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Settings;
use App\Models\Course;
use App\Http\Controllers\FacultyController;
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
// require __DIR__ . '/admin.php';




// Auth::routes();


Route::middleware(['auth'])->group(function () {
  Route::post('/generatetimetable', [FacultyController::class, 'generateTimetable'])->name('generate.timetable');

  // Route::post('/generate', [FacultyController::class, 'GenerateTimetable'])->name('build');
  Route::get('/generate-timetable', [FacultyController::class, 'generateTimetable'])->name('timetable.generate');
Route::get('/timetable-preview/{filename}', [FacultyController::class, 'timetablePreview'])->name('timetable.preview');

Route::get('/timetable-download', [FacultyController::class, 'downloadTimetable'])->name('timetable.download');

Route::get('/timetable-preview', [FacultyController::class, 'timetablePreview'])->name('timetable.preview');
});

Route::get('/timetable-generated', function () {
  return view('timetable-generated');
})->name('timetable.generated');

Route::get('/test', function(){
  $course = Course::find(1);
  dd($course->lecturers);
  });

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.post');

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

    // Timetable Routes
    Route::resource('timetable', FacultyController::class);

});


Route::post('/courses', [CourseController::class, 'save'])->name('courses.save');
