<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class todo_action extends Model
{
    //
    public function todo()
    {
        return $this->hasMany(todo::class) ;
    }
}
