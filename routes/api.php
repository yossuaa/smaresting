<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::post('/sensor', [DashboardController::class, 'storeSensor']);
