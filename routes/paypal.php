<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalWebhookController;
Route::get('/paypal/token',[\App\Http\Controllers\PaypalController::class, 'getToken']);
Route::get('/paypal/create-package',[\App\Http\Controllers\PaypalController::class, 'createPackage']);
Route::get('/paypal/products-list',[\App\Http\Controllers\PaypalController::class, 'productsList']);
Route::get('/paypal/plans-list',[\App\Http\Controllers\PaypalController::class, 'plansList']);
Route::post('/paypal/subscribe-now',[\App\Http\Controllers\PaypalController::class, 'subscribeNow'])->name('subscribe-now');
Route::get('/process-subscription', [\App\Http\Controllers\PaypalController::class, 'paypalSuccess']);
Route::post('/paypal-webhook', [PayPalWebhookController::class, 'webhook']);

