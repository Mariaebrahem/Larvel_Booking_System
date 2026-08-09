<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Booking
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // Booking - Admin actions
    Route::post('/bookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{id}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    Route::post('/bookings/{id}/check-in', [BookingController::class, 'checkIn'])->name('bookings.checkIn');
    Route::post('/bookings/{id}/check-out', [BookingController::class, 'checkOut'])->name('bookings.checkOut');

    // Review
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// Search - متاح للجميع من غير تسجيل دخول
Route::get('/search', [SearchController::class, 'search'])->name('search');