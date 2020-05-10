<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    public function album()
    {
        return $this->belongsTo('App\Album');
    }

    public function artist()
    {
        return $this->belongsTo('App\Artist');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'favourites');
    }
}
