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
                'name'        => 'Ica',
                'provincia_id' => 6
            ],
            [
                'name'        => 'Iquitos',
                'provincia_id' => 7
            ],
            [
                'name'        => 'Lima',
                'provincia_id' => 2
            ],
            [
                'name'        => 'La Merced',
                'provincia_id' => 8
            ],
            [
                'name'        => 'Piura',
                'provincia_id' => 11
            ],
            [
                'name'        => 'Arequipa',
                'provincia_id' => 9
            ],
            [
                'name'        => 'Pucallpa',
                'provincia_id' => 10
            ]
        ];

        foreach ($ciudads as $ciudad) {
            Ciudad::create($ciudad);
        }
    }
}
