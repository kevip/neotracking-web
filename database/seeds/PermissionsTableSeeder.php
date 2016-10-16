<?php

use Illuminate\Database\Seeder;

use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'gestionar_usuarios', 'description' => 'Puede administrar usuarios'],
            ['name' => 'gestionar_roles', 'description' => 'Puede administrar roles'],
            ['name' => 'gestionar_permisos', 'description' => 'Puede administrar permisos'],
            ['name' => 'crear_mobiliario', 'description' => 'Puede levantar informacion del mobiliario'],
            ['name' => 'editar_mobiliario', 'description' => 'Puede editar mobiliario'],
            ['name' => 'baja_mobiliario', 'description' => 'Puede dar de baja al mobiliario'],
            ['name' => 'gestionar_placas', 'description' => 'Puede administrar placas'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
