<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function products(){
        return $this->hasMany('App\Product');
    }
}
