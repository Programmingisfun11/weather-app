<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureApiExists
{

    public function handle(Request $request, Closure $next)
    {
        $api_key = config('api.api_key');

     
        ($api_key == null) ? $request->attributes->add(['api_key' => 'API KEY IS REQUIRED']) : $request->attributes->add(['api_key' => $api_key]);


        return $next($request);
    }
}