<?php

use App\Http\Controllers\API\Order\OrderPaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('stripe/webhook', [OrderPaymentController::class, 'stripeWebhook']);

// Payment callback routes
Route::get('/payment/success', [OrderPaymentController::class, 'payment_success'])->name('payment.success');
Route::get('/payment/cancel', [OrderPaymentController::class, 'payment_cancel'])->name('payment.cancel');







require __DIR__.'/auth.php';
require __DIR__.'/api.php';
