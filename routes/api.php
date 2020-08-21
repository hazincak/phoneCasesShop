<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('obchod/produkty', function (Request $request){
    
    return Product::paginate(12);
});

Route::get('obchod/produkt-podla-id/{id}', function(Request $request, $id){
    return Product::findOrFail($id);
});

// Route::get('obchod/produkty/{brand}', function(Request $request, $brand){
//     return Product::where('brand', $brand)->paginate(12);
// });
Route::get('obchod/produkty/na-{model}', function(Request $request, $model){
    return Product::where('model', $model)->paginate(12);
});
Route::get('obchod/produkt-podla-nazvu/{title}', function(Request $request, $title){
    return Product::where('title', $title)->get();
});

Route::get('obchod/produkty/obaly/{brand}', function(Request $request, $brand){
    return Product::where('purpose', 'Phone cover')->where('brand', $brand)->paginate(12);
});

Route::get('obchod/produkty/obaly-na-{model}', function(Request $request, $model){
    return Product::where('purpose', 'Phone cover')->where('model', $model)->paginate(12);
});

