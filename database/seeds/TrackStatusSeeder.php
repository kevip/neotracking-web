<?php

use App\Models\TrackStatus;
use Illuminate\Database\Seeder;

class TrackStatusSeeder extends Seeder
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
                'name'        => 'pendiente'
            ]
        ];

        foreach ($status as $st) {
            TrackStatus::create($st);
        }
    }
}
