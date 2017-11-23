<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsModerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->user()->role_id == 1 || Auth::guard($guard)->user()->role_id == 3) {
            return $next($request);
        }

        return response()->json(
            [
            'status'    =>  false,
            'message'   =>  'Unauthorized request!'
            ], 401
        );
    }
}
