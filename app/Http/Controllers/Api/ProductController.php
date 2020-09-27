<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;


class ProductController extends Controller
{
   
    

    public function productById($id){
        return Product::with('images')->findOrFail($id);
    }


    public function getAllProducts(){
        return Product::with('category', 'brand', 'model')->get();
    }

    


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::with('images')->paginate(12);
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
            'color' => 'required',
            'material' => 'required',
            'price' => 'required',
        ]);

        $product = Product::create([
            'title' => $request->title,
            'description_short' => $request->description_short,
            'description_long' => $request->description_long,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'model_id' => $request->model_id,
            'color' => $request->color,
            'material' => $request->material,
            'price' => $request->price,
        ]);


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
