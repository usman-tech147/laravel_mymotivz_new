<?php

namespace App\Policies;

use App\User;
use App\contract;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class contractPolicy
{
    use HandlesAuthorization;
    public function before($user, $ability)
    {
        if ($user->is_super_admin==1) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any contracts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        //
        $check =0;

        $current_user = User::with('privileges')->find(Auth::id());
        foreach ($current_user['privileges'] as $policies)
        {
            if($policies->name =='View Contracts')
            {
                $check=1;
            }
        }
        return $check;
    }

    /**
     * Determine whether the user can view the contract.
     *
     * @param  \App\User  $user
     * @param  \App\contract  $contract
     * @return mixed
     */
//    public function view(User $user, contract $contract)
//    {
//        //
//
//    }

    /**
     * Determine whether the user can create contracts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
//    public function create(User $user)
//    {
//        //
//
//    }

    /**
     * Determine whether the user can update the contract.
     *
     * @param  \App\User  $user
     * @param  \App\contract  $contract
     * @return mixed
     */
//    public function update(User $user, contract $contract)
//    {
//        //
//    }

    /**
     * Determine whether the user can delete the contract.
     *
     * @param  \App\User  $user
     * @param  \App\contract  $contract
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        $check =0;

        $current_user = User::with('privileges')->find(Auth::id());
        foreach ($current_user['privileges'] as $policies)
        {
            if($policies->name =='Delete Contracts')
            {
                $check=1;
            }
        }
        return $check;
    }


}
