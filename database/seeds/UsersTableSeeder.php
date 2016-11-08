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
                'password'  => 'admin',
                'phone_number' => '956235689'
            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
