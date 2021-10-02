<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privileges extends Model
{
    //
    public function user()
    {
        return $this->belongsToMany(User::class) ;
    }
}
