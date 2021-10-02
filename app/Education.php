<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = ['name'] ;

    public function candidates()
    {
        return $this->hasMany(NewCandidate::class) ;
    }
    public function user_jobs()
    {
        return $this->hasMany(user_job::class) ;
    }
    public function recruitment()
    {
        return $this->hasMany(recruitment_service::class) ;
    }
}
