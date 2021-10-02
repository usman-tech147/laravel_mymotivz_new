<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class favourite_job extends Model
{
    protected $fillable = ['job_id' , 'candidate_id'] ;
    public function candidate()
    {
        return $this->belongsTo(new_candidate::class) ;
    }
//    public function candidate()
//    {
//        return $this->belongsTo(Candidate::class) ;
//    }
    public function job()
    {
        return $this->belongsTo(user_job::class) ;
    }
}
