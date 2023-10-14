<?php

use App\Http\Controllers\AutoTaskController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;



//cron url
Route::get('/cron', [AutoTaskController::class, 'autotopup'])->name('cron');
//Front Pages Route
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('terms', [HomePageController::class, 'terms'])->name('terms');
Route::get('privacy', [HomePageController::class, 'privacy'])->name('privacy');
Route::get('about', [HomePageController::class, 'about'])->name('about');
Route::get('contact', [HomePageController::class, 'contact'])->name('contact');
Route::get('service', [HomePageController::class, 'service'])->name('service');
Route::get('faq', [HomePageController::class, 'faq'])->name('faq');