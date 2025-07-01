<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\ConstraintBooking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConstraintBookingController extends Controller
{
    public function store(Request $request, Room $room, string $startAt, string $endAt): JsonResponse
    {
        $booking = ConstraintBooking::query()
            ->create([
                'room_id' => $room->id,
                'start_at' => Carbon::parse($startAt)->toDateTime(),
                'end_at' => Carbon::parse($endAt)->toDateTime(),
            ]);

        return new JsonResponse($booking);
    }
}
