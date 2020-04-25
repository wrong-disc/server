<?php

namespace App\Http\Controllers;

use App\artists;
use Illuminate\Http\Request;

class ArtistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\artists  $artists
     * @return \Illuminate\Http\Response
     */
    public function show(artists $artists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\artists  $artists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, artists $artists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\artists  $artists
     * @return \Illuminate\Http\Response
     */
    public function destroy(artists $artists)
    {
        //
    }
}
