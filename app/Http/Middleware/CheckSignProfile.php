<?php

namespace App\Http\Middleware;

use Closure;

class CheckSignProfile
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
        $value = $request->session()->get('SignIn_id');
       
        if (!$value) {
            return redirect('/signin');
           
        }else{
           return $next($request); 
        }
        
    }


}