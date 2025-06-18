<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RazorpayController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

// Corrected route definitions
Route::post('razorpay', action: [RazorpayController::class, 'razorpay'])->name('razorpay');

Route::get('success', [RazorpayController::class, 'success'])->name('success');
Route::get('cancel', [RazorpayController::class, 'cancel'])->name('cancel');
