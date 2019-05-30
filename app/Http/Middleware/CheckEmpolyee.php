<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckEmpolyee
{

    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            if ((Auth::user()->role_id != 2 )) {
                Auth::logout();
                return redirect()->route('login');
            }
        }else
            return redirect()->route('login');

        return $next($request);
    }
}
