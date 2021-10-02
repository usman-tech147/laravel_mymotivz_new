<?php

namespace App\Http\Middleware;

use Closure;

class UserNotAuth
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
        if(!session()->has('candidate_id') && !session()->has('c_email'))
        {
            return $next($request);
        }
        elseif(session()->has('candidate_id'))
        {
            return redirect()->route('candidate.dashboard');
        }
        elseif(session()->has('c_email'))
        {
            return redirect()->route('user.client.dashboard');
        }

    }
}
