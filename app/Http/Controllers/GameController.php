<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use App\Http\Resources\Game as GameResource;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GameResource::collection(Game::all());
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
        $game = new Game;
        $game->name = $request->nameGame;
        $game->user_id = auth()->user()->id;
        $game->gamesheet_id = $request->templateChoosen;
        $game->scores = "{}";

        $game->save();

        return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Game  $games
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        $g = Game::findOrFail($game);

        return new GameResource($game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        //
    }
}
