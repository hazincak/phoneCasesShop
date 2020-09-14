<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\BrandGetModelResource;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function getModels($brand){
    //    $brand = Brand::where('brand_name', $brand)->first();
    //     return $brand->deviceModels()->get();



        // return BrandGetModelResource::collection(
        //     Brand::where('brand_name', $brand)->with('deviceModels')->get()
        // );
        $brand = Brand::where('brand_name', $brand)->first();
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
    public function show(Brand $brand)
    {
        //
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
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand, $id)
    {
        $brand = Brand::findOrFail($id);
   
        $brand->delete();
    }
}
