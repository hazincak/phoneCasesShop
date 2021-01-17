<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */



    public function run()
    {

        $products = [

            [
                'title' => 'iPhone 8/7 Plus Leather Case',
                'description_short' => 'iphone 8/7 Plus Brown Leather Case',
                'description_long' => 'These Apple-designed cases fit snugly over the curves of your iPhone without adding bulk. They’re made from specially tanned and finished European leather, so the outside feels soft to the touch and develops a natural patina over time. The machined aluminum buttons match the finish of your leather case, while a microfiber lining inside helps protect your iPhone. And you can keep it on all the time, even when you’re charging iPhone 8 Plus wirelessly.',
                'category_id' => '1',
                'brand_id' => '1',
                'model_id' => '1',

                'price' => '35',

                'color_id' => '5',
                'material_id' => '5',
            ],

            [
                'title' => 'iPhone 6/6S/7/8 Case | Blue',
                'description_short' => 'ITSkins Feronia Bio iPhone 6/6S/7/8 Case | Blue',
                'description_long' => 'Feronia Bio powerfully safeguards your phone with intelligent Drop Safe Protection. Impact is absorbed, dissipated and repelled by air cushion technology used along the sides, crowns and the 4 corners of the Spectrum case.',
                'category_id' => '1',
                'brand_id' => '1',
                'model_id' => '1',

                'price' => '29.95',

                'color_id' => '4',
                'material_id' => '1',
            ],

            [
                'title' => 'Gear4 Crystal Palace iPhone 11 Pro Case | Iridescent',
                'description_short' => 'Crystal Palace is drop resistant up to 13ft to the D3O Approved material. Plus the backplate is made of PC, the same material that’s used in bulletproof glass, so it will keep your device safe and sound.',
                'description_long' => 'Crystal Palace is drop resistant up to 13ft to the D3O Approved material. Plus the backplate is made of PC, the same material that’s used in bulletproof glass, so it will keep your device safe and sound.',
                'category_id' => '1',
                'brand_id' => '1',
                'model_id' => '1',

                'price' => '25',

                'color_id' => '3',
                'material_id' => '2',
            ],

            [
                'title' => 'Case It iPhone X Stitched Folio Case | Black',
                'description_short' => 'The Case It folio phone case for iPhone X ',
                'description_long' => 'The Case It folio phone case for iPhone X/XS is ideal for protecting both the front and back of your phone. The black stitched folio design will complement a variety of phone styles and will keep it protected at the same time. ',
                'category_id' => '1',
                'brand_id' => '1',
                'model_id' => '2',

                'price' => '7.50',

                'color_id' => '1',
                'material_id' => '5',
            ],

            [
                'title' => 'ITSkins Spectrum Clear iPhone 11 Case | Transparent',
                'description_short' => 'Impacthane custom polymer fabricated with Hexotek 2.0 air pocket technology. Super slim. Super performant with military-grade drop protection.',
                'description_long' => 'Impacthane custom polymer fabricated with Hexotek 2.0 air pocket technology. Super slim. Super performant with military-grade drop protection.

                Spectrumclear powerfully safeguards your phone with intelligent drop safe protection. Impacts are absorbed, dissipated and repelled by air cushion technology used along the sides, crowns and the 4 corners of the Spectrum case.',
                'category_id' => '1',
                'brand_id' => '1',
                'model_id' => '3',

                'price' => '25.95',

                'color_id' => '3',
                'material_id' => '2',
            ],

            [
                'title' => 'LifeProof Wake Case for iPhone 8s & SE 2nd Gen | Neptune',
                'description_short' => 'WAKE Series for Apple iPhone',
                'description_long' => 'WAKE Series for Apple iPhone. Save your phone. And our planet. Serious protection. Subtle styling. Built sustainably. WĀKE is a sea-change in case construction, using mostly ocean-based recycled plastic without sacrificing performance. Molded with a mellow wave pattern, the look is contemporary to the core. And after, you get to donate a dollar to one of our water conscious nonprofit partners – we cover the cost.',
                'category_id' => '1',
                'brand_id' => '1',
                'model_id' => '1',

                'price' => '30',

                'color_id' => '1',
                'material_id' => '1',
            ],

            [
                'title' => 'Samsung Galaxy Note 9 Protective Standing Cover | Black',
                'description_short' => 'Defend your phone against bumps and drops with a drop-tested, military-grade cover. The Protective Standing Cover is for when you need major protection. Plus, you can still use a wireless charger.',
                'description_long' => 'Defend your phone against bumps and drops with a drop-tested, military-grade cover. The Protective Standing Cover is for when you need major protection. Plus, you can still use a wireless charger. The Protective Standing Cover keeps your phone safe without obstructing the Infinity Display. Its built-in kickstand holds your Galaxy Note9 at a comfortable landscape angle, ideal for watching movies or taking a sefie.',
                'category_id' => '1',
                'brand_id' => '2',
                'model_id' => '4',

                'price' => '18.50',

                'color_id' => '1',
                'material_id' => '1',
            ],

            [
                'title' => 'Otterbox Symmetry Series Samsung Galaxy Note 9 Case | Clear',
                'description_short' => 'Ultra-slim, ultra-protective Symmetry Series Clear expresses your personality. Not seeing is believing with a clear design that shows off your device and your style.',
                'description_long' => 'Ultra-slim, ultra-protective Symmetry Series Clear expresses your personality. Not seeing is believing with a clear design that shows off your device and your style. Sleek design slips easily into pockets and purses. Has Raised, beveled edge helps protect touchscreen. Made of Polycarbonate Material ',
                'category_id' => '1',
                'brand_id' => '2',
                'model_id' => '4',

                'price' => '14.99',

                'color_id' => '3',
                'material_id' => '3',
            ],

            [
                'title' => 'Otterbox Symmetry Series Clear Samsung Galaxy S10 Case | Clear',
                'description_short' => 'Ultra-slim, ultra-protective Symmetry Series Clear expresses your personality. Not seeing is believing with a clear design that shows off your device and your style.',
                'description_long' => 'Ultra-slim, ultra-protective Symmetry Series Clear expresses your personality. Not seeing is believing with a clear design that shows off your device and your style. Sleek design slips easily into pockets and purses. Has Raised, beveled edge helps protect touchscreen. Made of Polycarbonate Material.',
                'category_id' => '1',
                'brand_id' => '2',
                'model_id' => '5',

                'price' => '34.95',

                'color_id' => '3',
                'material_id' => '3',
            ],

            [
                'title' => 'Otterbox Prefix Series Samsung Galaxy A6 Case | Clear',
                'description_short' => 'Wrap your Galaxy A6 with Prefix Series, the OtterBox case with personality. Prefix Series passes extensive testing protocols so you know your phone is safe from daily tumbles, drops and scrapes. Its slim, one-piece design incorporates internal coring that absorbs shock and external features make for great grip and easy access to phone features.',
                'description_long' => 'Wrap your Galaxy A6 with Prefix Series, the OtterBox case with personality. Prefix Series passes extensive testing protocols so you know your phone is safe from daily tumbles, drops and scrapes. Its slim, one-piece design incorporates internal coring that absorbs shock and external features make for great grip and easy access to phone features. Wrap your Galaxy A6 with Prefix Series, the OtterBox case with personality. Prefix Series passes extensive testing protocols so you know your phone is safe from daily tumbles, drops and scrapes. Its slim, one-piece design incorporates internal coring that absorbs shock and external features make for great grip and easy access to phone features.',
                'category_id' => '1',
                'brand_id' => '2',
                'model_id' => '6',

                'price' => '14',

                'color_id' => '3',
                'material_id' => '3',
            ],

            [
                'title' => 'OtterBox Huawei P40 React Series Case | Clear',
                'description_short' => 'React Series is an ultra-slim, resilient OtterBox case with DROP+ protection. DROP + is the OtterBox testing protocol that proves every product we make, at a minimum, meets Military Standard - that’s 26 drops from 4 feet. REACT Series’ solid one-piece form is precision designed for your phone and its soft touch edges provide great grip. The case installs easily and also seamlessly slides in and out of backpacks or pockets.',
                'description_long' => 'React Series is an ultra-slim, resilient OtterBox case with DROP+ protection. DROP + is the OtterBox testing protocol that proves every product we make, at a minimum, meets Military Standard - that’s 26 drops from 4 feet. REACT Series’ solid one-piece form is precision designed for your phone and its soft touch edges provide great grip. The case installs easily and also seamlessly slides in and out of backpacks or pockets. Allows Qi wireless charging works with case. Has raised screen bumpers help protect touchscreen. Ultra-slim, one-piece design case slips easily in and out of pockets. Its solid one-piece form is precision designed for your phone and its soft touch edges provide great grip',
                'category_id' => '1',
                'brand_id' => '3',
                'model_id' => '7',

                'price' => '24.95',

                'color_id' => '3',
                'material_id' => '3',
            ],

            // [
            //     'title' => 'Test',
            //     'description_short' => 'test test test test test test test ',
            //     'description_long' => 'test test test test test test test test test test test test test ',
            //     'category_id' => '1',
            //     'brand_id' => '1',
            //     'model_id' => '1',

            //     'price' => '10',

            //     'color_id' => '1',
            //     'material_id' => '1',
            // ],

            // [
            //     'title' => 'Test',
            //     'description_short' => 'test test test test test test test ',
            //     'description_long' => 'test test test test test test test test test test test test test ',
            //     'category_id' => '1',
            //     'brand_id' => '1',
            //     'model_id' => '1',

            //     'price' => '10',

            //     'color_id' => '1',
            //     'material_id' => '1',
            // ],

            // [
            //     'title' => 'Test',
            //     'description_short' => 'test test test test test test test ',
            //     'description_long' => 'test test test test test test test test test test test test test ',
            //     'category_id' => '1',
            //     'brand_id' => '1',
            //     'model_id' => '1',

            //     'price' => '10',

            //     'color_id' => '1',
            //     'material_id' => '1',
            // ],

            // [
            //     'title' => 'Test',
            //     'description_short' => 'test test test test test test test ',
            //     'description_long' => 'test test test test test test test test test test test test test ',
            //     'category_id' => '1',
            //     'brand_id' => '1',
            //     'model_id' => '1',

            //     'price' => '10',

            //     'color_id' => '1',
            //     'material_id' => '1',
            // ],

            // [
            //     'title' => 'Test',
            //     'description_short' => 'test test test test test test test ',
            //     'description_long' => 'test test test test test test test test test test test test test ',
            //     'category_id' => '1',
            //     'brand_id' => '1',
            //     'model_id' => '1',

            //     'price' => '10',

            //     'color_id' => '1',
            //     'material_id' => '1',
            // ],


            // [
            //     'title' => 'Test',
            //     'description_short' => 'test test test test test test test ',
            //     'description_long' => 'test test test test test test test test test test test test test ',
            //     'category_id' => '1',
            //     'brand_id' => '1',
            //     'model_id' => '1',

            //     'price' => '10',

            //     'color_id' => '1',
            //     'material_id' => '1',
            // ],


            // [
            //     'title' => 'Test',
            //     'description_short' => 'test test test test test test test ',
            //     'description_long' => 'test test test test test test test test test test test test test ',
            //     'category_id' => '1',
            //     'brand_id' => '1',
            //     'model_id' => '1',

            //     'price' => '10',

            //     'color_id' => '1',
            //     'material_id' => '1',
            // ],


            // [
            //     'title' => 'Test',
            //     'description_short' => 'test test test test test test test ',
            //     'description_long' => 'test test test test test test test test test test test test test ',
            //     'category_id' => '1',
            //     'brand_id' => '1',
            //     'model_id' => '1',

            //     'price' => '10',

            //     'color_id' => '1',
            //     'material_id' => '1',
            // ],


            // [
            //     'title' => 'Test',
            //     'description_short' => 'test test test test test test test ',
            //     'description_long' => 'test test test test test test test test test test test test test ',
            //     'category_id' => '1',
            //     'brand_id' => '1',
            //     'model_id' => '1',

            //     'price' => '10',

            //     'color_id' => '1',
            //     'material_id' => '1',
            // ],



        ];


        foreach($products as $product){

        factory(Product::class)->create([
            'title' => $product['title'],
            'description_short' => $product['description_short'],
            'description_long' => $product['description_long'],
            'category_id' => $product['category_id'],
            'brand_id' => $product['brand_id'],
            'model_id' => $product['model_id'],
            'price' => $product['price'],
            'color_id' => $product['color_id'],
            'material_id' => $product['material_id'],
        ]);


    }
    }
}
