<?php

namespace FleetCart\Http\Middleware;

use Closure;

class ApiAuthKey
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
        $token = $request->header('token');
        if(!$token) {
            return response()->json(['message' => 'App key not found'], 401);
        }
        if ($token != config('app.API_KEY')) {
            return response()->json(['message' => 'App key is incorrect. Note - your key is ' . $token], 401);
        }
        return $next($request);
    }
}
