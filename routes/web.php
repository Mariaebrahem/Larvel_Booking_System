<?php

use Illuminate\Support\Facades\Route;
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
});