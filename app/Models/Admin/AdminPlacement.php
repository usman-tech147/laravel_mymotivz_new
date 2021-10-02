<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminPlacement extends Model
{
    protected $table = "admin_placements";
    public function adminJob()
    {
        return $this->belongsTo(AdminJob::class) ;
    }
    public function adminClient()
    {
        return $this->belongsTo(AdminClient::class) ;
    }
    public function adminCandidate()
    {
        return $this->belongsTo(AdminCandidate::class) ;
    }
    public function recruiter()
    {
        return $this->belongsTo(AdminUser::class,'recruiter_id') ;
    }
}
