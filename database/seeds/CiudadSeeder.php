<?php

use App\Models\Ciudad;
use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ciudads = [
            [
                'name'        => 'Ica'
            ],
            [
                'name'        => 'Iquitos'
            ],
            [
                'name'        => 'Lima'
            ],
            [
                'name'        => 'La Merced'
            ],
            [
                'name'        => 'Piura'
            ],
            [
                'name'        => 'Arequipa'
            ],
            [
                'name'        => 'Pucallpa'
            ]
        ];

        foreach ($ciudads as $ciudad) {
            Ciudad::create($ciudad);
        }
    }
}
