<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(TipoTiendaSeeder::class);
        $this->call(Region1Seeder::class);
        $this->call(Region2Seeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(Subcategoria1Seeder::class);
        $this->call(Subcategoria2Seeder::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(CiudadSeeder::class);
        $this->call(DistritoSeeder::class);
        $this->call(ChannelSeeder::class);
        $this->call(RetailSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(DireccionUbicacionSeeder::class);
        $this->call(StockStatusSeeder::class);
        $this->call(TrackStatusSeeder::class);

    }
}
