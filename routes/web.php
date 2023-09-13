<?php

use App\Http\Controllers\User\AchievementController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/contact-with-me', 'contact_with_me')->name('send_contact_with_me');
});

Route::controller(AchievementController::class)->group(function () {
    Route::get('/achievements', 'index')->name('achievements');
});
