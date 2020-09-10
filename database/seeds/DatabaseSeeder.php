<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call([
            UsersTableSeeder::class,
            ProductSeeder::class,
            ImagesTableSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            BrandCategorySeeder::class,
            
        ]);

    }
}
