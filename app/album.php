<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    return $this->hasMany('App\tracks');
}
