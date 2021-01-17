<?php

use App\Category;
use Illuminate\Database\Seeder;

class ModelCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phoneCasesCategory = Category::findOrFail(1);
        $phoneCasesCategory->models()->attach([1,2,3,4,5,6,7]);
    }
}
