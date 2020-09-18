<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
{
    protected $fillable=['model_name', 'brand_id'];

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }
}
