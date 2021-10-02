<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
   protected $fillable = ['description' , 'employer_id' , 'client_id'];

   public function client()
   {
       return $this->belongsTo(Client::class);
   }
}
