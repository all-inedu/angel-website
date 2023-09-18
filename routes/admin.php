<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AwardAchievementController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ContactWithMeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SpeakingOpportunitiesController;

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin'])->group(function(){
        Route::view('/login', 'auth.login')->name('login');
        Route::post('/login_handler', [AdminController::class, 'loginHandler'])->name('login_handler');
    });

    Route::middleware(['auth:admin'])->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout_handler', [AdminController::class, 'logoutHandler'])->name('logout_handler');

        // Projects
        Route::controller(ProjectsController::class)->group(function () {
            Route::get('/projects', 'index')->name('projects');
            Route::get('/projects/data', 'getProjects')->name('data_projects');
            Route::get('/projects/create', 'create')->name('create_projects');
            Route::post('/projects/store', 'store')->name('store_projects');
            Route::get('/projects/{id}/edit', 'edit')->name('edit_projects');
            Route::post('/projects/{id}/update', 'update')->name('update_projects');
            Route::post('/projects/delete/{id}', 'delete')->name('delete_projects');
            Route::post('/projects/highlight/{id}', 'set_highlight')->name('highlight_projects');
        });

        // Award & Achievement
        Route::controller(AwardAchievementController::class)->group(function () {
            Route::get('/award-achievement', 'index')->name('award_achievement');
            Route::get('/award-achievement/data', 'getAwardAchievement')->name('data_award_achievement');
            Route::get('/award-achievement/create', 'create')->name('create_award_achievement');
            Route::post('/award-achievement/store', 'store')->name('store_award_achievement');
            Route::get('/award-achievement/{id}/edit', 'edit')->name('edit_award_achievement');
            Route::post('/award-achievement/{id}/update', 'update')->name('update_award_achievement');
            Route::post('/award-achievement/delete/{id}', 'delete')->name('delete_award_achievement');
        });

        // Speaking Opportunities
        Route::controller(SpeakingOpportunitiesController::class)->group(function () {
            Route::get('/speaking-opportunities', 'index')->name('speaking_opportunities');
            Route::get('/speaking-opportunities/data', 'getSpeakingOpportunities')->name('data_speaking_opportunities');
            Route::get('/speaking-opportunities/create', 'create')->name('create_speaking_opportunities');
            Route::post('/speaking-opportunities/store', 'store')->name('store_speaking_opportunities');
            Route::get('/speaking-opportunities/{id}/edit', 'edit')->name('edit_speaking_opportunities');
            Route::post('/speaking-opportunities/{id}/update', 'update')->name('update_speaking_opportunities');
            Route::post('/speaking-opportunities/delete/{id}', 'delete')->name('delete_speaking_opportunities');
            Route::post('/speaking-opportunities/highlight/{id}', 'set_highlight')->name('highlight_speaking_opportunities');
        });

        // Contact With Me
        Route::controller(ContactWithMeController::class)->group(function () {
            Route::get('/contact-with-me', 'index')->name('contact_with_me');
            Route::get('/contact-with-me/data', 'getContactWithMe')->name('data_contact_with_me');
        });

        // Change Password
        Route::controller(ChangePasswordController::class)->group(function () {
            Route::post('/change-password', 'store')->name('store_change_password');
        });
    });
});