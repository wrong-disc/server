<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Album extends Model
{
    use Searchable;

    public $asYouType = true;

    protected $fillable = [
        'title', 'cover', 'artist_id'
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
            'title' => $this->title
        ];
    }

    public function tracks()
    {
        return $this->hasMany('App\Track')
        ->orderBy('album_index');
    }

    public function artist() {
        return $this->belongsTo('App\Artist');
    }
}
