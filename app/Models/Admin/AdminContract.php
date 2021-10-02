<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminContract extends Model
{
    protected $table = "admin_contracts";
    public function adminClient()
    {
        return $this->belongsTo(AdminClient::class,'admin_client_id') ;
    }
}
