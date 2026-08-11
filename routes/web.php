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


// =========================
// Authentication
// =========================

// صفحة تسجيل الدخول
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// صفحة إنشاء الحساب
Route::get('/register', function () {
    return view('auth.register');
})->name('register.show');

// تسجيل الدخول
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// إنشاء حساب
Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

// تسجيل الخروج
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// =========================
// Admin Routes
// =========================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('cities', CityController::class);

        Route::resource('hotels', HotelController::class);

        Route::resource('rooms', RoomController::class);

        Route::get('/reports', [ReportController::class, 'index'])
            ->name('reports.index');
    });


// =========================
// Booking & Reviews
// =========================

Route::middleware('auth')->group(function () {

    // حجوزات المستخدم
    Route::get('/my-bookings', [BookingController::class, 'index'])
        ->name('bookings.index');

    // إنشاء حجز
    Route::post('/bookings', [BookingController::class, 'store'])
        ->name('bookings.store');

    // إلغاء الحجز
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])
        ->name('bookings.cancel');

    // موافقة الأدمن
    Route::post('/bookings/{id}/approve', [BookingController::class, 'approve'])
        ->name('bookings.approve');

    // رفض الأدمن
    Route::post('/bookings/{id}/reject', [BookingController::class, 'reject'])
        ->name('bookings.reject');

    // Check In
    Route::post('/bookings/{id}/check-in', [BookingController::class, 'checkIn'])
        ->name('bookings.checkIn');

    // Check Out
    Route::post('/bookings/{id}/check-out', [BookingController::class, 'checkOut'])
        ->name('bookings.checkOut');

    // إضافة تقييم
    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');
});


// =========================
// Public Search
// =========================

Route::get('/search', [SearchController::class, 'search'])
    ->name('search');


// =========================
// Home
// =========================

Route::get('/', function () {
    return view('welcome');
});


// =========================
// Public Hotels
// =========================

// قائمة الفنادق للمستخدم
Route::get('/hotels', [HotelController::class, 'publicIndex'])
    ->name('hotels.index');

// تفاصيل الفندق
Route::get('/hotels/{hotel}', [HotelController::class, 'publicShow'])
    ->name('hotels.show');