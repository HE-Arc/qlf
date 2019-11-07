<?php

use Illuminate\Http\Request;

use App\Http\Resources\User as UserResource;
use App\User;
use App\Http\Resources\Gamesheet as GamesheetResource;
use App\Gamesheet;

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

Route::get('/user', function () {
    return new UserResource(User::find(1));
});


Route::apiResource('gamesheets', 'GamesheetController');