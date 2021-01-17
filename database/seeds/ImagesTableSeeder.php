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

        $images = [
            [
                'path' => '/storage/10.jpg',
                'product_id' => '1',
            ],
            [
                'path' => '/storage/11.jpg',
                'product_id' => '1',
            ],
            [
                'path' => '/storage/12.jpg',
                'product_id' => '1',
            ],
            [
                'path' => '/storage/13.jpg',
                'product_id' => '1',
            ],
            [
                'path' => '/storage/20.jpg',
                'product_id' => '2',
            ],
            [
                'path' => '/storage/30.jpg',
                'product_id' => '3',
            ],
            [
                'path' => '/storage/31.jpg',
                'product_id' => '3',
            ],
            [
                'path' => '/storage/32.jpg',
                'product_id' => '3',
            ],
            [
                'path' => '/storage/40.jpg',
                'product_id' => '4',
            ],
            [
                'path' => '/storage/50.jpg',
                'product_id' => '5',
            ],
            [
                'path' => '/storage/51.jpg',
                'product_id' => '5',
            ],
            [
                'path' => '/storage/52.jpg',
                'product_id' => '5',
            ],
            [
                'path' => '/storage/60.jpg',
                'product_id' => '6',
            ],
            [
                'path' => '/storage/61.jpg',
                'product_id' => '6',
            ],
            [
                'path' => '/storage/62.jpg',
                'product_id' => '6',
            ],
            [
                'path' => '/storage/70.jpg',
                'product_id' => '7',
            ],
            [
                'path' => '/storage/71.jpg',
                'product_id' => '7',
            ],
            [
                'path' => '/storage/72.jpg',
                'product_id' => '7',
            ],
            [
                'path' => '/storage/73.jpg',
                'product_id' => '7',
            ],
            [
                'path' => '/storage/80.jpg',
                'product_id' => '8',
            ],
            [
                'path' => '/storage/81.jpg',
                'product_id' => '8',
            ],
            [
                'path' => '/storage/90.jpg',
                'product_id' => '9',
            ],
            [
                'path' => '/storage/91.jpg',
                'product_id' => '9',
            ],
            [
                'path' => '/storage/92.jpg',
                'product_id' => '9',
            ],
            [
                'path' => '/storage/100.jpg',
                'product_id' => '10',
            ],
            [
                'path' => '/storage/101.jpg',
                'product_id' => '10',
            ],
            [
                'path' => '/storage/200.jpg',
                'product_id' => '11',
            ],



        ];

        foreach($images as $image){
            $product = Product::findOrFail($image['product_id']);
            $product->images()->create([
                'path' => $image['path'],
                'product_id' => $image['product_id']
            ]);
        }
        // Product::all()->each(function($product){
            // $images = factory (Image::class, random_int(1, 5))->make();
            // $product->images()->saveMany($images);
        // });
    }
}
