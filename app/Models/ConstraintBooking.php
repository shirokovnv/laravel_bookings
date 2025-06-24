<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConstraintBooking extends Model
{
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
}
