<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'room_feature', 'room_id', 'feature_id');
    }    
}
