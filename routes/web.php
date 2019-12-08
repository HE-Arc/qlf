<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('frontend', function() {
    return view('frontend');
})->middleware('auth');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home')->middleware('auth');
    Route::get('/home', 'HomeController@index')->middleware('auth');
});

Route::post('/gameCreate', 'GameController@store');

