<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username'      => 'Admin',
                'email'     => 'admin@trackingsystem.com',
                'password'  => 'admin'
            ],
            [
                'username'      => 'Supervisor',
                'email'     => 'support@trackingsystem.com',
                'password'  => 'support'
            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
