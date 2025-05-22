<?php

use App\Http\Controllers\RouteController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather', [WeatherController::class, 'getWeather']);
Route::get('/route', function () {
    return view('route');
})->name('route');
Route::post('/routes', [RouteController::class, 'getRouteSteps']);
