<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckGuest
{

    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            if ((Auth::user()->role_id != 3 )) {
                Auth::logout();
                return redirect()->route('login');
            }
        }else
            return redirect()->route('login');

        return $next($request);
    }
}
