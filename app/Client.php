<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class  Client extends Model
{
    protected $fillable = [
        'company_name', 'name', 'job_title', 'phone', 'email', 'city', 'state', 'web_url', 'package', 'job_opening', 'industry', 'service', 'note', 'job_discription', 'recruitment_pipeline',
    ];


    public function notes()
    {
        return $this->hasMany(Note::class, 'client_id')->orderBy('created_at', 'desc');
    }
    public function jobs()
    {
        return $this->hasMany(Job::class, 'client_id', 'id');
    }
    public function contracts()
    {
        return $this->hasMany('App\contract', 'client_id');
    }
    public function pipeline()
    {
        return $this->belongsToMany('App\User');
    }
}
