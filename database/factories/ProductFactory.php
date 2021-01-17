<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;
use App\Product;
use App\Category;
use App\Color;
use App\DeviceModel;
use App\Material;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;





$factory->define(Product::class, function (Faker $faker) {

    // $categoryId = Category::all()->random()->id;
    // $category = Category::findOrFail($categoryId);
    // $brandId = $category->brands->random()->id;
    // $brand = Brand::findOrFail($brandId);
    // $modelId = $brand->deviceModels->random()->id;

    // $colorId = Color::all()->random()->id;
    // $materialId = Material::all()->random()->id;

    // return [
    //     'title' => $faker->firstNameFemale,
    //     'description_short' => $faker->text(80),
    //     'description_long' => $faker->text(200),
    //     'category_id' => $categoryId,
    //     'brand_id' => $brandId,
    //     'model_id' => $modelId,

    //     'price' => mt_rand (4.50*10, 25.99*10) / 10,

    //     'color_id' => $colorId,
    //     'material_id' => $materialId,
    // ];

    return[
        'title' => '',
        'description_short' => '',
        'description_long' => '',
        'category_id' => '',
        'brand_id' => '',
        'model_id' => '',

        'price' => '',

        'color_id' => '',
        'material_id' => '',
    ];
});
