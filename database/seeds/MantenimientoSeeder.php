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
            'observacion'      => 'Nada 1',
            'diagnostico'      => 'Ninguno 1',
            'valor_total'      => 30.4,
            'estado'      => 'En espera',
            'maquinaria_id'     => 1,
        ]);

        App\Mantenimiento::create([
            'codigo'      => '2641365',
            'fecha_ingreso'      => Carbon::now(),
            'fecha_egreso'      => Carbon::now(),
            'observacion'      => 'Nada 2',
            'diagnostico'      => 'Ninguno 2',
            'valor_total'      => 520.4,
            'estado'      => 'En espera',
            'maquinaria_id'     => 1,
        ]);

        App\Mantenimiento::create([
            'codigo'      => '2741365',
            'fecha_ingreso'      => Carbon::now(),
            'fecha_egreso'      => Carbon::now(),
            'observacion'      => 'Nada 3',
            'diagnostico'      => 'Ninguno 3',
            'valor_total'      => 3003.4,
            'estado'      => 'En espera',
            'maquinaria_id'     => 1,
        ]);
    }
}
