<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public function tracks()
    {
        return $this->hasMany('App\Track');
    }
}
