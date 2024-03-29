<?php

use App\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            'Black',
            'Red',
            'Transparent',
            'Blue',
            'Brown',
            'Green',
        ];

        foreach($colors as $color){
            factory(Color::class)->create([
                'color' => $color,
            ]);
        }
    }
}
