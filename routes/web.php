<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ApplicationStepController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Landing;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

Route::get('/', Landing\HomeController::class)->name('home');
Route::get('/about', Landing\AboutController::class)->name('about');
Route::get('/jobs/{job}', [Landing\JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{job}/apply', [Landing\JobController::class, 'create'])->name('jobs.apply');
Route::post('/jobs/{job}/apply', [Landing\JobController::class, 'store']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [AuthController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('/managements')->name('managements.')->group(function () {
        Route::resource('/jobs', JobController::class)->except('destroy');
        Route::delete('/jobs', [JobController::class, 'destroy'])->name('jobs.destroy');

        Route::resource('jobs.applications', JobApplicationController::class)
            ->only(['index']);

        Route::resource('jobs.applications.steps', ApplicationStepController::class)
            ->only(['show', 'update', 'destroy']);

        Route::resource('jobs.applications.steps.communications', CommunicationController::class)
            ->only(['store']);

        Route::resource('jobs.applications.steps.reviews', ReviewController::class)
            ->only(['index', 'store', 'update', 'destroy']);

        Route::resource('jobs.applications.steps.attachments', AttachmentController::class)
            ->only(['store', 'show', 'destroy']);

        Route::resource('/applications', ApplicationController::class)
            ->only(['index']);

        Route::resource('/templates', TemplateController::class)->except(['destroy']);
        Route::delete('/templates', [TemplateController::class, 'destroy'])->name('templates.destroy');
    });
});
