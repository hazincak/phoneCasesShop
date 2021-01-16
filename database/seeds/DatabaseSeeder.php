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
            CategorySeeder::class,
            BrandSeeder::class,
            BrandCategorySeeder::class,
            ModelSeeder::class,
            ColorSeeder::class,
            MaterialSeeder::class,
            ProductSeeder::class,
            ImagesTableSeeder::class,
            CarouselItemSeeder::class,
        ]);

    }
}
