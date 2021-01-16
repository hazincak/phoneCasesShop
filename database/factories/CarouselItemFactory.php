<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CarouselItem;
use App\Product;
use Faker\Generator as Faker;

$factory->define(CarouselItem::class, function (Faker $faker) {

    $productId = Product::all()->random()->id;

    return [
        'product_id' => $productId,
    ];
});
