<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalController;

Route::get('/', function () {
    return view('welcome'); // or your homepage view
})->name('home');

// Corrected route definitions
Route::post('paypal', [PaypalController::class, 'paypal'])->name('paypal');

Route::get('success', [PaypalController::class, 'success'])->name('success');
Route::get('cancel', [PaypalController::class, 'cancel'])->name('cancel');