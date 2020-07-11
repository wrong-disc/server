<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('list-album');
        return Album::with("artist")->get();
    }

    public function explore()
    {
        return Album::with("artist")->get();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('add-album');
        return Album::create([
            'title' => $request->title,
            'cover' => 'https://upload.wikimedia.org/wikipedia/pt/7/79/The_Evolution_of_Man_de_Example.jpg',
            'artist_id' => $request->artist_id 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album, Request $request)
    {
        $album->load(["artist", "tracks.artist"]); // Obtem o album (com artista e faixa + artista)

        $album->tracks = $album->tracks
        ->map(function($track) use ($request) { // para cada faixa do album
            $isFavourite = $track->users->contains($request->user()); // verifica se o utilizador autenticado está na lista de favoritos
            $track->favourite = $isFavourite; // e retorna true ou false para um novo campo "favourite"
        });

        return $album;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        Gate::authorize('delete-album');
        foreach ($album->tracks as $track){
            $track->delete();
        }
        $album->delete();
    }
}
