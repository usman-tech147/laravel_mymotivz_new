<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin',
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
    public function privileges()
    {
        return $this->belongsToMany(Privileges::class) ;
    }

    public function placement()
    {
        return $this->hasMany('App\placement','recruiter_id','id') ;
    }
    public function client()
    {
        return $this->belongsToMany('App\Client') ;
    }
    public function job()
    {
        return $this->hasMany('App\Job','pipeline_id','id') ;
    }

}
