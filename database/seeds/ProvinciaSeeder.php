<?php

use App\Models\Provincia;
use Illuminate\Database\Seeder;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provincias = [
            [
                'nombre'        => 'Cañete',
                'departamento_id' => 8
            ],
            [
                'nombre'        => 'Lima',
                'departamento_id' => 8
            ],
            [
                'nombre'        => 'Chiclayo',
                'departamento_id' => 7
            ],
            [
                'nombre'        => 'Chimbote',
                'departamento_id' => 2
            ],
            [
                'nombre'        => 'Huanuco',
                'departamento_id' => 9
            ],
            [
                'nombre'        => 'Ica',
                'departamento_id' => 10
            ],
            [
                'nombre'        => 'Maynas',
                'departamento_id' => 12
            ],
            [
                'nombre'        => 'Chanchamayo',
                'departamento_id' => 13
            ],
            [
                'nombre'        => 'Arequipa',
                'departamento_id' => 4
            ],
            [
                'nombre'        => 'Coronel Portillo',
                'departamento_id' => 11
            ],
            [
                'nombre'        => 'Piura',
                'departamento_id' => 14
            ]
        ];

        foreach ($provincias as $provincia) {
            //Provincia::create($provincia);
        }
    }
}
