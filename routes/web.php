<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\Management\JobController;
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
            ->only(['index', 'show', 'edit', 'update']);
    });
});
