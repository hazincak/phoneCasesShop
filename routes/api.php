<?php

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

//Public Section Routes
Route::get('shop', 'Api\ProductController@index');
Route::get('shop/product-by-id/{id}', 'Api\ProductController@productById');
Route::get('/download-pdf/{nameOfFile}', 'Api\DownloadsController@getDownload');
Route::get('/category-{categoryId}-brand-{brandId}-model-{modelId}', 'Api\ProductController@productsByCategoryBrandModel');
Route::get('brands-belonging-to-category/{categoryId}', 'api\CategoryBrandsController@getBrandsBelongingToSelectedCategory');
Route::get('sidebar/kontent', 'api\CategoriesBrandsModelsController@getSideBarContent');
Route::post('stripe-checkout', 'api\CheckoutController@stripeCheckout');
Route::post('checkout', 'api\CheckoutController@checkout');
Route::post('payPal-checkout', 'api\CheckoutController@payPalCheckout');
Route::get('models-by-category/{categoryId}/brand/{brandId}', 'api\CategoriesBrandsModelsController@getModelsBelongingToSelectedCategoryAndToSelectedBrand');


//Admin Section Routes
Route::get('all-products', 'Api\ProductController@getAllProducts');

Route::middleware('can:manipulateContent')->apiResource('product', 'api\ProductController');
Route::middleware('can:manipulateContent')->apiResource('category', 'api\CategoryController');
Route::middleware('can:manipulateContent')->apiResource('model', 'api\DeviceModelController');
Route::middleware('can:manipulateContent')->apiResource('color', 'api\ColorController');
Route::middleware('can:manipulateContent')->apiResource('material', 'api\MaterialController');
Route::middleware('can:manipulateContent')->apiResource('orders', 'api\OrderController');
Route::middleware('can:manipulateContent')->get('/confirmOrder/{id}', 'api\OrderController@confirmOrder');
Route::middleware('can:manipulateContent')->get('/user/{id}', 'api\UserController@getUser');
Route::middleware('can:manipulateContent')->get('/getOrderItems/{id}', 'api\OrderItemsController@getOrderItems');
Route::middleware('can:manipulateContent')->get('category/{category}/add-brand/{brand}', 'api\CategoryBrandsController@attachBrandToCategory');
Route::middleware('can:manipulateContent')->get('category/{category}/unattach-brand/{brand}', 'api\CategoryBrandsController@unAttachBrandFromCategory');
Route::middleware('can:manipulateContent')->get('category/{category}/add-model/{model}', 'api\CategoryDeviceModelsController@attachModelToCategory');
Route::middleware('can:manipulateContent')->get('category/{category}/unattach-model/{model}', 'api\CategoryDeviceModelsController@unAttachModelFromCategory');
Route::middleware('can:manipulateContent')->apiResource('brand', 'api\BrandController');

Route::get('models-not-belonging-to-category/{categoryId}/brand/{brandId}', 'api\CategoriesBrandsModelsController@getDistinctModels');

//Shared
Route::apiResource('returnAndRefundPolicy', 'api\ReturnAndRefundController');
Route::apiResource('trading-terms-and-conditions', 'api\TradingTermsController');
Route::apiResource('gdpr', 'api\GdprController');
Route::apiResource('carousel-items', 'api\CarouselItemController');







