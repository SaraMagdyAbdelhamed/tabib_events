<?php

namespace App\Http\Middleware;

use Helper;
use Closure;

class SetLocale
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
        $locale = Helper::getUserLocale();
        \App::setLocale($locale);
        \Session::put('locale', $locale);

        return $next($request);
    }
}
