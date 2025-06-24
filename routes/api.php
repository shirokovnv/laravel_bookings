<?php

use App\Http\Controllers\Api\v1\BookingController;
use App\Http\Controllers\Api\v1\ConstraintBookingController;
use App\Http\Controllers\Api\v1\FixedScheduleBookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function() {
    Route::post(
        '/rooms/{room}/fixed_schedules/{fixed_schedule}/bookings/{booking_date}',
        [FixedScheduleBookingController::class, 'store']
    );

    Route::post(
        '/rooms/{room}/bookings/{start_at}/{end_at}',
        [BookingController::class, 'store']
    );

    Route::post(
        '/rooms/{room}/constraint_bookings/{start_at}/{end_at}',
        [ConstraintBookingController::class, 'store']
    );
});

