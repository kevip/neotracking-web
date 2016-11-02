<?php

use App\Models\Subcategoria1;
use Illuminate\Database\Seeder;

class Subcategoria1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategorias = [
            [
                'tipo'        => 'Mesa'
            ],
            [
                'tipo'        => 'Cabecera (End Cap)'
            ],
            [
                'tipo'        => 'Pared'
            ],
            [
                'tipo'        => 'Columna'
            ],
            [
                'tipo'        => 'Isla'
            ],
            [
                'tipo'        => 'Tarima'
            ],
            [
                'tipo'        => 'Ruma'
            ],
            [
                'tipo'        => 'Totem'
            ],
            [
                'tipo'        => 'Canopy'
            ],
            [
                'tipo'        => 'Modulo Doble Cara'
            ],
            [
                'tipo'        => 'Cabecera de Columna'
            ]
        ];

        foreach ($subcategorias as $subcategoria) {
            Subcategoria1::create($subcategoria);
        }
    }
}
