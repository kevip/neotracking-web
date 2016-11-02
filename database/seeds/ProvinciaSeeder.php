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
                'nombre'        => 'Cañete'
            ],
            [
                'nombre'        => 'Lima'
            ],
            [
                'nombre'        => 'Chiclayo'
            ],
            [
                'nombre'        => 'Chimbote'
            ],
            [
                'nombre'        => 'Huanuco'
            ],
            [
                'nombre'        => 'Ica'
            ],
            [
                'nombre'        => 'Maynas'
            ],
            [
                'nombre'        => 'Chanchamayo'
            ],
            [
                'nombre'        => 'Arequipa'
            ],
            [
                'nombre'        => 'Coronel Portillo'
            ]
        ];

        foreach ($provincias as $provincia) {
            Provincia::create($provincia);
        }
    }
}
