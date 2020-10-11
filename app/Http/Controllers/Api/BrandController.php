<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\BrandGetModelResource;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function getModels($brandId){
        $brand = Brand::findOrFail($brandId);
        return BrandGetModelResource::collection(
           
             $brand->deviceModels()->get()
        );
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Brand::all();
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
            'brand_name' => 'required|min:2|unique:brands',
        ]);

        $brand = Brand::create([
            
            'brand_name'=>$request->brand_name
        
        ]);
       
        return response()->json($brand);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand, $id)
    {
        return Brand::with('deviceModels')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|min:2|unique:brands',
         ]);
 
         $brand = Brand::findOrFail($id);
 
         $brand->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $brand = Brand::findOrFail($id);
   
        $brand->delete();
    }
}
