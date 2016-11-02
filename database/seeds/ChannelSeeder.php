<?php

use App\Models\Channel;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = [
            [
                'name'        => 'DEPARTMENT STORE'
            ],
            [
                'name'        => 'HYPERMARKET'
            ],
            [
                'name'        => 'SPECIALTY'
            ],
            [
                'name'        => 'WHOLESALERS'
            ]
        ];

        foreach ($channels as $channel) {
            Channel::create($channel);
        }
    }
}
