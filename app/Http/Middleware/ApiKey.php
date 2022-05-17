<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiKey
{
    public function handle(Request $request, Closure $next)
    {
        if (! $access_token = $request->headers->get('Api-Key')) {
            return response()->json(['message' => 'token is not provided'], 401);
        }

        if (! cache()->has($access_token)) {
            return response()->json(['message' => 'token is invalid'], 401);
        }

        return $next($request);
    }
}
