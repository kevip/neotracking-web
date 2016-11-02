<?php

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
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
                'tipo'        => 'TV'
            ],
            [
                'tipo'        => 'WM'
            ],
            [
                'tipo'        => 'REF'
            ],
            [
                'tipo'        => 'CAV'
            ],
            [
                'tipo'        => 'ISP'
            ],
            [
                'tipo'        => 'AC'
            ]
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
