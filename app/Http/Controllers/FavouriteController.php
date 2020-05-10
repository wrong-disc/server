<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tracks = $request->user()->tracks->load(["album", "artist"]);

        $tracks->map(function($track) use ($request) { // para cada faixa do album
            $isFavourite = $track->users->contains($request->user()); // verifica se o utilizador autenticado está na lista de favoritos
            $track->favourite = $isFavourite; // e retorna true ou false para um novo campo "favourite"
        });

        return $tracks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($track_id, Request $request)
    {
        $track = Track::find($track_id);
        $request->user()->tracks()->save($track);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($track_id, Request $request)
    {
        $track = Track::find($track_id);
        $request->user()->tracks()->detach($track);
    }

}
