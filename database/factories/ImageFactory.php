<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        // 'path'=> $faker->imageUrl($width = 640, $height = 480, 'technics')     // 'http://lorempixel.com/800/600/cats/'
    'path' => '',
    'product_id' => ''
    ];
});
