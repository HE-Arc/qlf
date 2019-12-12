<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    // game's users (players)
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    // game's creator
    public function created_by()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
