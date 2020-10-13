<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $guarded = [];   


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function url()
    {
        return Storage::url($this->path);
    }

    public function deleteImage($path){
        $this->path($path)->delete();
    }
}
