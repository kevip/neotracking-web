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
                'nombre'        => 'Lima',
                'region1_id'        => 1
            ],
            [
                'nombre'        => 'Centro',
                'region1_id'        => 1
            ],
            [
                'nombre'        => 'Oriente',
                'region1_id'        => 2
            ],
            [
                'nombre'        => 'Sur',
                'region1_id'        => 2
            ],
            [
                'nombre'        => 'Norte 1',
                'region1_id'        => 2
            ],
            [
                'nombre'        => 'Norte 2',
                'region1_id'        => 2
            ]
        ];

        foreach ($regiones as $region) {
            Region2::create($region);
        }
    }
}
