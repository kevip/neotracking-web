<?php

use App\Models\Distrito;
use Illuminate\Database\Seeder;

class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $distritos = [
            [
                'name'        => 'Ica',
                'ciudad_id'   => 1
            ],
            [
                'name'        => 'Maynas',
                'ciudad_id'   => 2
            ],
            [
                'name'        => 'Surco',
                'ciudad_id'   => 3
            ],
            [
                'name'        => 'Lima',
                'ciudad_id'   => 3
            ],
            [
                'name'        => 'Independencia',
                'ciudad_id'   => 3
            ],
            [
                'name'        => 'Miraflores',
                'ciudad_id'   => 3
            ],
            [
                'name'        => 'Piura',
                'ciudad_id'   => 5
            ],
            [
                'name'        => 'Arequipa',
                'ciudad_id'   => 6
            ],
            [
                'name'        => 'Pucallpa',
                'ciudad_id'   => 7
            ],
            [
                'name'        => 'Jesus Maria',
                'ciudad_id'   => 3
            ],
            [
                'name'        => 'San Isidro',
                'ciudad_id'   => 3
            ],
            [
                'name'        => 'San Miguel',
                'ciudad_id'   => 3
            ],
            [
                'name'        => 'Santa Anita',
                'ciudad_id'   => 3
            ]
        ];

        foreach ($distritos as $distrito) {
            Distrito::create($distrito);
        }
    }
}
