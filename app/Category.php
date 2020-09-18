<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';

    protected $fillable=['id', 'category_name'];


    public function brands()
    {
        return $this->belongsToMany('App\Brand');
    }
}