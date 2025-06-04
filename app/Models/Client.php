<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room_id',
        'ci',
        'name',
        'last_name',
        'start_date',
        'end_date',
        'state',
        'discount',
        'total',
    ];
    /**** reservacioines */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    /** rooms */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
