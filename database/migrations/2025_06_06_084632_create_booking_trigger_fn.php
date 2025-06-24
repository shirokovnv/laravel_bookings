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
            CREATE OR REPLACE FUNCTION check_booking_overlap()
            RETURNS TRIGGER AS $$
                BEGIN
                    IF EXISTS(
                        SELECT 1 FROM bookings
                        WHERE room_id = NEW.room_id
                        AND tstzrange(start_at, end_at) && tstzrange(NEW.start_at, NEW.end_at)
                        AND id <> NEW.id
                    ) THEN RAISE EXCEPTION 'Бронирование пересекается с существующим бронированием для этой комнаты.';
                    END IF;
                    RETURN NEW;
                END
            $$ LANGUAGE plpgsql;
            SQL
        );

        DB::unprepared(
            <<<SQL
                CREATE TRIGGER bookings_overlap_trigger
                BEFORE INSERT OR UPDATE ON bookings
                FOR EACH ROW
                EXECUTE FUNCTION check_booking_overlap();
            SQL
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS bookings_overlap_trigger ON bookings;');
        DB::unprepared('DROP FUNCTION IF EXISTS check_booking_overlap();');
    }
};
