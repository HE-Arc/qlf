<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Updates the username
    public function changeName(Request $request)
    {
        // Validation
        $validator = $this->validateJson($request, [
            'name' => 'required|unique:users',
        ]);

        // Validation fails
        if ($validator->fails())
        {
            return $this->responseError($validator->errors()->first());
        }

        $name = $request->json('name');

        $user = Auth::user();
        $user->name = $name;

        // Updates the user name
        $user->save();

        return $this->responseSuccess('Username successfully updated !');
    }

    // Updates the password
    public function changePassword(Request $request)
    {
        // Validation
        $validator = $this->validateJson($request, [
            'current-password' => 'required|string|min:8|different:new-password',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        // Validation fails
        if ($validator->fails())
        {
            return $this->responseError($validator->errors()->first());
        }

        $user = Auth::user();
        $currentPassword = $request->json('current-password');

        // User password must match current-password
        if (Hash::check($currentPassword, $user->password))
        {
            $newPassword = $request->json('new-password');
            $user->password = Hash::make($newPassword);

            // Updates the user password
            $user->save();

            return $this->responseSuccess('Password successfully updated !');
        }

        // User password does not match current-password
        return $this->responseWarning('Wrong current password !');
    }
}
