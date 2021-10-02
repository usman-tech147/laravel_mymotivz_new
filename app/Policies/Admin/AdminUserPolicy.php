<?php

namespace App\Policies\Admin;

use App\Models\Admin\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AdminUserPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->is_super_admin==1) {
            return true;
        }
    }

    public function create(AdminUser $user)
    {
        $check =0;
        $current_user = AdminUser::with('adminPrivileges')->find(Auth::id());

        foreach ($current_user['adminPrivileges'] as $policies)
        {
            if($policies->name =='Add New Employee')
            {
                $check=1;
            }
        }
        return $check;
    }
}
