<?php

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/stripe', [StripeController::class, 'stripe'])->name('stripe');

Route::get('success', [StripeController::class, 'success'])->name('success');
Route::get('cancel', [StripeController::class, 'cancel'])->name('cancel');
