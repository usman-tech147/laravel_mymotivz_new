<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class schedule_interview extends Model
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
    public function status()
    {
        return $this->belongsTo('App\Status','status_id') ;
    }
    public function candidates()
    {
        return $this->belongsTo('App\Candidate','candidate_id') ;
    }
    public function receiver_emails()
    {
        return $this->hasMany('App\receiver_email','interview_id','id') ;
    }
}
