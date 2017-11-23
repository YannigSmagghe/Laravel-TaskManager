<?php

namespace App\Http\Middleware;

use Closure;

use Auth;

class IsUserActive
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
        if (Auth::guard($guard)->user()->is_active == 1) {
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
