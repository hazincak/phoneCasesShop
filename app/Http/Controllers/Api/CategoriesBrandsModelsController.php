<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesBrandsModelsController extends Controller
{
    public function __invoke()
    {
        $SidebarListItems = Category::with('brands.deviceModels')->get();

       
        return $SidebarListItems;
    }
}
