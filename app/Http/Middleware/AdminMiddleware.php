<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
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
         if (Auth::guard('api')->check() && Auth::guard('api')->user()->type ==1) {
             
            return $next($request);
    } 
    else {
        
        $message =[];
        $message['success']= false;
        $message['message'] =  "Unauthorised";
        $message['data']=  ["error"=> "Unauthorised"];
        return response($message, 401);
    }
    }
}
