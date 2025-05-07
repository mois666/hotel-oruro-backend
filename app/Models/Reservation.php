<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'start_date',
        'end_date',
        'simple',
        'double',
        'state',
        'discount',
        'total',
    ];
    /**
     * Get the client that owns the reservation.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the user that owns the reservation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /** assignments */
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
