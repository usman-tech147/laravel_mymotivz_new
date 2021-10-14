<?php

use Illuminate\Support\Facades\Route;

Route::get('/paypal/token',[\App\Http\Controllers\PaypalController::class, 'getToken']);
Route::get('/paypal/create-package',[\App\Http\Controllers\PaypalController::class, 'createPackage']);
Route::get('/paypal/products-list',[\App\Http\Controllers\PaypalController::class, 'productsList']);
Route::get('/paypal/plans-list',[\App\Http\Controllers\PaypalController::class, 'plansList']);
Route::post('/paypal/subscribe-now',[\App\Http\Controllers\PaypalController::class, 'subscribeNow'])->name('subscribe-now');
Route::get('https://bbdb-2400-adc5-109-e00-85b5-16d0-7863-35e8.ngrok.io/process-subscription', [\App\Http\Controllers\PaypalController::class, 'paypalSuccess']);

