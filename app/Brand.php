<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function deviceModels()
    {
        return $this->hasMany('App\DeviceModel');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
