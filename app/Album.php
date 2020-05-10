<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function tracks()
    {
        return $this->hasMany('App\Track');
    }

    public function artist() {
        return $this->belongsTo('App\Artist');
    }
}