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
        $gamesheets = Gamesheet::all();

        return new GamesheetResource($gamesheets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gamesheet  $gamesheet
     * @return \Illuminate\Http\Response
     */
    public function show(Gamesheet $gamesheet)
    {
        $g = Gamesheet::findOrFail($gamesheet);

        return new UserResource($gamesheet);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gamesheet  $gamesheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Gamesheet $gamesheet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gamesheet  $gamesheet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gamesheet $gamesheet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gamesheet  $gamesheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gamesheet $gamesheet)
    {
        //
    }

    public function getTemplate(Gamesheet $gamesheet)
    {
        $g = Gamesheet::findOrFail($gamesheet);
        return new UserResource($gamesheet->template);
    }

    // TEST FOR THE ANDROID APP
    public function getExample()
    {
        $id = 1;
        $gs = Gamesheet::findOrFail($id);

        $template = $gs->getOriginal('template');

        return $template;
        //return new GamesheetResource($gs);
    }
}
