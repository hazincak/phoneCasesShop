<?php

use App\Product;
use App\Image;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::all()->each(function($product){
            $images = factory (Image::class, random_int(1, 5))->make();
            $product->images()->saveMany($images);
        });
    }
}
