<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class  AdminClient extends Model
{
    protected $table = "admin_clients";
    protected $fillable = [
        'company_name', 'name', 'job_title','phone','email','city','state','web_url','package','job_opening','industry','service','note','job_discription','recruitment_pipeline',
    ];

    public function adminNotes()
    {
        return $this->hasMany(AdminNote::class , 'admin_client_id')->orderBy('created_at', 'desc');
    }
    public function adminJobs(){
        return $this->hasMany(AdminJob::class,'admin_client_id','id');
    }
    public function adminContracts(){
        return $this->hasMany(AdminContract::class,'admin_client_id');
    }
    public function pipeline(){
        return $this->belongsToMany(AdminUser::class,'admin_client_users');
    }

}
