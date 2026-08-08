<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\CityController;

Route::resource('cities', CityController::class);

use App\Http\Controllers\HotelController;

Route::resource('hotels', HotelController::class);

use App\Http\Controllers\RoomController;

Route::resource('rooms', RoomController::class);
