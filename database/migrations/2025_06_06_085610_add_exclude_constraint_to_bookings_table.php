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
                ALTER TABLE constraint_bookings ADD CONSTRAINT constraint_bookings_int4range_tsrange_excl
                    EXCLUDE USING GIST (
                        int4range(room_id, room_id, '[]') WITH =, -- Проверка на совпадение room_id --
                        tsrange(start_at, end_at) WITH && -- Проверка на пересечение временных интервалов --
                    );
            SQL
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('ALTER TABLE DROP CONSTRAINT constraint_bookings_int4range_tsrange_excl');
    }
};
