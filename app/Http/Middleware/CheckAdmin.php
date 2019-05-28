<?php

namespace App\Http\Middleware;

use Closure;
//use Illuminate\Support\Facades\Auth;
use Auth;

class CheckAdmin
{

    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if((Auth::user()->role_id != 1)){
                Auth::logout();
                return redirect()->route('welcome');
            }
        }else
            return redirect()->route('welcome');

        return $next($request);
    }
}
