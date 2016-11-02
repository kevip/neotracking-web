<?php

use App\Models\Region1;
use Illuminate\Database\Seeder;

class Region1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regiones = [
            [
                'nombre'        => 'Lima'
            ],
            [
                'nombre'        => 'Provincias'
            ]
        ];

        foreach ($regiones as $region) {
            Region1::create($region);
        }
    }
}
