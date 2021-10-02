<?php

namespace App;

use function foo\func;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Candidate extends Model
{
    protected $fillable = ['name','job_title','phone','email','city','state','salary','skills','interest','experience','education_id','Industry','status_id','employer','password','code','random_code'];


    public function status()
    {
        return $this->belongsTo(Status::class) ;
    }
//    public function interview()
//    {
//        return $this->hasMany(schedule_interview::class) ;
//    }

    public function notes()
    {
        return $this->hasMany(Note::class) ;
    }

    public function resumes()
    {
        return $this->hasMany(Resume::class) ;
    }

    public function education()
    {
        return $this->belongsTo(Education::class) ;
    }
    public function industry()
    {
        return $this->belongsTo(Industry::class) ;
    }

//    public function jobs()
//    {
//        return $this->belongsToMany(Job::class) ;
//    }
    public function favourite_job()
    {
        return $this->hasMany(favourite_job::class) ;
    }
    public function user_jobs()
    {
        return $this->belongsToMany(user_job::class) ;
    }
}




