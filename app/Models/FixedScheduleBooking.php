<?php

namespace App\Models;

use Database\Factories\FixedScheduleBookingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FixedScheduleBooking extends Model
{
    /** @use HasFactory<FixedScheduleBookingFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_date',
        'fixed_schedule_id',
    ];

    public function fixedSchedules(): BelongsTo
    {
        return $this->belongsTo(FixedSchedule::class);
    }
}
