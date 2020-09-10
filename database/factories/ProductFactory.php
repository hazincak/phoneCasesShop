<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$brands = [
    'Apple',
    'Samsung',
    'Huawei',
    'LG',
    'Motorola',
    'OnePlus',
    'Xiaomi',
];

$purpose = [
    'Obal na mobil',
    'Obal na tablet',
    // 'Sklo na mobil',
    // 'Nabíjačka',
    // 'Puzdrá na slúchadlá',

];

$color = [
    'Čierna',
    'Červená',
    'Transparentná',
    'Modrá',
    'Hnedá',
    'Koža',
];

$material = [
    'Plast',
    'Silikón',
    'Semiš',
    'Syntetická koža',
    'Viacfarebná',
];
$factory->define(Product::class, function (Faker $faker) use($brands, $purpose, $color, $material) {
    
    $randomBrand = Arr::random($brands);
    $randomModel = '';
    if($randomBrand == 'Apple'){
        $randomModel = Arr::random(['Iphone 8', 'Iphone 9', 'Iphone 10', 'Iphone 11']);
    }else if($randomBrand == 'Samsung'){
        $randomModel = Arr::random(['Galaxy 5', 'Galaxy 6', 'Galaxy 7', 'Galaxy 8']);
    }else if ($randomBrand == 'Huawei'){
        $randomModel = Arr::random(['Mate 10', 'P30', 'P20 PRO', 'P10 Lite']);
    }else if ($randomBrand == 'LG'){
        $randomModel = Arr::random(['G6','K40','K61']);
    }else if ($randomBrand == 'OnePlus'){
        $randomModel = Arr::random(['OnePlus 6T','OnePlus 7 Pro','OnePlus 7T']);
    }else if ($randomBrand == 'Motorola'){
        $randomModel = Arr::random(['Moto G7','Moto E6','One']);
    }else if ($randomBrand == 'Xiaomi'){
        $randomModel = Arr::random(['Mi 8','Mi note 10','Redmi 9']);
    };


    return [
        'title' => $faker->firstNameFemale,
        'description' => $faker->text(80),
        'brand' => $randomBrand,
        'model' => $randomModel,
        'purpose' => Arr::random($purpose),
        'price' => mt_rand (4.50*10, 25.99*10) / 10,

        'color' => Arr::random($color),
        'material' => Arr::random($material),
    ];
});
