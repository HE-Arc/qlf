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
     * Returns an informative response with the given message.
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    protected function responseInfo($message)
    {
        return response()->json([
            'status' => 'INFO',
            'message' => $message,
        ], 200);
    }

    /**
     * Returns a success response with the given message.
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    protected function responseSuccess($message)
    {
        return response()->json([
            'status' => 'SUCCESS',
            'message' => $message,
        ], 200);
    }

    /**
     * Returns a warning response with the given message.
     * @param  [type] $message [description]
     * @return [type]          [description]
     */
    protected function responseWarning($message)
    {
        return response()->json([
            'status' => 'WARNING',
            'message' => $message,
        ], 200);
    }

    /**
     * Returns an error response with the given validator error.
     * @param  [type] $validator [description]
     * @return [type]            [description]
     */
    protected function responseError($validator)
    {
        return response()->json([
            'status' => 'ERROR',
            'message' => $validator->errors()->first(),
        ], 200);
    }
}
