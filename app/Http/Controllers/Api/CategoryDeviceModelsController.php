<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\DeviceModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryDeviceModelsController extends Controller
{
    

    public function attachModelToCategory(Request $request, $id, $modelId){
        $category = Category::findOrFail($id);
        $model = DeviceModel::findOrFail($modelId);
        $category->models()->attach($modelId);
        
        return response()->json($model);
    }

    public function unAttachModelFromCategory(Request $request, $id, $modelId){
        $category = Category::findOrFail($id);
        return $category->models()->detach($modelId);
    }
}
