<?php

use App\Models\Region2;
use Illuminate\Database\Seeder;

class Region2Seeder extends Seeder
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
                'nombre'        => 'Centro'
            ],
            [
                'nombre'        => 'Oriente'
            ],
            [
                'nombre'        => 'Sur'
            ],
            [
                'nombre'        => 'Norte 1'
            ],
            [
                'nombre'        => 'Norte 2'
            ]
        ];

        foreach ($regiones as $region) {
            Region2::create($region);
        }
    }
}
