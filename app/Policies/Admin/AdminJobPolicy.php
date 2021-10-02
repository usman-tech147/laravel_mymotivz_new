<?php

namespace App\Policies\Admin;

use App\Models\Admin\AdminUser;
use App\Models\Admin\AdminJob;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AdminJobPolicy
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
        //
        $check =0;

        $current_user = AdminUser::with('adminPrivileges')->find(Auth::id());
        foreach ($current_user['adminPrivileges'] as $policies)
        {
            if($policies->name =='Add New Job')
            {
                $check=1;
            }
        }
        return $check;

    }

    public function delete(AdminUser $user)
    {
        $check =0;
        $current_user = AdminUser::with('adminPrivileges')->find(Auth::id());
        foreach ($current_user['adminPrivileges'] as $policies)
        {
            if($policies->name =='Delete All Jobs')
            {
                $check=1;
            }
        }
        return $check;
    }
    public function import()
    {
        $check =0;

        $current_user = AdminUser::with('adminPrivileges')->find(Auth::id());
        foreach ($current_user['adminPrivileges'] as $policies)
        {
            if($policies->name =='Import Data')
            {
                $check=1;
            }
        }
        return $check;
    }
}
