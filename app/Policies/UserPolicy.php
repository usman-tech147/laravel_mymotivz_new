<?php

namespace App\Policies;

use App\Models\Admin\AdminUser;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        if ($user->is_super_admin==1) {
            return true;
        }
    }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
//    public function viewAny(User $user)
//    {
//        //
//    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
//    public function view(User $user, User $model)
//    {
//        //
//    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(AdminUser $user)
    {
        //
        $check =0;
        $current_user = User::with('privileges')->find(Auth::id());

        foreach ($current_user['privileges'] as $policies)
        {
            if($policies->name =='Add New Employee')
            {
                $check=1;
            }
        }
        return $check;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
//    public function update(User $user, User $model)
//    {
//        //
//    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
//    public function delete(User $user, User $model)
//    {
//        //
//    }


}
