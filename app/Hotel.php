<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotels';

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'hotel_id');
    }
}
