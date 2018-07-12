<?php

namespace App\Http\Middleware;
use Helper;
use Closure;

class RuleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$rule)
    {
      if(Helper::hasRule($rule)){
       return $next($request);
      }
      return redirect('/');
      }
  }
