<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function changeUsername(Request $request)
    {
        $validator = $this->validateJson($request, [
            'username' => 'required',
        ]);

        if ($validator->fails())
        {
            return $this->responseError($validator);
        }

        $username = $request->json('username');

        $user = Auth::user();
        $user->name = $username;
        $user->save();

        return $this->responseSuccess('Username successfully updated !');
    }
}
