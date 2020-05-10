<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;
use App\Album;
use App\Artist;

class SearchController extends Controller
{

    public function search($query) {

        $foundTracks = Track::search($query)
        ->query(function ($builder) {
            $builder->with('album');
            $builder->with('artist');
        })
        ->get();

        $foundAlbums = Album::search($query)
        ->query(function ($builder) {
            $builder->with('artist');
        })
        ->get();

        $foundArtists = Artist::search($query)
        ->get();

        return [
            "tracks" => $foundTracks,
            "albums" => $foundAlbums,
            "artists" => $foundArtists
        ];

    }

}
