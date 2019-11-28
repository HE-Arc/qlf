<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //to link to game timestamps
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
