<?php

namespace App\Models\Admin;

use App\user_job;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    use Notifiable;
    protected $table = "admin_users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'phone_no',
        'hiring_date',
        'job_title',
        'home_address',
        'description',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function adminPrivileges()
    {
        return $this->belongsToMany(AdminPrivileges::class,'admin_privileges_users');
    }
    public function user_jobs(){
        return $this->hasMany(user_job::class,'admin_id','id');
    }
    public function adminPlacement()
    {
        return $this->hasMany(AdminPlacement::class,'recruiter_id','id') ;
    }
    public function adminClient()
    {
        return $this->belongsToMany(AdminClient::class,'admin_client_users') ;
    }
    public function adminJob()
    {
        return $this->hasMany(AdminJob::class,'pipeline_id','id') ;
    }

}
