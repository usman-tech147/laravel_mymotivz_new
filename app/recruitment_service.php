<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recruitment_service extends Model
{
    protected $guarded=[];
    protected $appends=['company_logo'];
    public function getCompanyLogoAttribute()
    {
        return NewClient::find(session('c_email.id'))->only('logo');
    }
    public function industry(){
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }
    public function education()
    {
        return $this->belongsTo(Education::class, 'education_id', 'id') ;
    }
}
