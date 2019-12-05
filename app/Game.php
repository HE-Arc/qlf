<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name', 'created_by', 'scores', 'gamesheet_id'
    ];

    //to link to game timestamps
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function gamesheet()
    {
        return $this->belongsTo('App\Gamesheet');
    }
}
