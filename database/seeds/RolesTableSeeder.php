<?php

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name'        => 'Administrador',
                'description' => 'Rol de administrador',
                'permissions' => [1,2,3,5,6,7]
            ],
            [
                'name'        => 'Supervisor',
                'description' => 'Rol de supervisor',
                'permissions' => [4]
            ]
        ];

        foreach ($roles as $role) {
            Role::create(array_except($role, ['permissions']))
                ->permissions()->attach($role['permissions'])
            ;
        }
        User::find(1)->roles()->attach(1);
        //User::find(2)->roles()->attach(2);
    }
}
