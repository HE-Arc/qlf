<?php

use Illuminate\Http\Request;

use App\Http\Resources\User as UserResource;
use App\User;

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

//all users
//Route::middleware('auth:api')->get('/user', function () {
Route::get('/users', function () {
    return UserResource::collection(User::all());
});

//single user
Route::get('/user', function () {
    return new UserResource(User::find(1));
});