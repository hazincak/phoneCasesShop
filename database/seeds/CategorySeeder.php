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
        $categories = ['Kryty Na Mobil', 'Puzdrá Na Tablet', 'Tvrdené Sklá', 'Príslušenstvo'];
        foreach($categories as $category){
            factory(Category::class)->create([
                'category_name' => $category,
            ]);
        }
        
    }
}
