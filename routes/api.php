<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CalendarController;
use App\Http\Controllers\API\ResDemController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\MenuItemController;
use App\Http\Controllers\API\PDFController;
use App\Http\Controllers\ExchangeRateController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/generate-pdf', [PDFController::class, 'generateReport']);

Route::apiResource('calendar', CalendarController::class);
Route::apiResource('resdems', ResDemController::class);
Route::apiResource('services', ServiceController::class);

Route::get('/mnb/daily-rate', [ExchangeRateController::class, 'getDailyRate']);
Route::get('/mnb/monthly-rates', [ExchangeRateController::class, 'getMonthlyRates']);


Route::apiResource('menu-items', MenuItemController::class);
Route::put('menu-items/{menuItem}/toggle', [MenuItemController::class, 'toggleAvailability']);
