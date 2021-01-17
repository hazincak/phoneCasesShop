<?php

use App\Category;
use Illuminate\Database\Seeder;

class BrandCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $phoneCasesCategory = Category::findOrFail(1);
        $phoneCasesCategory->brands()->attach([1, 2, 3]);

        // $brands = App\Brand::all();

        // App\Category::all()->each(function ($category) use ($brands){
        //     $category->brands()->attach(
        //         $brands->random(rand(1,7))->pluck('id')->toArray()
        //     );
        // });
    }
}
