<?php

use App\Http\Controllers\DatatableController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\RoomBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/guest',GuestController::class);
Route::resource('/room_booking',RoomBookingController::class);

Route::get('/getData',[DatatableController::class,'getData']);