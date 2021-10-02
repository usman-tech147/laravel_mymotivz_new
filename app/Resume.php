<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = ['resume' , 'candidate_id'] ;
    public function candidate()
    {
        return $this->belongsTo(Candidate::class) ;
    }
}
