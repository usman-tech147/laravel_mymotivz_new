<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class NewCandidate extends Model
{
    protected $fillable = ['name','job_title','phone','email','location','city','state','salary','skills','interest','experience','education_id','industry','status_id'/*,'employer'*/,'password','code','random_code'];
    protected $appends=['encrypted_candidate_id'];
    public function getEncryptedCandidateIdAttribute()
    {
        return Crypt::encrypt($this->id);
    }

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
    public function candidate_resume()
    {
        return $this->hasMany(candidate_resume::class) ;
    }
    public function education()
    {
        return $this->belongsTo(Education::class) ;
    }
    public function industry(){
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }
    public function favourite_job()
    {
        return $this->hasMany(favourite_job::class) ;
    }
    public function applied_job()
    {
        return $this->hasMany(Applied_Jobs::class ) ;
    }
    public function career_job_notify()
    {
        return $this->hasMany(career_job_notify::class) ;
    }

}
