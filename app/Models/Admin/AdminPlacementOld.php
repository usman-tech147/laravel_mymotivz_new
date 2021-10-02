<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminPlacementOld extends Model
{
    protected $table = "admin_placements";
    public function adminJob()
    {
        return $this->belongsTo(AdminJob::class,'job_id') ;
    }
    public function adminClient()
    {
        return $this->belongsTo(AdminClient::class,'client_id') ;
    }
    public function adminCandidate()
    {
        return $this->belongsTo(AdminCandidate::class,'candidate_id') ;
    }
    public function recruiter()
    {
        return $this->belongsTo(AdminUser::class,'recruiter_id') ;
    }
}
