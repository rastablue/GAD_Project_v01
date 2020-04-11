<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(OperarioSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(MaquinariaSeeder::class);
        $this->call(MantenimientoSeeder::class);
        $this->call(SolicitudSeeder::class);
        $this->call(TareaSeeder::class);
        $this->call(TrabajoSeeder::class);
        $this->call(PermissionsTableSeeder::class);
    }
}
