<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// صفحة تسجيل الدخول (GET - بتظهر في المتصفح)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// استقبال بيانات تسجيل الدخول (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// تسجيل حساب جديد وتسجيل الخروج
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// صفحات الإدارة (محمية - لازم تسجيل دخول)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('cities', CityController::class);
    Route::resource('hotels', HotelController::class);
    Route::resource('rooms', RoomController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Booking - Admin only actions
    Route::post('/bookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{id}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    Route::post('/bookings/{id}/check-in', [BookingController::class, 'checkIn'])->name('bookings.checkIn');
    Route::post('/bookings/{id}/check-out', [BookingController::class, 'checkOut'])->name('bookings.checkOut');
});

Route::middleware('auth')->group(function () {
    // Booking - regular user
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    // Review
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// Search - متاح للجميع من غير تسجيل دخول
Route::get('/search', [SearchController::class, 'search'])->name('search');