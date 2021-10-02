<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    public function candidates()
    {
        return $this->hasMany(NewCandidate::class) ;
    }
    public function clients()
    {
        return $this->hasMany(NewClient::class) ;
    }
    public function applied_jobs()
    {
        return $this->hasMany(Applied_Jobs::class) ;
    }
    public function user_jobs()
    {
        return $this->hasMany(user_job::class) ;
    }
    public function recruitment_service()
    {
        return $this->hasMany(recruitment_service::class) ;
    }
}
