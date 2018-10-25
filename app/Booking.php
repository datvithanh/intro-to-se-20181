<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
