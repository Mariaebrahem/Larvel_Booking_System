<?php

use Illuminate\Support\Facades\Route;

// Redirect root to admin dashboard
Route::get('/', function () {
    return redirect('/admin/dashboard');
});

// Admin Frontend Routes
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/cities', function () {
        return view('admin.cities.index');
    })->name('admin.cities.index');

    Route::get('/hotels', function () {
        return view('admin.hotels.index');
    })->name('admin.hotels.index');

    Route::get('/rooms', function () {
        return view('admin.rooms.index');
    })->name('admin.rooms.index');

    Route::get('/room-types', function () {
        return view('admin.roomTypes.index');
    })->name('admin.room-types.index');

    Route::get('/amenities', function () {
        return view('admin.amenities.index');
    })->name('admin.amenities.index');

    Route::get('/bookings', function () {
        return view('admin.bookings.index');
    })->name('admin.bookings.index');

    Route::get('/reports', function () {
        return view('admin.reports.index');
    })->name('admin.reports.index');
});

