<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Album extends Model
{
    use Searchable;

    public $asYouType = true;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title
        ];
    }

    public function tracks()
    {
        return $this->hasMany('App\Track');
    }

    public function artist() {
        return $this->belongsTo('App\Artist');
    }
}
