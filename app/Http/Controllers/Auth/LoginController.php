<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Login
    public function login()
    {
        // Successful login
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')]))
        {
            return redirect('/home')
                ->cookie($this->getApiTokenCookie());
        }

        // Incorrect login
        return view('auth.login');
    }

    // Logout
    public function logout()
    {
        Auth::logout();

        return redirect('/login')
            ->cookie($this->forgetApiTokenCookie());
    }


}
