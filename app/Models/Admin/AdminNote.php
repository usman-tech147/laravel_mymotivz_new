<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdminNote extends Model
{
    protected $table = "admin_notes";
    protected $fillable = ['description', 'admin_user_id', 'admin_client_id'];

    public function adminClient()
    {
        return $this->belongsTo(AdminClient::class,'admin_client_id');
    }
}
