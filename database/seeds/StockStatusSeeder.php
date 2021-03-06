<?php

use App\Models\StockStatus;
use Illuminate\Database\Seeder;

class StockStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'name'        => 'alta'
            ],
            [
                'name'        => 'baja'
            ],
            [
                'name'        => 'pendiente_alta'
            ],
            [
                'name'        => 'pendiente_baja'
            ],
            [
                'name'        => 'pendiente_alta_puede_editar'
            ]
        ];

        foreach ($status as $st) {
            StockStatus::create($st);
        }
    }
}
