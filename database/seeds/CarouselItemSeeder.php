<?php

use App\CarouselItem;
use Illuminate\Database\Seeder;

class CarouselItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CarouselItem::class, 20)->create();
    }
}
