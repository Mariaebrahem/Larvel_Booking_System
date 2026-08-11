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

// صفحة تسجيل الدخول والتسجيل
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register.show');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// صفحات الإدارة (محمية - محتاجة تسجيل دخول + صلاحية أدمن)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('cities', CityController::class);
    Route::resource('hotels', HotelController::class);
    Route::resource('rooms', RoomController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

// صفحات الحجز والتقييم (محمية - محتاجة تسجيل دخول)
Route::middleware('auth')->group(function () {
    Route::get('/my-bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('/bookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{id}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
    Route::post('/bookings/{id}/check-in', [BookingController::class, 'checkIn'])->name('bookings.checkIn');
    Route::post('/bookings/{id}/check-out', [BookingController::class, 'checkOut'])->name('bookings.checkOut');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// البحث - متاح للجميع من غير تسجيل دخول
Route::get('/search', [SearchController::class, 'search'])->name('search');

// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

Route::get('/hotels', function () {
    return view('hotels.index');
});
// صفحة قائمة الفنادق
Route::get('/hotels', function () {
    return view('hotels.index');
});

// صفحة تفاصيل الفندق (Hotel Details View)
Route::get('/hotels/{id}', function ($id) {
    return view('hotels.show');
});