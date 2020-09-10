<?php

use App\Http\Controllers\Api\ProductController;
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


Route::get('obchod', 'Api\ProductController@allProducts');

Route::get('obchod/produkt-podla-id/{id}', 'Api\ProductController@productById');

Route::get('/obaly-na-{model}', 'Api\ProductController@productsByModel');

Route::apiResource('produkt', 'api\ProductController');

