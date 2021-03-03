<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class App extends Model
{
    
    protected $fillable = [
        'category', 'name', 'price', 'logo', 'description'
    ];

    use SoftDeletes;
    
    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }
}
