<?php

namespace App\Models;

use Database\Factories\FixedScheduleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FixedSchedule extends Model
{
    /** @use HasFactory<FixedScheduleFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room_id',
        'start_at',
        'end_at',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function fixedScheduleBookings(): HasMany
    {
        return $this->hasMany(FixedScheduleBooking::class);
    }
}
