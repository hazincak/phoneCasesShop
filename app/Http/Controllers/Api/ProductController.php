<?php

namespace App\Http\Controllers\Api;

use App\Image;
use App\Product;
use App\DeviceModel;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
   
    

    public function productById($id){
        return Product::with('images', 'model', 'color', 'material')->findOrFail($id);
    }


    public function getAllProducts(){
        return Product::with('category', 'brand', 'model')->get();
    }

    public function productsByCategoryBrandModel(Request $request, $categoryId, $brandId, $modelId){

       
        return Product::with('images', 'brand', 'color', 'material','category', 'model')
        ->where([
            ['brand_id', $brandId],
            ['category_id', $categoryId],
            ['model_id', $modelId]
        ])
        ->orderBy($request->orderBy, $request->order)
        ->paginate($request->perPage);
    }
    

    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Product::with('images', 'model', 'category', 'brand', 'color', 'material')
        ->orderBy($request->orderBy, $request->order)
        ->paginate($request->perPage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description_short' => 'required',
            'description_long' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'model_id' => 'required',
            'color_id' => 'required',
            'material_id' => 'required',
            'price' => 'required',
        ]);

        $product = Product::create([
            'title' => $request->title,
            'description_short' => $request->description_short,
            'description_long' => $request->description_long,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'model_id' => $request->model_id,
            'color_id' => $request->color_id,
            'material_id' => $request->material_id,
            'price' => $request->price,
        ]);

    //   dd($request->images);
            

        
            $images = $request->images;
            $imageIndex = 0;
            foreach($images as $image){
                preg_match("/data:image\/(.*?);/",$image,$image_extension); // extract the image extension
                $image = preg_replace('/data:image\/(.*?);base64,/','',$image); // remove the type part
                $image = str_replace(' ', '+', $image);
                $file_name = $imageIndex .'_' . time() . '.' . $image_extension[1]; //generating unique file name;

            Storage::disk('public')->put($file_name, base64_decode($image));
            $product->images()->save(
            Image::make(['path' => Storage::url($file_name)])
       );
   
   $imageIndex++;
}

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    
}
