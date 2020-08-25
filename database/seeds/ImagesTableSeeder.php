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
        $products = Product::all();
        factory(Image::class, 150)->make()->each(function($image) use($products){
            $image->product_id = $products->random()->id;
            $image->save();
        });
    }
}
