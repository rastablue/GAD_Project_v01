<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MantenimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Mantenimiento::create([
            'codigo'      => '2541365',
            'fecha_ingreso'      => Carbon::now(),
            'fecha_egreso'      => Carbon::now(),
            'observacion'      => 'Observacion Mantenimiento 1',
            'diagnostico'      => 'Diagnostico Mantenimiento 1',
            'valor_total'      => 41.82,
            'estado'      => 'En espera',
            'maquinaria_id'     => 1,
        ]);

        App\Mantenimiento::create([
            'codigo'      => '2641365',
            'fecha_ingreso'      => Carbon::now(),
            'fecha_egreso'      => Carbon::now(),
            'observacion'      => 'Observacion Mantenimiento 2',
            'diagnostico'      => 'Diagnostico Mantenimiento 2',
            'valor_total'      => 241.82,
            'estado'      => 'En espera',
            'maquinaria_id'     => 1,
        ]);

        App\Mantenimiento::create([
            'codigo'      => '2741365',
            'fecha_ingreso'      => Carbon::now(),
            'fecha_egreso'      => Carbon::now(),
            'observacion'      => 'Observacion Mantenimiento 3',
            'diagnostico'      => 'Diagnostico Mantenimiento 3',
            'valor_total'      => 61.82,
            'estado'      => 'En espera',
            'maquinaria_id'     => 1,
        ]);
    }
}
