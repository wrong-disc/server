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

    // Get authenticated user
    Route::get('/user', function(Request $request) {
        return $request->user();
    });

    Route::apiResources([
    // '/albums' => 'AlbumController',
    ]);

});
