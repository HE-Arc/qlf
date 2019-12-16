<?php

namespace App\Http\Controllers;

use App\Gamesheet;
use Illuminate\Http\Request;
use App\Http\Resources\Gamesheet as GamesheetResource;

use App\Http\Resources\User as UserResource;

class GamesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GamesheetResource::collection(Gamesheet::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gamesheet  $gamesheet
     * @return \Illuminate\Http\Response
     */
    public function show(Gamesheet $gamesheet)
    {
        return new UserResource($gamesheet);
    }
}
