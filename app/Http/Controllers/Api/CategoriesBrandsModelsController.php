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
        $modelsBelongingToSelectedCategoryAndBrand = DeviceModel::where('brand_id', $brandId)->whereHas('categories', function($query) use ($categoryId){
            $query->where('id', $categoryId);
        })->get();
        return $modelsBelongingToSelectedCategoryAndBrand;
    }

    public function getSideBarContent(){
          $sideBarContent = Category::with(['brands.deviceModels' => function($query){
            $query->whereHas('categories');
            }
        ])->get();

        return $sideBarContent;
    }

}
