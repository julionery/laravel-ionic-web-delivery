<?php

namespace WebDelivery\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tipo)
    {
        if(!Auth::check())
        {
            return redirect('/auth/login');
        }

        if(Auth::user()->tipo <> $tipo && Auth::user()->tipo != 'desenvolvedor')
        {
            return redirect('/auth/login');
        }


        return $next($request);
    }
}
