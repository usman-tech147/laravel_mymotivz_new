<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = [
        'jobtitle', 'city', 'state', 'web_url', 'package', 'industry', 'service', 'recruitment_pipeline', 'job_discription', 'client_id',
    ];
    //    public function interview()
    //    {
    //        return $this->hasMany(schedule_interview::class) ;
    //    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class);
    }
    public function pipeline()
    {
        return $this->belongsTo('App\User', 'pipeline_id', 'id');
    }
}
