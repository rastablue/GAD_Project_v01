<?php

use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Cliente::create([
            'cedula'      => '1206855593',
            'name'      => 'Martin',
            'apellido_pater'      => 'Ronquillo',
            'apellido_mater'      => 'Vargas',
            'direc'      => 'Pedro Carbo',
            'tlf'      => '2735416',
            'email'     => 'marticarcel@hotmail.com',
        ]);

        App\Cliente::create([
            'cedula'      => '1206855594',
            'name'      => 'Mariana',
            'apellido_pater'      => 'Quisirumbay',
            'apellido_mater'      => 'Armijo',
            'direc'      => 'Las Naves',
            'tlf'      => '2735417',
            'email'     => 'mariana@gmail.com',
        ]);

        factory(App\Cliente::class, 12)->create();
    }
}
