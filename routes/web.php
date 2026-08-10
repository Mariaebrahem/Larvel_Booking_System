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

// صفحة تسجيل الدخول
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// استقبال بيانات تسجيل الدخول
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// تسجيل حساب جديد وتسجيل الخروج
Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Admin Routes - محمية بـ auth + admin

Route::middleware(['auth', 'admin'])->group(function () {

    // Cities
    Route::resource('cities', CityController::class);

    // Hotels
    Route::resource('hotels', HotelController::class);

    // Rooms
    Route::resource('rooms', RoomController::class);

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');


    // Admin Bookings

    // عرض جميع الحجوزات للـ Admin
    Route::get('/admin/bookings', [BookingController::class, 'adminIndex'])
        ->name('admin.bookings.index');

    // قبول الحجز
    Route::post('/bookings/{id}/approve', [BookingController::class, 'approve'])
        ->name('bookings.approve');

    // رفض الحجز
    Route::post('/bookings/{id}/reject', [BookingController::class, 'reject'])
        ->name('bookings.reject');

    // Check In
    Route::post('/bookings/{id}/check-in', [BookingController::class, 'checkIn'])
        ->name('bookings.checkIn');

    // Check Out
    Route::post('/bookings/{id}/check-out', [BookingController::class, 'checkOut'])
        ->name('bookings.checkOut');
});


// User Routes 

Route::middleware('auth')->group(function () {

    // مشاهدة حجوزات المستخدم
    Route::get('/my-bookings', [BookingController::class, 'index'])
        ->name('bookings.index');

    // إنشاء حجز
    Route::post('/bookings', [BookingController::class, 'store'])
        ->name('bookings.store');

    // تعديل حجز
    Route::put('/bookings/{id}', [BookingController::class, 'update'])
        ->name('bookings.update');

    // إلغاء حجز
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])
        ->name('bookings.cancel');

    // Reviews

    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');
});

// Search - متاح للجميع بدون Login
Route::get('/search', [SearchController::class, 'search'])
    ->name('search');