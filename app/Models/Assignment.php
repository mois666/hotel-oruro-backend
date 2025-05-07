<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room_id',
        'reservation_id',
        'client_id',
        'key_room',
    ];
    /**
     * Get the reservation that owns the assignment.
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    /**
     room
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
