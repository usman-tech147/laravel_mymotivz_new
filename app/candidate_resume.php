<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candidate_resume extends Model
{
    protected $fillable = ['resume' , 'candidate_id'] ;

    public function new_candidate()
    {
        return $this->belongsTo(NewCandidate::class) ;
    }

    public function applied_jobs()
    {
        return $this->hasMany(Applied_Jobs::class, 'resume_id','id');
    }
}
