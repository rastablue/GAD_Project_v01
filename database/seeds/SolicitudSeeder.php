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
            'codigo_solicitud'      => '1000000',
            'fecha_emision'      => Carbon::now(),
            'fecha_revision'      => Carbon::now(),
            'detalle'      => 'Detalle 1',
            'Observacion'      => 'Observacion 1',
            'estado'      => 'Pendiente',
            'user_id'      => '1',
            'cliente_id'     => '2',
        ]);
    }
}
