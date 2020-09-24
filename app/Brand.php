<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $fillable = ['id' ,'brand_name'];

    public function deviceModels()
    {
        return $this->hasMany('App\DeviceModel');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
