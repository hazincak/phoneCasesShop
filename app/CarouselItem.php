<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarouselItem extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function product(){
        return $this->belongsTo('App\Product');
    }
}
