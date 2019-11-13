<?php

namespace App\Http\Controllers;

use App\Gamesheet;
use Illuminate\Http\Request;

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

        return response()->json($gamesheets);

        return view('gamesheets.index', [
            'gamesheets' => $gamesheets,
        ]);
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
        //
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
}
