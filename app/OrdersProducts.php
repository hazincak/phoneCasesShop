<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersProducts extends Model
{

    protected $guarded = [];
    public $timestamps = false;

    public function orders(){
        return $this->belongsTo('App\Order');
    }
    
}
