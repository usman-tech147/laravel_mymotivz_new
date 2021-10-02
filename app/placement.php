<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class placement extends Model
{
    //
    public function jobs()
    {
        return $this->belongsTo('App\Job','job_id') ;
    }
    public function clients()
    {
        return $this->belongsTo('App\Client','client_id') ;
    }
    public function candidates()
    {
        return $this->belongsTo('App\Candidate','candidate_id') ;
    }
    public function recruiter()
    {
        return $this->belongsTo('App\User','recruiter_id') ;
    }
}
