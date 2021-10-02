<?php

namespace App\Policies;

use App\User;
use App\placement;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class placementPolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->is_super_admin==1) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any placements.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        $check =0;

        $current_user = User::with('privileges')->find(Auth::id());
        foreach ($current_user['privileges'] as $policies)
        {
            if($policies->name =='View All Placement')
            {
                $check=1;
            }
        }
        return $check;
    }

    /**
     * Determine whether the user can view the placement.
     *
     * @param  \App\User  $user
     * @param  \App\placement  $placement
     * @return mixed
     */
//    public function hasplacement(User $user)
//    {
//        //
//        $check =0;
//        $count = User::has('placement')->where('id',Auth::id())->count();
//        if($count!=0)
//        {
//            $check=1;
//        }
//        return $check;
//
//    }

    public function view(User $user, placement $placement)
    {
        //
        $check =0;

        if($placement->recruiter_id==Auth::id())
        {
            $check=1;
        }
        return $check;

    }


}
