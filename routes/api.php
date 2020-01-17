<?php

use Illuminate\Http\Request;

use App\Http\Resources\User as UserResource;
use App\User;

use App\Http\Resources\Gamesheet as GamesheetResource;
use App\Gamesheet;

use App\Http\Resources\Game as GameResource;
use App\Game;

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

// Android login
Route::post('restLogin', 'Auth\LoginController@restLogin');

// Android logout
Route::post('restLogout', 'Auth\LoginController@restLogout');

// API authenticating protected routes
Route::group(['middleware' => ['auth:api']], function()
{
    /**
     * User
     */

    // User info
    Route::get('/user', function(Request $request)
    {
        return $request->user();
    });

    // Change username
    Route::post('changeName', 'UserController@changeName');

    // Change password
    Route::post('changePassword', 'UserController@changePassword');

    /**
     * Game
     */

     // Game Resource (index, store, show, update)
    Route::apiResource('games', 'GameController', [
        'only' => ['index', 'store', 'show', 'update']
    ]);

    // Gets the user games
    Route::get('/getGamesUser', 'GameController@getGamesUser');

    // The user joins a game
    Route::post('joinAGame', 'GameController@joinGame');

    /**
     * Gamesheet
     */

    // Gamesheet Resource (index, show)
    Route::apiResource('gamesheets', 'GamesheetController', [
        'only' => ['index', 'show']
    ]);
});
