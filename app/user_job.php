<?php

namespace App;

use App\Models\Admin\AdminUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class user_job extends Model
{
    //
    protected $appends=['encrypted_job_id','active','expire','mymotivz_title','mymotivz_logo'];
    public function getEncryptedJobIdAttribute(){
        return Crypt::encrypt($this->id);
    }
    public function getActiveAttribute(){
        return getHumanDate($this->created_at);
    }
    public function getExpireAttribute(){
        return getHumanDate($this->applied_before);
    }
    public function getMymotivzTitleAttribute()
    {
        return "MyMotivz";
    }
    public function getMymotivzLogoAttribute()
    {
        return "admin-profile-image.jpg";
    }
    protected $guarded=[];

    public function client(){
        return $this->belongsTo(NewClient::class, 'client_id', 'id');
    }
    public function admin()
    {
        return $this->belongsTo(AdminUser::class, 'admin_id','id');
    }
    public function industry(){
        return $this->belongsTo(Industry::class, 'industry_id', 'id');
    }
    public function candidates()
    {
        return $this->belongsToMany(NewCandidate::class) ;
    }
    public function favourite_job()
    {
        return $this->hasMany(favourite_job::class,'job_id','id') ;
    }
    public function applied_job()
    {
        return $this->hasMany(Applied_Jobs::class,'job_id','id') ;
    }
    public function education()
    {
        return $this->belongsTo(Education::class, 'education_id', 'id') ;
    }
}
