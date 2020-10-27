<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $guarded = [];

    protected $attributes = array(
        'order_status' => 'Nepotvrdená '
      );

    public function ordersProducts(){
        return $this->hasMany('App\OrdersProducts');
    }
}
