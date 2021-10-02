<?php

namespace App\Models\Admin;

use function foo\func;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class AdminCandidate extends Model
{
    protected $table = "admin_candidates";
    protected $fillable = ['name', 'job_title', 'phone', 'email', 'city', 'state', 'salary', 'skills', 'interest', 'experience', 'admin_education_id', 'Industry', 'admin_status_id', 'employer'];


    public function adminStatus()
    {
        return $this->belongsTo(AdminStatus::class);
    }

    public function adminNotes()
    {
        return $this->hasMany(AdminNote::class);
    }

    public function adminResumes()
    {
        return $this->hasMany(AdminResume::class);
    }

    public function adminEducation()
    {
        return $this->belongsTo(AdminEducation::class,'education_id');
    }

    public function adminJobs()
    {
        return $this->belongsToMany(AdminJob::class);
    }

}

//    public function interview()
//    {
//        return $this->hasMany(schedule_interview::class) ;
//    }



