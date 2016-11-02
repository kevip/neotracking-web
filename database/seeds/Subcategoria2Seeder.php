<?php

use App\Models\Subcategoria2;
use Illuminate\Database\Seeder;

class Subcategoria2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            [
                'tipo'        => 'OLED'
            ],
            [
                'tipo'        => 'Super Ultra HDTV'
            ],
            [
                'tipo'        => 'Ultra HDTV'
            ],
            [
                'tipo'        => 'Smart TV'
            ],
            [
                'tipo'        => 'Cinema 3D'
            ],
            [
                'tipo'        => 'Acerada'
            ],
            [
                'tipo'        => 'Coreana'
            ],
            [
                'tipo'        => 'Cubo'
            ],
            [
                'tipo'        => 'Roja'
            ],
            [
                'tipo'        => 'Chilena'
            ],
            [
                'tipo'        => 'Twin Wash'
            ],
            [
                'tipo'        => 'Turbo Shot'
            ]
        ];

        foreach ($categorias as $categoria) {
            Subcategoria2::create($categoria);
        }
    }
}
