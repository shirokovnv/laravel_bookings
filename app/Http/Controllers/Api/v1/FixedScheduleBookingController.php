<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\FixedSchedule;
use App\Models\FixedScheduleBooking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FixedScheduleBookingController extends Controller
{
    public function store(
        Request $request,
        Room $room,
        FixedSchedule $fixedSchedule,
        string $bookingDate,
    ): JsonResponse
    {
        $booking = FixedScheduleBooking::query()
            ->create(
                [
                    'room_id' => $room->id,
                    'fixed_schedule_id' => $fixedSchedule->id,
                    'booking_date' => Carbon::parse($bookingDate)->toDate(),
                ]
            );

        return new JsonResponse($booking);
    }
}
