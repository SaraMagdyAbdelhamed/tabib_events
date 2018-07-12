<?php

namespace App\Http\Middleware;

use Session; 
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // \App::setLocale(\Request::segment(1));
            // return redirect(\Request::segment(1).'/main');
            return redirect('/about' );
        }

        return $next($request);
    }
}
