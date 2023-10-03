<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AwardAchievementController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ContactWithMeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OtherActivitiesController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\SpeakingOpportunitiesController;
use App\Http\Controllers\VideosController;

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

        // Other Activities
        Route::controller(OtherActivitiesController::class)->group(function () {
            Route::get('/other-activities', 'index')->name('other_activities');
            Route::get('/other-activities/data', 'getOtherActivities')->name('data_other_activities');
            Route::get('/other-activities/create', 'create')->name('create_other_activities');
            Route::post('/other-activities/store', 'store')->name('store_other_activities');
            Route::get('/other-activities/{id}/edit', 'edit')->name('edit_other_activities');
            Route::post('/other-activities/{id}/update', 'update')->name('update_other_activities');
            Route::post('/other-activities/delete/{id}', 'delete')->name('delete_other_activities');
            Route::post('/other-activities/highlight/{id}', 'set_highlight')->name('highlight_other_activities');
        });

        // Videos
        Route::controller(VideosController::class)->group(function () {
            Route::get('/videos', 'index')->name('videos');
            Route::get('/videos/data', 'getVideos')->name('data_videos');
            Route::get('/videos/create', 'create')->name('create_videos');
            Route::post('/videos/store', 'store')->name('store_videos');
            Route::get('/videos/{id}/edit', 'edit')->name('edit_videos');
            Route::post('/videos/{id}/update', 'update')->name('update_videos');
            Route::post('/videos/delete/{id}', 'delete')->name('delete_videos');
            Route::post('/videos/highlight/{id}', 'set_highlight')->name('highlight_videos');
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