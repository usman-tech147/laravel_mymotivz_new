<?php

namespace App\Http\Middleware;

use App\NewCandidate;
use Closure;
use Illuminate\Support\Facades\Route;
class CandidateProfileAuth
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
        $candidate = NewCandidate::where('id',session()->get('candidate_id'))->first();
        if(is_null($candidate->name) || empty($candidate->name))
        {
            if(Route::currentRouteName()=='candidate.view.personal.details'
                || Route::currentRouteName()=='candidate.save.personal.details'
                || Route::currentRouteName()=='delete.candidate.account')
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('candidate.view.personal.details');
            }

        }
        elseif(is_null($candidate->job_title))
        {
            if(Route::currentRouteName()=='candidate.view.personal.job.details'
                || Route::currentRouteName()=='candidate.save.personal.job.details'
                || Route::currentRouteName()=='candidate.view.personal.details'
                || Route::currentRouteName()=='candidate.save.personal.details'
                || Route::currentRouteName()=='delete.candidate.account')
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('candidate.view.personal.job.details');
            }
        }
        elseif(is_null($candidate->education_id))
        {
            if(Route::currentRouteName()=='candidate.view.skills.details'
                || Route::currentRouteName()=='candidate.save.skills.details'
                || Route::currentRouteName()=='candidate.view.personal.job.details'
                || Route::currentRouteName()=='candidate.save.personal.job.details'
                || Route::currentRouteName()=='candidate.view.personal.details'
                || Route::currentRouteName()=='candidate.save.personal.details'
                || Route::currentRouteName()=='delete.candidate.account'
            )
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('candidate.view.skills.details');
            }
        }
        elseif(is_null($candidate->salary))
        {
            if(Route::currentRouteName()=='candidate.view.salary.details'
                || Route::currentRouteName()=='candidate.save.salary.details'
                || Route::currentRouteName()=='candidate.view.skills.details'
                || Route::currentRouteName()=='candidate.save.skills.details'
                || Route::currentRouteName()=='candidate.view.personal.job.details'
                || Route::currentRouteName()=='candidate.save.personal.job.details'
                || Route::currentRouteName()=='candidate.view.personal.details'
                || Route::currentRouteName()=='candidate.save.personal.details'
                || Route::currentRouteName()=='delete.candidate.account')
            {

                return $next($request);
            }
            else
            {
                return redirect()->route('candidate.view.salary.details');
            }
        }
        else
        {
            return $next($request);
        }

    }
}

