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

// TEST FOR THE ANDROID APP
Route::get('apiExample', 'GamesheetController@getExample');

Route::apiResource('games', 'GameController');

Route::apiResource('gamesheets', 'GamesheetController');

Route::get('getGameSheet', 'GamesheetController@getTemplatesToSelect');

Route::get('/live', 'HomeController@gotToLive');
// API authenticating protected routes
Route::group(['middleware' => ['auth:api']], function()
{
    Route::get('/user', function(Request $request)
    {
        return $request->user();
    });

    Route::get('getGamesUser', function () {
        $id = Auth::user()->id;
        
        $games = Game::whereHas('users', function($query) use ($id) {
            $query->where('user_id', $id);
        })
        ->get();
        
        return $games;
    });

    Route::post('changeUsername', 'UserController@changeUsername');
});
