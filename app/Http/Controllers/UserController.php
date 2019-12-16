<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Updates the username
    public function changeUsername(Request $request)
    {
        // Validation
        $validator = $this->validateJson($request, [
            'username' => 'required',
        ]);

        // Validation fails
        if ($validator->fails())
        {
            return $this->responseError($validator);
        }

        $username = $request->json('username');

        $user = Auth::user();
        $user->name = $username;

        // Updates the username
        $user->save();

        return $this->responseSuccess('Username successfully updated !');
    }
}
