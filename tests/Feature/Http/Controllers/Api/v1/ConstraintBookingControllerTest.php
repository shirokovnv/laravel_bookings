<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers\Api\v1;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConstraintBookingControllerTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function testStoreBookingInDatabase()
    {
        $this->assertDatabaseCount('constraint_bookings', 0);

        $response = $this->post('api/v1/rooms/1/constraint_bookings/2025-06-06 10:00/2025-06-06 20:00');
        $response->assertStatus(200);

        $this->assertDatabaseCount('constraint_bookings', 1);

        // Another room
        $response = $this->post('api/v1/rooms/2/constraint_bookings/2025-06-06 10:00/2025-06-06 20:00');
        $response->assertStatus(200);

        $this->assertDatabaseCount('constraint_bookings', 2);
    }

    public function testThrowsExceptionWhenBookingsOverlap()
    {
        $this->assertDatabaseCount('constraint_bookings', 0);

        $response = $this->post('api/v1/rooms/1/constraint_bookings/2025-06-06 10:00/2025-06-06 20:00');
        $response->assertStatus(200);

        $this->expectException(QueryException::class);

        $response = $this->post('api/v1/rooms/1/constraint_bookings/2025-06-06 09:00/2025-06-06 16:00');
        $response->assertStatus(500);

        $this->assertDatabaseCount('constraint_bookings', 1);
    }
}
