<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminScheduleInterview extends Model
{
    protected $table = "admin_schedule_interviews";

    public function adminJobs()
    {
        return $this->belongsTo(AdminJob::class,'admin_job_id') ;
    }
    public function adminClients()
    {
        return $this->belongsTo(AdminClient::class, 'admin_client_id') ;
    }
    public function adminStatus()
    {
        return $this->belongsTo(AdminStatus::class, 'admin_status_id') ;
    }
    public function adminCandidates()
    {
        return $this->belongsTo(AdminCandidate::class,'admin_candidate_id') ;
    }
    public function adminReceiverEmail()
    {
        return $this->hasMany(AdminReceiverEmail::class,'interview_id','id') ;
    }
}
