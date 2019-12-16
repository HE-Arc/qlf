<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
}
