<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use App\Http\Resources\Game as GameResource;
use Auth;
use Illuminate\Support\Facades\DB;

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

    // get all the games belonging to the user
    public function getGamesUser()
    {
        $games = Game::whereHas('users', function($query){
            $query->where('user_id',  Auth::user()->id);
        })
        ->get();
        
        return $games;
    }

    /**
     * Whenever a user join a game already created.
     */
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

        // Fetching the game by the name
        $game = Game::where('name', $request->json('nameJoinGame'))->first();

        // Display an error if the game doesnt match any game
        if (!$game) {
            return $this->responseError('Game doesn\'t exist');
        }
        
        // Adding the current user to the game if he's not already in it, else display an error
        if (DB::table("game_user")->where("game_id", $game->id)->where('user_id', Auth::user()->id)->count() < 1){
            $game->users()->attach(Auth::user()->id);
        }else{
            return $this->responseError('You are already in this game');
        }
        
        $nbrPlayers = DB::table("game_user")->where("game_id", $game->id)->distinct('user_id')->count();

        $scores = json_decode($game->scores);

        foreach ($scores as &$row){
            $row->{$nbrPlayers-1} = "-";
        }

        $newScores = json_encode($scores);

        $game->scores = $newScores;
        $game->save();

        return $this->responseSuccess('Successfully joined game ' . (string)$game->name);
    }

    /**
     * Store a newly created game. also add the creator in the game.
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
            return $this->responseError($validator->errors()->first());
        }

        $game = new Game;
        $game->name = $request->json('nameGame');
        $game->user_id = auth()->user()->id;
        $game->gamesheet_id = $request->json('templateChoosen');
        $game->scores = '{"0": {"0": "-"}, "1": {"0": "-"},"2": {"0": "-"}}';
        $game->save();

        //put the auth in the player list
        $game->users()->attach(Auth::user()->id);

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
        return new GameResource($game);
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
        $game->name = $request->json('name');
        $game->scores = $request->json('scores');
        $game->save();

        return $this->responseSuccess('Game successfully updated');
    }
}
