<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/data-realtime', [DashboardController::class, 'realtime']);
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/monitoring', function () {
    return view('monitoring');
});

Route::get('/data-sensor', function () {
    return view('data_sensor');
});

Route::get('/analytics', function () {
    return view('analytics');
});

Route::get('/reports', function () {
    return view('reports');
});

Route::get('/settings', function () {
    return view('settings');
});
