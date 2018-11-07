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

    public function modifiers()
    {
        return $this->belongsToMany(User::class, 'hotel_modifier', 'hotel_id', 'user_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'hotel_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'hotel_service', 'hotel_id', 'service_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'hotel_id');
    }
}
