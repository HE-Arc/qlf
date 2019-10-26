<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Only for example purpose, to be deleted
 */
class GameexampleController extends Controller
{
    public function index(){
        $games = Auth::user()->gameexamples()->get();

        return response()->json(['data' => $games], 200, [], JSON_NUMERIC_CHECK);
    }
}
