<?php

use App\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = [
            'Plastic',
            'Silicone',
            'Polycarbonate ',
            'Synthetic Leather',
            'Leather',
        ];

        foreach($materials as $material){
            factory(Material::class)->create([
                'material' => $material,
            ]);
        }
    }
}
