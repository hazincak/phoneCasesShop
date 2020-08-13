<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$randomBrands = [
    'Apple',
    'Samsung',
    'Huawei',
    'LG',
    'Motorola',
    'OnePlus',
    'Xiaomi',
    'Nokia',
];

$randomModel = [
    'Iphone 8',
    'Iphone 9',
    'Iphone 10',
    'Galaxy 5',
    'Galaxy 6',
    'Galaxy 7',
];

$randomPurpose = [
    'Phone cover',
    'Tablet cover',
    'Phone charger'
];
$factory->define(Product::class, function (Faker $faker) use($randomBrands, $randomModel, $randomPurpose) {
    return [
        'title' => $faker->firstNameFemale,
        'description' => $faker->text(80),
        'model' => Arr::random($randomModel),
        'brand' => Arr::random($randomBrands),
        'purpose' => Arr::random($randomPurpose),

        'price' => random_int(4.90, 25.90)

        


    ];
});
