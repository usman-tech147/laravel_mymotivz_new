<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminEducation extends Model
{
    protected $table = "admin_educations";
    protected $fillable = ['name'] ;

    public function adminCandidates()
    {
        return $this->hasMany(AdminCandidate::class) ;
    }
}
