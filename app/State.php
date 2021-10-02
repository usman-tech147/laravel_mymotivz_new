<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
   public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function clients()
    {
        return $this->hasMany(NewClient::class) ;
    }
}
