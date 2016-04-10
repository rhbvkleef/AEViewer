<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        if (!Auth::guard($guard)->user()) {
            if ($request->ajax() || $request->wantsJson() || $guard == 'api') {
                return response()
    			->json(['status' => 'fail', 'reason' => 'auth'])
    			->setStatusCode(401, 'Authentication failed');
            } else {
                return redirect()->guest('login');
            }
        }else return $next($request);
    }
}
