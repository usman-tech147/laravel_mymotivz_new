<?php

use Illuminate\Support\Facades\Route;

Route::get('paypal/create', [\App\Http\Controllers\PaypalController::class, 'createPayment'])->name('paypal.create_payment');
Route::post('paypal/payment', [\App\Http\Controllers\PaypalController::class, 'storePayment'])->name('paypal.store_payment');
Route::get('success/payment', [\App\Http\Controllers\PaypalController::class, 'successPayment'])->name('paypal.success');
Route::get('cancel/payment', [\App\Http\Controllers\PaypalController::class, 'cancelPayment'])->name('paypal.cancel');

Route::get('/create/plan',[\App\Http\Controllers\PaypalController::class, 'createPlan'])->name('paypal.create_plan');
Route::get('/plan/details',[\App\Http\Controllers\PaypalController::class, 'getPlanDetails'])->name('paypal.plan_details');
Route::get('/list/plans',[\App\Http\Controllers\PaypalController::class, 'getListPlans'])->name('paypal.list_plans');
Route::get('/execute-agreement/true',[\App\Http\Controllers\PaypalController::class, 'executeAgreementTrue']);
Route::get('/execute-agreement/false',[\App\Http\Controllers\PaypalController::class, 'executeAgreementFalse']);