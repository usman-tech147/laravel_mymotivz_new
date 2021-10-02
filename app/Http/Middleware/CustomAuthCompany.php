<?php

namespace App\Http\Middleware;

use Closure;

class CustomAuthCompany
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
        if( session()->has('c_email') ) {

            return $next($request);
        }else{

            return redirect()->route('user.login') ;
        }
    }
}
