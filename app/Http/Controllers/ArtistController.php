<?php

namespace App\Http\Controllers;

use App\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('list-artist');
        return Artist::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('add-artist');

        $photo_url = null;
        if($request->photo) {
            Storage::makeDirectory('public/artist-images');
            $photo_url = 'storage/' . $request->photo->store('artist-images', 'public');
        }

        return Artist::create(  [
            'name' => $request->name,
            'photo' => $photo_url
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        return $artist->load("albums.artist");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        Gate::authorize('edit-artist');

        $photo_url = null;
        if($request->photo) {
            Storage::makeDirectory('public/artist-images');
            $photo_url = 'storage/' . $request->photo->store('artist-images', 'public');
        }

        return $artist->update([
            'name' => $request->name,
            'photo' => $photo_url
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        Gate::authorize('delete-artist');
        foreach ($artist->albums as $album){
            foreach ($album->tracks as $track){
                $track->delete();
            }
            $album->delete();
        }
        $artist->delete();
    }
}
