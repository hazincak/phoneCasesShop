<?php

use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        App\Brand::all()->each(function($brand){
            if($brand->brand_name == 'Apple'){
                $brand->deviceModels()->saveMany([
                    new App\DeviceModel(['model_name' => 'Iphone 8' , 'brand_id' => $brand->id  ]),
                        new App\DeviceModel(['model_name' => 'Iphone 9' ,  'brand_id' => $brand->id]),
                        new App\DeviceModel(['model_name' => 'Iphone 10',  'brand_id' => $brand->id ]),
                        new App\DeviceModel(['model_name' => 'Iphone 11',  'brand_id' => $brand->id ]),

                ]);
            }

            if($brand->brand_name == 'Samsung'){
                $brand->deviceModels()->saveMany([
                    new App\DeviceModel(['model_name' => 'Galaxy 5' , 'brand_id' => $brand->id  ]),
                        new App\DeviceModel(['model_name' => 'Galaxy 6',  'brand_id' => $brand->id]),
                        new App\DeviceModel(['model_name' => 'Galaxy 7',  'brand_id' => $brand->id ]),
                        new App\DeviceModel(['model_name' => 'Galaxy 8',  'brand_id' => $brand->id ]),

                ]);
            }

            if($brand->brand_name == 'Huawei'){
                $brand->deviceModels()->saveMany([
                    new App\DeviceModel(['model_name' => 'Mate 10' , 'brand_id' => $brand->id  ]),
                    new App\DeviceModel(['model_name' => 'P30' ,  'brand_id' => $brand->id]),
                    new App\DeviceModel(['model_name' => 'P20 PRO',  'brand_id' => $brand->id ]),
                    new App\DeviceModel(['model_name' => 'P10 Lite',  'brand_id' => $brand->id ]),

                ]);
            }

            if($brand->brand_name == 'LG'){
                $brand->deviceModels()->saveMany([
                    new App\DeviceModel(['model_name' => 'G6' , 'brand_id' => $brand->id  ]),
                    new App\DeviceModel(['model_name' => 'K40' ,  'brand_id' => $brand->id]),
                    new App\DeviceModel(['model_name' => 'K61',  'brand_id' => $brand->id ]),
                ]);
            }

            if($brand->brand_name == 'OnePlus'){
                $brand->deviceModels()->saveMany([
                    new App\DeviceModel(['model_name' => 'OnePlus 6T' , 'brand_id' => $brand->id  ]),
                    new App\DeviceModel(['model_name' => 'OnePlus 7 Pro' ,  'brand_id' => $brand->id]),
                    new App\DeviceModel(['model_name' => ' OnePlus 7T',  'brand_id' => $brand->id ]),
                ]);
            }

            if($brand->brand_name == 'Motorola'){
                $brand->deviceModels()->saveMany([
                    new App\DeviceModel(['model_name' => 'Moto G7' , 'brand_id' => $brand->id  ]),
                    new App\DeviceModel(['model_name' => 'Moto E6' ,  'brand_id' => $brand->id]),
                    new App\DeviceModel(['model_name' => 'One',  'brand_id' => $brand->id ]),
                ]);
            }

            if($brand->brand_name == 'Xiaomi'){
                $brand->deviceModels()->saveMany([
                    new App\DeviceModel(['model_name' => 'Mi 8' , 'brand_id' => $brand->id  ]),
                    new App\DeviceModel(['model_name' => 'Mi Note 10',  'brand_id' => $brand->id]),
                    new App\DeviceModel(['model_name' => 'Redmi 9',  'brand_id' => $brand->id ]),
                ]);
            }
        });
    }
}
