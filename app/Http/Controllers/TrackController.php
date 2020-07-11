<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;
use App\Track;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;


class TrackController extends Controller
{
    public function index(){
        Gate::authorize('list-track');
        return Track::with("album")
            ->with("artist")
            ->get();
    }

    public function show($id) {
        $track = Track::find($id);
        $track
            ->load('artist')
            ->load('album');
        return $track;
    }

    public function stream($id) {
        $track = Track::find($id);
        $path = Storage::disk('local')->path($track->file);
		$response = new BinaryFileResponse($path);
		BinaryFileResponse::trustXSendfileTypeHeader();
		return $response;
    }

    public function store(Request $request){
        Gate::authorize('add-track');
        return Track::create([
            'title' => $request->title,
            'artist_id' => $request->artist_id,
            'album_id' => $request->album_id,
            'album_index' => $request->album_index,
            'file' => '',
            'duration' => Carbon::createFromTimestamp(0)->addMinutes(2)->addSeconds(42),
            'total_plays' => 0
        ]);
    }

    public function destroy(Track $track)
    {
        Gate::authorize('delete-track');
        $track->delete();
    }

}
