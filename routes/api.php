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

Route::get('obchod/produkt-podla-id/{id}', 'Api\ProductController@productById');

Route::get('/obaly-na-{model}', 'Api\ProductController@productsByModel');

Route::get('/modely-podla-znacky/{znacka}', 'Api\BrandController@getModels');

Route::apiResource('produkt', 'api\ProductController');

Route::apiResource('kategorie', 'api\CategoryController');

Route::apiResource('model', 'api\DeviceModelController');

Route::get('kategorie/{category}/pridat-znacku/{brand}', 'api\CategoryBrandsController@attachBrandToCategory');

Route::get('kategorie/{category}/odobrat-znacku/{brand}', 'api\CategoryBrandsController@unAttachBrandFromCategory');

Route::apiResource('znacky', 'api\BrandController');

