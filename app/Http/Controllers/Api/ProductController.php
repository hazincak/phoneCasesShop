<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index(){
        return Product::with('images')->paginate(12);
    }

    public function productById($id){
        return Product::with('images')->findOrFail($id);
    }

    public function productsByModel($model){
        return Product::where('purpose', 'Obal na mobil')->where('model', $model)->with('images')->paginate(12);
    }
}
