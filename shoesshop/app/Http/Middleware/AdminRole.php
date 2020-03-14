<?php

namespace App\Http\Middleware;

use Closure;
use  Auth;
use User;

class AdminRole
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
        if (Auth::check() && Auth::user()->cv_ma==1) {
            return $next($request);
        }
        else{
             return view("admin_login");
        }
    }
}
