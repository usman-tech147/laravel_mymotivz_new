<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewClient extends Model
{
    protected $fillable = [
        'company_name', 'name',
        'job_title','phone','email','city',
        'state','web_url','package','job_opening',
        'industry','service','note','job_discription',
        'recruitment_pipeline,code,',
        'password','code','random_code'
    ];
    public function notes()
    {
        return $this->hasMany(Note::class , 'client_id')->orderBy('created_at', 'desc');
    }
//    public function jobs(){
//        return $this->hasMany(Job::class,'client_id','id');
//    }
    public function user_jobs(){
        return $this->hasMany(user_job::class,'client_id','id');
    }
    public function contracts(){
        return $this->hasMany('App\contract','client_id');
    }
    public function pipeline(){
        return $this->belongsToMany('App\User');
    }
    public function industry(){
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }
    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function state(){
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
}
