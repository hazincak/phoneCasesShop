<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $categories = ['Phone cases', 'Tablet cases', 'Screen Protectors', 'Cables & Straps', 'Wireless Chargers', 'Wallets'];
        foreach($categories as $category){
            factory(Category::class)->create([
                'category_name' => $category,
            ]);
        }

    }
}
