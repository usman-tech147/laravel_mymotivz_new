<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PaymentDetailsMiddleware
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
        if(!session()->has('c_email')){
            return redirect()->route('user.login');
        }
        return $next($request);
    }
}
