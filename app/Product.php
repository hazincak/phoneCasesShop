<?php

namespace App;

use App\Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->hasOne('App\Category');
    }

    public function brand()
    {
        return $this->hasOne('App\Brand');
    }
}
