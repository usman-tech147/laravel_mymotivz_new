<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminInterviewStatus extends Model
{
    protected $table = "admin_interview_statuses";
    protected $fillable = ['name' , 'color'] ;
}
