<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResDemController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\RESTController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SOAPController;
use App\Http\Controllers\SOAPClientController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/calendar/{servid?}', [CalendarController::class, 'index'])->name('calendar.index');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ResDemController::class, 'index'])->name('dashboard');
    Route::post('/resdem', [ResDemController::class, 'store'])->name('resdem.store');
    Route::delete('/resdem/{resdem}', [ResDemController::class, 'destroy'])->name('resdem.destroy');
});

Route::get('/mnb', [ExchangeRateController::class, 'index']);

Route::resource('admin', ServiceController::class)->names('admin')->middleware(['auth']);

Route::get('/restful', [RESTController::class, 'index'])->name('restful');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/soap', [SOAPController::class, 'handle']);
Route::get('/soap/wsdl', [SOAPController::class, 'wsdl']);

Route::get('/soap', [SOAPClientController::class, 'index']);
Route::post('/soap/execute', [SOAPClientController::class, 'execute']);

require __DIR__ . '/auth.php';
