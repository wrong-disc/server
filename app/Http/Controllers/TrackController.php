<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Storage;
use App\Track;

class TrackController extends Controller
{

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

}
