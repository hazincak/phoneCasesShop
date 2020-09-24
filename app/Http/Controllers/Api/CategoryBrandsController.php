<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;

class CategoryBrandsController extends Controller
{

    public function getCategoriesWithBrands(){
        return Category::with('brands')->get();
    }

    public function attachBrandToCategory(Request $request, $id, $brandId){
        $category = Category::findOrFail($id);
        $brand = Brand::findOrFail($brandId);
        $category->brands()->attach($brandId);
        return response()->json($brand);
    }

    public function unAttachBrandFromCategory(Request $request, $id, $brandId){
        $category = Category::findOrFail($id);
        return $category->brands()->detach($brandId);
    }
}
