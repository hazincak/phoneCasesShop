<?php

use App\Http\Controllers\Api\ProductController;
// use App\Http\Controllers\Api\CategoryController;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('obchod', 'Api\ProductController@index');

Route::get('vsetky-produkty', 'Api\ProductController@getAllProducts');

Route::get('obchod/produkt-podla-id/{id}', 'Api\ProductController@productById');

Route::get('/obaly-na-{model}', 'Api\ProductController@productsByModel');

Route::get('/modely-podla-znacky/{brandId}', 'Api\BrandController@getModels');

Route::apiResource('produkt', 'api\ProductController');

Route::apiResource('kategorie', 'api\CategoryController');

Route::apiResource('model', 'api\DeviceModelController');


Route::get('kategorie-a-znacky', 'api\CategoryBrandsController@getCategoriesWithBrands');

Route::get('znacky-nepatriace-kategorii/{categoryId}', 'api\CategoryBrandsController@getDistinctBrands');

Route::get('kategorie/{category}/pridat-znacku/{brand}', 'api\CategoryBrandsController@attachBrandToCategory');

Route::get('kategorie/{category}/odobrat-znacku/{brand}', 'api\CategoryBrandsController@unAttachBrandFromCategory');

Route::get('kategorie/{category}/pridat-model/{model}', 'api\CategoryDeviceModelsController@attachModelToCategory');

Route::get('kategorie/{category}/odobrat-model/{model}', 'api\CategoryDeviceModelsController@unAttachModelFromCategory');

Route::apiResource('znacky', 'api\BrandController');


Route::get('modely-podla-kategorie/{categoryId}/znacky/{brandId}', 'api\CategoriesBrandsModelsController@getModelsBelongingToSelectedCategoryAndToSelectedBrand');

Route::get('modely-nepatriace-kategorii/{categoryId}/znacka/{brandId}', 'api\CategoriesBrandsModelsController@getDistinctModels');

Route::get('sidebar/kontent', 'api\CategoriesBrandsModelsController@getSideBarContent');