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
        Schema::create('fixed_schedule_bookings', function (Blueprint $table) {
            $table->id();
            $table->date('booking_date');
            $table->unsignedBigInteger('fixed_schedule_id');
            $table->timestamps();

            $table
                ->foreign('fixed_schedule_id')
                ->references('id')
                ->on('fixed_schedules')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixed_schedule_bookings');
    }
};
