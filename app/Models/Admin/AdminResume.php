<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminResume extends Model
{
    protected $table = "admin_resumes";
    protected $fillable = ['resume' , 'admin_candidate_id'] ;
    public function adminCandidate()
    {
        return $this->belongsTo(AdminCandidate::class) ;
    }
}
