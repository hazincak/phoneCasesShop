<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Category;
use App\DeviceModel;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CategoriesBrandsModelsController extends Controller
{

    public function getDistinctModels($categoryId, $brandId){
        $modelsNotBelongingToSelectedCategory = DeviceModel::where('brand_id', $brandId)->whereDoesntHave('categories', function($query) use ($categoryId){
            $query->where('id', $categoryId);
        })->get();

        return $modelsNotBelongingToSelectedCategory;
    }

    public function getModelsBelongingToSelectedCategoryAndToSelectedBrand($categoryId, $brandId){
        // $categoryWithBelongingBrandsAndModels = Category::with(['brands.deviceModels' => function($query){
        //     $query->whereHas('categories');
        //     }
        // ])->findOrFail($categoryId);

        // return $categoryWithBelongingBrandsAndModels;

        $modelsBelongingToSelectedCategoryAndBrand = DeviceModel::where('brand_id', $brandId)->whereHas('categories', function($query) use ($categoryId){
            $query->where('id', $categoryId);
        })->get();
        return $modelsBelongingToSelectedCategoryAndBrand;
    }

    // public function __invoke()
    // {


    //     return Product::with('category', 'brand', 'model')->get();

    //     // $SidebarListItems = Category::with(['brands.deviceModels' => function($query){
    //     //     $query->whereHas('');
            
    //     // }
        
        
        
    //     // ])->get();

    //     // $SidebarListItems = Category::with(['brands.deviceModels' => function($query){
    //     //     $query->where('brand_id', 1);
    //     // },
        
    //     // ])->get();
    //     // $SidebarListItems = DeviceModel::with('brand.categories')->get();


       
    //     // return $SidebarListItems;
    // }
}
