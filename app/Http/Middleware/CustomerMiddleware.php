<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CustomerMiddleware
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
        
      
       if (Auth::guard('api')->check() && Auth::guard('api')->user()->type ==3) {
            if(Auth::guard('api')->user()->delete == 0){
                return $next($request);
            }else {
                $message =[];
                $message['success']= false;
                $message['message'] =  "Your account is deactivated";
                $message['data']=  ["error"=> "Unauthorised"];
                return response($message, 401);
            }
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
