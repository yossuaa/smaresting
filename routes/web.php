<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'loginForm']);

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('checklogin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/data-realtime', [DashboardController::class, 'realtime']);

    Route::get('/monitoring', function () {
        return view('monitoring');
    });

    Route::get('/data-sensor', function () {
        return view('data-sensor');
    });

    Route::get('/analytics', function () {
        return view('analytics');
    });

    Route::get('/settings', function () {
        return view('settings');
    });

    Route::get('/change-password', [AuthController::class, 'changePasswordForm']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::get('/analytics-data', [DashboardController::class, 'analyticsData']);
    Route::post('/reset-data-sensor', [DashboardController::class, 'resetDataSensor']);
    Route::post('/toggle-data-logging', [DashboardController::class, 'toggleDataLogging']);
    Route::get('/durasi-status', [DashboardController::class, 'durasiStatus']);
});
