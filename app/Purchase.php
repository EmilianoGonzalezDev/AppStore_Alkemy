<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'user_id', 'app_id'
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function app()
    {
        return $this->belongsTo('App\App');
    }
}
