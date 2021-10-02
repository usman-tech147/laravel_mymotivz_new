<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Applied_Jobs extends Model
{
    protected $appends=['applied_date'];
    public function getAppliedDateAttribute()
    {
        return getHumanDate($this->created_at);
    }
    public function job()
    {
        return $this->belongsTo(user_job::class,'job_id','id') ;
    }
//    public function candidate()
//    {
//        return $this->belongsTo(Candidate::class,'candidate_id','id') ;
//    }
    public function candidate()
    {
        return $this->belongsTo(NewCandidate::class,'candidate_id','id') ;
    }
//    public function resume()
//    {
//        return $this->belongsTo(Resume::class,'resumed_id','id') ;
//    }
    public function candidate_resume()
    {
        return $this->belongsTo(candidate_resume::class,'resumed_id','id') ;
    }
    public function industry(){
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }



}
