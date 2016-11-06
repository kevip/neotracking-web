<?php

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamentos = [
            [
                'nombre'        => 'Amazonas',
                'region2_id' => 6
            ],
            [
                'nombre'        => 'Ancash',
                'region2_id' => 5
            ],
            [
                'nombre'        => 'Apurímac',
                'region2_id' => 6
            ],
            [
                'nombre'        => 'Arequipa',
                'region2_id' => 6
            ],
            [
                'nombre'        => 'Ayacucho',
                'region2_id' => 6
            ],
            [
                'nombre'        => 'Cajamarca',
                'region2_id' => 5
            ],
            [
                'nombre'        => 'Lambayeque',
                'region2_id' => 5
            ],
            [
                'nombre'        => 'Lima',
                'region2_id' => 1
            ],
            [
                'nombre'        => 'Huanuco',
                'region2_id' => 3
            ],
            [
                'nombre'        => 'Ica',
                'region2_id' => 4
            ],
            [
                'nombre'        => 'Ucayali',
                'region2_id' => 3
            ],
            [
                'nombre'        => 'Loreto',
                'region2_id' => 6
            ],
            [
                'nombre'        => 'Junin',
                'region2_id' => 4
            ],
            [
                'nombre'        => 'Piura',
                'region2_id' => 5
            ]
        ];

        foreach ($departamentos as $departamento) {
            Departamento::create($departamento);
        }
    }
}
