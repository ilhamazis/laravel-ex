<?php

use App\Http\Controllers\ApplicationStepController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\Management\JobController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/jobs', 'jobs')->name('jobs');

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

        Route::resource('jobs.applications.steps.reviews', ReviewController::class)
            ->only(['index', 'store', 'update', 'destroy']);
    });
});
