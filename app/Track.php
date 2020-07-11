<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Track extends Model
{
    use Searchable;

    public $asYouType = true;

    protected $fillable = [
        'title', 'artist_id', 'album_id', 'album_index', 'duration', 'file', 'total_plays'
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
