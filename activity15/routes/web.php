<?php

use App\Http\Controllers\RouteController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather', [WeatherController::class, 'getWeather']);
Route::get('/routes', [RouteController::class, 'getRouteSteps']);
