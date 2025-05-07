<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "num_room",
        "type",
        "floor",
        "status",
    ];
    /** assignments */
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
