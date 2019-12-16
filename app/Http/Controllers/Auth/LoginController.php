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
            $user = Auth::user();

            // Creates the _api_token cookie
            $token = $user->createToken('qlf')->accessToken;
            $cookie = $this->getCookieDetails($token);

            return redirect('/home')
                ->cookie($cookie['name'],
                    $cookie['value'],
                    $cookie['minutes'],
                    $cookie['path'],
                    $cookie['domain'],
                    $cookie['secure'],
                    $cookie['httponly'],
                    $cookie['samesite']);
        }

        // Incorrect login
        return view('auth.login');
    }

    // Logout
    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    // Returns the _api_token cookie details
    private function getCookieDetails($token)
    {
        return [
            'name' => '_api_token',
            'value' => $token,
            'minutes' => 1440,
            'path' => null,
            'domain' => null,
            //'secure' => true, //production
            'secure' => null,   //localhost
            'httponly' => true,
            'samesite' => true,
        ];
    }
}
