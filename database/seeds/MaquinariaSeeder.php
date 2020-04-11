<?php

use Illuminate\Database\Seeder;

class MaquinariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Maquinaria::create([
            'codigo_nro_gad' => 'GAD-2020-1',
            'placa' => 'HOWDOES-23',
            'modelo' => '785D',
            'anio' => '2016',
            'tipo_vehiculo' => 'Camion Minero',
            'observacion' => '9cito',
            'marca_id' => 1,
            'operario_id' => 1,
        ]);

        App\Maquinaria::create([
            'codigo_nro_gad' => 'GAD-2020-2',
            'placa' => 'HOWDOES-24',
            'modelo' => '785D',
            'anio' => '2016',
            'tipo_vehiculo' => 'Camion Minero',
            'observacion' => '9cito',
            'marca_id' => 2,
            'operario_id' => 2,
        ]);

        App\Maquinaria::create([
            'codigo_nro_gad' => 'GAD-2020-3',
            'placa' => 'HOWDOES-25',
            'modelo' => '785D',
            'anio' => '2016',
            'tipo_vehiculo' => 'Camion Minero',
            'observacion' => '9cito',
            'marca_id' => 3,
            'operario_id' => 1,
        ]);

        App\Maquinaria::create([
            'codigo_nro_gad' => 'GAD-2020-4',
            'placa' => 'HOWDOES-26',
            'modelo' => '785D',
            'anio' => '2016',
            'tipo_vehiculo' => 'Camion Minero',
            'observacion' => '9cito',
            'marca_id' => 4,
            'operario_id' => 2,
        ]);
    }
}
