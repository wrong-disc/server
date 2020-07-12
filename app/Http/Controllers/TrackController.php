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
        $track->total_plays += 1;
        $track->save();
		return $response;
    }

    public function store(Request $request){
        Gate::authorize('add-track');

        $data = [
            'title' => $request->title,
            'artist_id' => $request->artist_id,
            'album_id' => $request->album_id,
            'album_index' => $request->album_index,
            'duration' => Carbon::createFromTimestamp(0)->addSeconds($request->duration),
            'total_plays' => 0
        ];

        $file_url = null;
        if($request->file != null) {
            Storage::makeDirectory('track-files');
            $file_url = $request->file->store('track-files');
            $data['file'] = $file_url;
        }

        return Track::create($data);
    }

    public function update(Request $request, Track $track){
        Gate::authorize('edit-track');

        $data = [
            'title' => $request->title,
            'artist_id' => $request->artist_id,
            'album_id' => $request->album_id,
            'album_index' => $request->album_index,
            'duration' => Carbon::createFromTimestamp(0)->addSeconds($request->duration)
        ];

        $file_url = null;
        if($request->file != null && !is_string($request->file)) {
            Storage::makeDirectory('track-files');
            $file_url = $request->file->store('track-files');
            $data['file'] = $file_url;
        }

        return $track->update($data);
    }

    public function destroy(Track $track)
    {
        Gate::authorize('delete-track');
        $track->delete();
    }

}
