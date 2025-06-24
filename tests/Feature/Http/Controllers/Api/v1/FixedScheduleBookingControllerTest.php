<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api\v1;

use App\Models\FixedScheduleBooking;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FixedScheduleBookingControllerTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function testStoreBookingInDatabase()
    {
        $this->assertDatabaseCount('fixed_schedule_bookings', 0);

        $response = $this->post('api/v1/rooms/1/fixed_schedules/1/bookings/2025-06-06');
        $response->assertStatus(200);

        $this->assertDatabaseCount('fixed_schedule_bookings', 1);

        // Another room for the same date
        $response = $this->post('api/v1/rooms/2/fixed_schedules/6/bookings/2025-06-06');
        $response->assertStatus(200);

        $this->assertDatabaseCount('fixed_schedule_bookings', 2);
    }

    public function testThrowsExceptionWhenBookingsOverlap()
    {
        $this->assertDatabaseCount('fixed_schedule_bookings', 0);

        $response = $this->post('api/v1/rooms/1/fixed_schedules/1/bookings/2025-06-06');
        $response->assertStatus(200);

        $this->expectException(QueryException::class);

        $response = $this->post('api/v1/rooms/1/fixed_schedules/1/bookings/2025-06-06');
        $response->assertStatus(500);

        $this->assertDatabaseCount('fixed_schedule_bookings', 1);
    }
}
