<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Session;
class CheckIsAdmin
{
    public function handle($request, Closure $next)
    {
        if ($request->session()->get('role') != 'SUPER ADMIN') {
            if($request->session()->get('role') == 'ADMIN'){
                return redirect('review');
            } else if($request->session()->get('position') == 'Struktural'){
                return redirect('approval');
            }else{
                return redirect('alluser');
            }                        
        }
        return $next($request);                       
    }
   
}