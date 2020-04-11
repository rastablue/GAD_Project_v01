<?php

use Illuminate\Database\Seeder;

class OperarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Operario::create([
            'cedula'      => '1206855599',
            'name'      => 'Vicente',
            'apellido_pater'      => 'Ronquillo',
            'apellido_mater'      => 'Crow',
            'direc'      => 'Pedro Carbo',
            'tlf'      => '2735419',
            'tipo_contrato'     => 'Indefinido',
            'tipo_licencia'     => 'D1',
        ]);

        App\Operario::create([
            'cedula'      => '1206855560',
            'name'      => 'Jorge',
            'apellido_pater'      => 'Sanchez',
            'apellido_mater'      => 'Vasquez',
            'direc'      => 'Ricaurte',
            'tlf'      => '2735420',
            'tipo_contrato'     => 'Indefinido',
            'tipo_licencia'     => 'C1',
        ]);

        factory(App\Operario::class, 422)->create();
    }
}
