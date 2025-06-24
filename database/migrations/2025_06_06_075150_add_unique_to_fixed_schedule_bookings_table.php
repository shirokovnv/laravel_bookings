<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('fixed_schedule_bookings', function (Blueprint $table) {
            $table->unique(['booking_date', 'fixed_schedule_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fixed_schedule_bookings', function (Blueprint $table) {
            $table->dropUnique(['booking_date', 'fixed_schedule_id']);
        });
    }
};
