<?php

use Illuminate\Database\Seeder;
use App\Models\TipoTienda;

class TipoTiendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos_tienda = [
            [
                'name'  =>  'Stand Alone'
            ],
            [
                'name'  =>  'Mall'
            ],
            [
                'name'  =>  'Baja'
            ]
        ];

        foreach($tipos_tienda as $tipo_tienda){
            //TipoTienda::create($tipo_tienda);
        }
    }
}
