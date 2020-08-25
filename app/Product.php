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
}
