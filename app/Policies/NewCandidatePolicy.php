<?php

namespace App\Policies;

use App\User;
use App\Candidate;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class NewCandidatePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->is_super_admin==1) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any candidates.
     *
     * @param  \App\User  $user
     * @return mixed
     */
//    public function viewAny(User $user)
//    {
//        //
//    }

    /**
     * Determine whether the user can view the candidate.
     *
     * @param  \App\User  $user
     * @param  \App\Candidate  $candidate
     * @return mixed
     */
//    public function view(User $user, Candidate $candidate)
//    {
//        //
//    }

    /**
     * Determine whether the user can create candidates.
     *
     * @param  \App\User  $user
     * @return mixed
     */

    public function import()
    {
        $check =0;

        $current_user = User::with('privileges')->find(Auth::id());
        foreach ($current_user['privileges'] as $policies)
        {
            if($policies->name =='Import Data')
            {
                $check=1;
            }
        }
        return $check;
    }


    public function create(User $user)
    {
        //
        $check =0;

        $current_user = User::with('privileges')->find(Auth::id());
        foreach ($current_user['privileges'] as $policies)
        {
            if($policies->name =='Add New Candidate')
            {
                $check=1;
            }
        }
        return $check;
    }

    /**
     * Determine whether the user can update the candidate.
     *
     * @param  \App\User  $user
     * @param  \App\Candidate  $candidate
     * @return mixed
     */
//    public function update(User $user, Candidate $candidate)
//    {
//        //
//    }

    /**
     * Determine whether the user can delete the candidate.
     *
     * @param  \App\User  $user
     * @param  \App\Candidate  $candidate
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        $check =0;

        $current_user = User::with('privileges')->find(Auth::id());
        foreach ($current_user['privileges'] as $policies)
        {
            if($policies->name =='Delete Candidates')
            {
                $check=1;
            }
        }
        return $check;
    }

    /**
     * Determine whether the user can restore the candidate.
     *
     * @param  \App\User  $user
     * @param  \App\Candidate  $candidate
     * @return mixed
     */
//    public function restore(User $user, Candidate $candidate)
//    {
//        //
//    }

    /**
     * Determine whether the user can permanently delete the candidate.
     *
     * @param  \App\User  $user
     * @param  \App\Candidate  $candidate
     * @return mixed
     */
//    public function forceDelete(User $user, Candidate $candidate)
//    {
//        //
//    }
}
