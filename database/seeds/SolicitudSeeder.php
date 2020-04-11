<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SolicitudSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Solicitud::create([
            'codigo_solicitud'      => 'GAD-2020-1',
            'fecha_emision'      => Carbon::now(),
            'fecha_revision'      => Carbon::now(),
            'detalle'      => 'Nada 1',
            'estado'      => 'Pendiente',
            'user_id'      => '1',
            'cliente_id'     => '2',
        ]);
    }
}
