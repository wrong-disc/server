<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Artist extends Model
{
    use Searchable;

    public $asYouType = true;

    protected $fillable = [
        'name', 'photo'
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public function tracks()
    {
        return $this->hasMany('App\Track');
    }

    public function albums() {
        return $this->hasMany('App\Album');
    }
}
