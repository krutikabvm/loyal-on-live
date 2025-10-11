<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminWebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         if (Auth::guard('web')->check() ){

            if(Auth::guard('web')->user()->type ==1) {
                return $next($request);
            }else{
                abort(404);  //404 page
            }
        } 
        else {
            return redirect()->route("login"); 
        }
    }
}
