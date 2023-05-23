<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Session;
class CheckIsLogin
{
    public function handle($request, Closure $next)
    {
        if (!$request->session()->get('login')) {
            return redirect('/login');
        }

        return $next($request);                       
    }
   
}