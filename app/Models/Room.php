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
        "num",
        "type",
        "floor",
        "status",
        "price",
    ];
    /** Clients */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
