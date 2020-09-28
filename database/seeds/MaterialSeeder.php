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
            'Plast',
            'Silikón',
            'Semiš',
            'Syntetická koža',
            'Koža',
        ];

        foreach($materials as $material){
            factory(Material::class)->create([
                'material' => $material,
            ]);   
        }
    }
}
