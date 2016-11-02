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
                'name'        => 'Ica'
            ],
            [
                'name'        => 'Maynas'
            ],
            [
                'name'        => 'Surco'
            ],
            [
                'name'        => 'Lima'
            ],
            [
                'name'        => 'Independencia'
            ],
            [
                'name'        => 'Miraflores'
            ],
            [
                'name'        => 'Piura'
            ],
            [
                'name'        => 'Arequipa'
            ],
            [
                'name'        => 'Pucallpa'
            ],
            [
                'name'        => 'Jesus Maria'
            ],
            [
                'name'        => 'San Isidro'
            ],
            [
                'name'        => 'San Miguel'
            ],
            [
                'name'        => 'Santa Anita'
            ]
        ];

        foreach ($distritos as $distrito) {
            Distrito::create($distrito);
        }
    }
}
