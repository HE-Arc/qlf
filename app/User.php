<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // games this user is currently playing
    public function games()
    {
        return $this->belongsToMany('App\Game')->withTimestamps();
    }

    // games this user has created (in 'games' table)
    public function created_games()
    {
        return $this->hasMany('App\Game');
    }

    // gamesheets this user has created (in 'gamesheets' table)
    public function created_gamesheets()
    {
        return $this->hasMany('App\Gamesheet');
    }

}
