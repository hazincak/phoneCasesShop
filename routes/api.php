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


Route::get('shop', 'Api\ProductController@index');

Route::get('vsetky-produkty', 'Api\ProductController@getAllProducts');


Route::get('obchod/produkt-podla-id/{id}', 'Api\ProductController@productById');

Route::get('/category-{categoryId}-brand-{brandId}-model-{modelId}', 'Api\ProductController@productsByCategoryBrandModel');

Route::get('/modely-podla-znacky/{brandId}', 'Api\BrandController@getModels');

Route::get('/stiahnut-pdf/{nameOfFile}', 'Api\DownloadsController@getDownload');

Route::middleware('can:manipulateContent')->apiResource('produkt', 'api\ProductController');

Route::middleware('can:manipulateContent')->apiResource('kategorie', 'api\CategoryController');

Route::middleware('can:manipulateContent')->apiResource('model', 'api\DeviceModelController');

Route::middleware('can:manipulateContent')->apiResource('farba', 'api\ColorController');

Route::middleware('can:manipulateContent')->apiResource('material', 'api\MaterialController');

Route::apiResource('carousel-items', 'api\CarouselItemController');

Route::get('kategorie-a-znacky', 'api\CategoryBrandsController@getCategoriesWithBrands');

Route::get('znacky-patriace-kategorii/{categoryId}', 'api\CategoryBrandsController@getBrandsBelongingToSelectedCategory');

Route::middleware('can:manipulateContent')->get('kategorie/{category}/pridat-znacku/{brand}', 'api\CategoryBrandsController@attachBrandToCategory');

Route::middleware('can:manipulateContent')->get('kategorie/{category}/odobrat-znacku/{brand}', 'api\CategoryBrandsController@unAttachBrandFromCategory');

Route::middleware('can:manipulateContent')->get('kategorie/{category}/pridat-model/{model}', 'api\CategoryDeviceModelsController@attachModelToCategory');

Route::middleware('can:manipulateContent')->get('kategorie/{category}/odobrat-model/{model}', 'api\CategoryDeviceModelsController@unAttachModelFromCategory');

Route::middleware('can:manipulateContent')->apiResource('znacky', 'api\BrandController');


Route::get('modely-podla-kategorie/{categoryId}/znacky/{brandId}', 'api\CategoriesBrandsModelsController@getModelsBelongingToSelectedCategoryAndToSelectedBrand');

Route::get('modely-nepatriace-kategorii/{categoryId}/znacka/{brandId}', 'api\CategoriesBrandsModelsController@getDistinctModels');

Route::get('sidebar/kontent', 'api\CategoriesBrandsModelsController@getSideBarContent');

Route::post('stripe-checkout', 'api\CheckoutController@stripeCheckout');

Route::post('checkout', 'api\CheckoutController@checkout');
