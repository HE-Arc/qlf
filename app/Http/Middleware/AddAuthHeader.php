<?php

namespace App\Http\Middleware;

use Closure;

/**
 * API cookie authenticating for requests without the
 * headers « Authorization » option.
 */
class AddAuthHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Request without the « Authorization » option
        if (! $request->bearerToken())
        {
            if ($request->hasCookie('_api_token'))
            {
                // Adds the _api_token cookie value to the request headers
                $token = $request->cookie('_api_token');
                $request->headers->add(['Authorization' => 'Bearer ' . $token]);
            }
        }

        return $next($request);
    }
}
