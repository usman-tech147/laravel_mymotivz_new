<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminPrivileges extends Model
{
    protected $table = "admin_privileges";
    public function adminUsers()
    {
        return $this->belongsToMany(AdminUser::class) ;
    }
}
