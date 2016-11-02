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
                'nombre'        => 'Amazonas'
            ],
            [
                'nombre'        => 'Ancash'
            ],
            [
                'nombre'        => 'Apurímac'
            ],
            [
                'nombre'        => 'Arequipa'
            ],
            [
                'nombre'        => 'Ayacucho'
            ],
            [
                'nombre'        => 'Cajamarca'
            ],
            [
                'nombre'        => 'Lambayeque'
            ],
            [
                'nombre'        => 'Lima'
            ],
            [
                'nombre'        => 'Huanuco'
            ],
            [
                'nombre'        => 'Ica'
            ],
            [
                'nombre'        => 'Ucayali'
            ]
        ];

        foreach ($departamentos as $departamento) {
            Departamento::create($departamento);
        }
    }
}
