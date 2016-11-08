<?php

use App\Models\Retail;
use Illuminate\Database\Seeder;

class RetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $retails = [
            [
                'name'        => 'SAGA'
            ],
            [
                'name'        => 'RIPLEY'
            ],
            [
                'name'        => 'OECHSLE'
            ],
            [
                'name'        => 'PLAZA VEA'
            ],
            [
                'name'        => 'METRO'
            ],
            [
                'name'        => ''
            ],
            [
                'name'        => 'TIENDAS EFE'
            ],
            [
                'name'        => 'PARIS'
            ],
            [
                'name'        => 'ESTILOS'
            ],
            [
                'name'        => 'TOTTUS'
            ],
            [
                'name'        => 'CARSA'
            ],
            [
                'name'        => 'ELEKTRA'
            ],
            [
                'name'        => 'HIRAOKA'
            ],
            [
                'name'        => 'LA CURACAO'
            ],
            [
                'name'        => 'MARCIMEX'
            ],
            [
                'name'        => 'CHANCAFE'
            ],
            [
                'name'        => 'GALLO MAS GALLO'
            ],
            [
                'name'        => 'CHAUCA DE YATACO'
            ],
            [
                'name'        => 'COMERCIAL COUNTRY'
            ],
            [
                'name'        => 'CREDIVARGAS'
            ],
            [
                'name'        => 'EH INVERSIONES'
            ]
        ];

        foreach ($retails as $retail) {
            //Retail::create($retail);
        }
    }
}
