<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Http\Controllers\Controller;

use App\DeviceModel;
use Illuminate\Http\Request;

class DeviceModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
            'model_name' => 'required|unique:device_models',
        ]);

        $model = DeviceModel::create([
            'model_name' => $request->model_name,
            'brand_id' => $request->brand_id
        ]);
        
        $brand_id = $request->brand_id;
        $brand = Brand::findOrFail($brand_id);
        $brand->deviceModels()->save($model);
        return response()->json($model);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeviceModel  $deviceModel
     * @return \Illuminate\Http\Response
     */
    public function show(DeviceModel $deviceModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeviceModel  $deviceModel
     * @return \Illuminate\Http\Response
     */
    public function edit(DeviceModel $deviceModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeviceModel  $deviceModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeviceModel $deviceModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeviceModel  $deviceModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = DeviceModel::findOrFail($id);
   
        $model->delete();
    }
}
