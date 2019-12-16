<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use App\Http\Resources\Game as GameResource;
use Auth;

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

    
    public function getGamesUser()
    {
        $games = Game::whereHas('users', function($query) {
            $query->where('user_id', Auth::user()->id);
        })
        ->get();
        
        return $games;
    }

    public function joinGame(Request $request)
    {
        // Validation
        $validator = $this->validateJson($request, [
            'nameJoinGame' => 'required',
        ]);

        // Validation fails
        if ($validator->fails())
        {
            return $this->responseError($validator);
        }

        $game = Game::where('name', $request->json('nameJoinGame'));
        $game->user()->save(auth()->user()->id);


        return $this->responseSuccess('Game successfully joined !');
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
        // Validation
        $validator = $this->validateJson($request, [
            'nameGame' => 'required',
        ]);

        // Validation fails
        if ($validator->fails())
        {
            return $this->responseError($validator);
        }
        $game = new Game;
        $game->name = $request->json('nameGame');
        $game->user_id = auth()->user()->id;
        $game->gamesheet_id = $request->json('templateChoosen');
        $game->scores = "{}";

        $game->save();

        return $this->responseSuccess('Game successfully created !');
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
