<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
