<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            'Apple',
            'Samsung',
            'Huawei',
            'LG',
            'Motorola',
            'OnePlus',
            'Xiaomi',
        ];

        foreach($brands as $brand){
            factory(Brand::class)->create([
                'brand_name' => $brand,
            ]);   
        }
    }
}
