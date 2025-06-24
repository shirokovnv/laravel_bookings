<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            <<<SQL
                CREATE TABLE constraint_bookings(
                    id SERIAL PRIMARY KEY,
                    room_id INTEGER REFERENCES rooms(id),
                    start_at TIMESTAMP NOT NULL,
                    end_at TIMESTAMP NOT NULL,
                    created_at TIMESTAMP,
                    updated_at TIMESTAMP
                )
            SQL
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TABLE constraint_bookings');
    }
};
