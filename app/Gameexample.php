<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * This is an example class, just to get an idea and interact with API
 */
class Gameexample extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}
