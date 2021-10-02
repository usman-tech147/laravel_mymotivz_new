<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminJob extends Model
{
    protected $table = "admin_jobs";
    protected $fillable = [
        'jobtitle', 'city', 'state', 'web_url', 'package', 'industry', 'service', 'recruitment_pipeline', 'job_discription', 'client_id',
    ];

    public function adminClient()
    {
        return $this->belongsTo(AdminClient::class, 'admin_client_id', 'id');
    }

    public function adminCandidates()
    {
        return $this->belongsToMany(AdminCandidate::class,'admin_candidate_job');
    }

    public function pipeline()
    {
        return $this->belongsTo(AdminUser::class, 'pipeline_id', 'id');
    }
}

//    public function interview()
//    {
//        return $this->hasMany(schedule_interview::class) ;
//    }
