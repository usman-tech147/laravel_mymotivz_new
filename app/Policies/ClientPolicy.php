<?php

namespace App\Policies;

use App\User;
use App\Client;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ClientPolicy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        if ($user->is_super_admin==1) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any clients.
     *
     * @param  \App\User  $user
     * @return mixed
     */
//    public function viewAny(User $user)
//    {
//        //
//    }

    /**
     * Determine whether the user can view the client.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
//    public function view(User $user, Client $client)
//    {
//        //
//    }

    /**
     * Determine whether the user can create clients.
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
            if($policies->name =='Add New Client')
            {
                $check=1;
            }
        }
        return $check;
    }

    /**
     * Determine whether the user can update the client.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
//    public function update(User $user, Client $client)
//    {
//        //
//    }

    /**
     * Determine whether the user can delete the client.
     *
     * @param  \App\User  $user
     * @param  \App\Client  $client
     * @return mixed
     */
    public function delete(User $user)
    {
        //
        $check =0;

        $current_user = User::with('privileges')->find(Auth::id());
        foreach ($current_user['privileges'] as $policies)
        {
            if($policies->name =='Delete Clients')
            {
                $check=1;
            }
        }
        return $check;
    }


}
