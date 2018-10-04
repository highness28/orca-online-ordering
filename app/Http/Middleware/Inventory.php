<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Inventory
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
        if(in_array(Auth::user()->role, [1,3])) {
            return $next($request);
        }
        
        return redirect('/');
    }
}
