<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DeactiveUser
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
        if (Auth::guard('web')->check()){
            if (Auth::user()->status==0&&Auth::user()->balance>0){
                return redirect('/')->with(['message'=>'you are blocked and just you can transfer your balance to your bank account','color'=>'red']);
            }
        }
        return $next($request);
    }
}
