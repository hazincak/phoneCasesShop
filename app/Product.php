<?php

namespace App;

use App\Image;
use App\DeviceModel;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];   

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function model(){
        return $this->belongsTo(DeviceModel::class);
    }
}
