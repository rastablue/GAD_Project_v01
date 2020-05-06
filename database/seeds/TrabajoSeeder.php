<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrabajoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Trabajo::create([
            'fake_id'      => Str::random(5),
            'manobra'      => 'Mano de Obra 1',
            'repuestos'      => 'Repuestos 1',
            'costo_manobra'   => 21.3,
            'costo_repuestos'      => 40.52,
            'estado'      => 'En espera',
            'tipo'        => 'Correctivo',
            'mantenimiento_id'      => 3,
        ]);

        App\Trabajo::create([
            'fake_id'      => Str::random(5),
            'manobra'      => 'Mano de Obra 2',
            'repuestos'      => 'Repuestos 2',
            'costo_manobra'   => 11.3,
            'costo_repuestos'      => 30.52,
            'estado'      => 'En espera',
            'tipo'        => 'Preventivo',
            'mantenimiento_id'      => 1,
        ]);

        App\Trabajo::create([
            'fake_id'      => Str::random(5),
            'manobra'      => 'Mano de Obra 3',
            'repuestos'      => 'Repuestos 3',
            'costo_manobra'   => 111.3,
            'costo_repuestos'      => 130.52,
            'estado'      => 'En espera',
            'tipo'        => 'Correctivo',
            'mantenimiento_id'      => 2,
        ]);
    }
}
