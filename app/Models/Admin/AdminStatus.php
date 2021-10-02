<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminStatus extends Model
{
    protected $table = "admin_statuses";
    protected $fillable = ['name' , 'color'] ;

    public function adminCandidates()
    {
        return $this->hasMany(AdminCandidate::class) ;
    }
}
