<?php

namespace App\Policies;

use App\User;
use App\Resume;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResumePolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->is_super_admin==1) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any resumes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function download(User $user)
    {
        //
        $check =0;

        $current_user = User::with('privileges')->find(Auth::id());
        foreach ($current_user['privileges'] as $policies)
        {
            if($policies->name =='Download Resumes')
            {
                $check=1;
            }
        }
        return $check;
    }
    /**
     * Determine whether the user can delete the resume.
     *
     * @param  \App\User  $user
     * @param  \App\Resume  $resume
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        $check =0;

        $current_user = User::with('privileges')->find(Auth::id());
        foreach ($current_user['privileges'] as $policies)
        {
            if($policies->name =='Delete Resumes')
            {
                $check=1;
            }
        }
        return $check;
    }

}
