<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gamesheet extends Model
{
    protected $table = 'gamesheets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'template', 'downloads', 'user_id',
    ];

    // gamesheet's creator
    public function created_by()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
