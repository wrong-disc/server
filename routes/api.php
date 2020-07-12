<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth
Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');
Route::get('/logout', 'UserController@logout');

Route::middleware('auth:sanctum')->group(function() {

    Route::get('/favourites', 'FavouriteController@index');

    Route::post('/favourites/{track_id}', 'FavouriteController@store');

    Route::delete('/favourites/{track_id}', 'FavouriteController@destroy');

    Route::get('/search/{query}', 'SearchController@search');

    Route::get('/albums/explore', 'AlbumController@explore');

    Route::apiResources([
        '/albums' => 'AlbumController',
        '/artists' => 'ArtistController',
        '/tracks' => 'TrackController',
        '/users' => 'UserController'
    ]);

    Route::get('/user', 'AuthUserController@index');

    Route::put('/user', 'AuthUserController@update');

    Route::get('/tracks/{id}/stream', [
        'as' => 'audio',
        'uses' => 'TrackController@stream'
    ]);
});
