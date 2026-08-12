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
use App\Http\Controllers\PageController;


// =========================
// Authentication
// =========================

// Login page
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Register page
Route::get('/register', function () {
    return view('auth.register');
})->name('register.show');

// Login
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// Register
Route::post('/register', [AuthController::class, 'register'])
    ->name('register');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// =========================
// Admin Dashboard & CRUD Routes
// =========================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // /admin → /admin/dashboard
        Route::get('/', function () {
            return redirect('/admin/dashboard');
        });

        // Admin Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Cities
        Route::resource('cities', CityController::class);

        // Hotels
        Route::resource('hotels', HotelController::class);

        // Rooms
        Route::resource('rooms', RoomController::class);

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])
            ->name('reports.index');
    });


// =========================
// Booking & Reviews
// =========================

Route::middleware('auth')->group(function () {

    // User bookings
    Route::get('/my-bookings', [BookingController::class, 'index'])
        ->name('bookings.index');

    // Create booking
    Route::post('/bookings', [BookingController::class, 'store'])
        ->name('bookings.store');

    // Cancel booking
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])
        ->name('bookings.cancel');

    // Approve booking
    Route::post('/bookings/{id}/approve', [BookingController::class, 'approve'])
        ->name('bookings.approve');

    // Reject booking
    Route::post('/bookings/{id}/reject', [BookingController::class, 'reject'])
        ->name('bookings.reject');

    // Check In
    Route::post('/bookings/{id}/check-in', [BookingController::class, 'checkIn'])
        ->name('bookings.checkIn');

    // Check Out
    Route::post('/bookings/{id}/check-out', [BookingController::class, 'checkOut'])
        ->name('bookings.checkOut');

    // Add review
    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');
});


// =========================
// Public Search
// =========================

Route::get('/search', [SearchController::class, 'search'])
    ->name('search');


// =========================
// Static Pages
// =========================

Route::get('/offers', [PageController::class, 'offers'])
    ->name('offers');

Route::get('/support', [PageController::class, 'support'])
    ->name('support');


// =========================
// Home
// =========================

Route::get('/', function () {
    return view('welcome');
});


// =========================
// Public Hotels
// =========================

// Hotels list
Route::get('/hotels', [HotelController::class, 'publicIndex'])
    ->name('hotels.index');

// Hotel details
Route::get('/hotels/{hotel}', [HotelController::class, 'publicShow'])
    ->name('hotels.show');