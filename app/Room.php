<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    public function features()
    {
        return $this->hasManyThrough(Feature::class, 'room_feature', 'feature_id', 'room_id');
    }    
}
