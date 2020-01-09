<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const COOKIE_API_TOKEN_NAME = '_api_token';

    // Returns an API token based on the current user
    protected function getApiToken()
    {
        return $user->createToken('qlf')->accessToken;
    }

    // Returns an API token cookie based on the current user
    protected function getApiTokenCookie()
    {
        $user = Auth::user();

        // Creates the _api_token cookie
        $token = $this->getApiToken();
        $cookie = $this->getCookieDetails($token);

        return \Cookie::make($cookie['name'],
            $cookie['value'],
            $cookie['minutes'],
            $cookie['path'],
            $cookie['domain'],
            $cookie['secure'],
            $cookie['httponly'],
            $cookie['samesite']);
    }

    // Forgets the API token cookie
    protected function forgetApiTokenCookie()
    {
        return \Cookie::forget(self::COOKIE_API_TOKEN_NAME);
    }

    /**
     * Returns a Validator based on the given request and rules.
     * @param  Request $request [description]
     * @param  [type]  $rules   [description]
     * @return [type]           [description]
     */
    protected function validateJson(Request $request, $rules)
    {
        return Validator::make($request->json()->all(), $rules);
    }

    /**
     * Returns a JSON response with the given message and status.
     * @param  [type] $message [description]
     * @param  [type] $status  [description]
     * @param  array  $vars    [description]
     * @return [type]          [description]
     */
    protected function responseJson($message, $status, $vars = [])
    {
        $json = $vars;
        $json['status'] = $status;
        $json['message'] = $message;

        return response()->json($json, 200);
    }

    /**
     * Returns an informative response with the given message.
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    protected function responseInfo($message, $vars = [])
    {
        return $this->responseJson($message, 'INFO', $vars);
    }

    /**
     * Returns a success response with the given message.
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    protected function responseSuccess($message, $vars = [])
    {
        return $this->responseJson($message, 'SUCCESS', $vars);
    }

    /**
     * Returns a warning response with the given message.
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    protected function responseWarning($message, $vars = [])
    {
        return $this->responseJson($message, 'WARNING', $vars);
    }

    /**
     * Returns an error response with the given validator error.
     * @param  [type] $validator [description]
     * @return [type]            [description]
     */
    protected function responseError($message, $vars = [])
    {
        return $this->responseJson($message, 'ERROR', $vars);
    }

    // Returns the _api_token cookie details
    private function getCookieDetails($token)
    {
        $secure = (app()->environment() == 'production' ? true : null);

        return [
            'name' => self::COOKIE_API_TOKEN_NAME,
            'value' => $token,
            'minutes' => 1440,
            'path' => null,
            'domain' => null,
            'secure' => $secure,
            'httponly' => true,
            'samesite' => true,
        ];
    }
}
