<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Tarea::create([
            'fake_id'      => Str::random(5),
            'fecha_inicio'      => Carbon::now(),
            'fecha_fin'      => Carbon::now(),
            'direc_tarea'   => 'Las Naves',
            'detalle'      => 'Nada 1',
            'estado'      => 'Pendiente',
            'solicitud_id'      => '1',
        ]);

        App\Tarea::create([
            'fake_id'      => Str::random(5),
            'fecha_inicio'      => Carbon::now(),
            'fecha_fin'      => Carbon::now(),
            'direc_tarea'   => 'Las Naves',
            'detalle'      => 'Nada 2',
            'estado'      => 'Pendiente',
            'solicitud_id'      => '1',
        ]);

        App\Tarea::create([
            'fake_id'      => Str::random(5),
            'fecha_inicio'      => Carbon::now(),
            'fecha_fin'      => Carbon::now(),
            'direc_tarea'   => 'Las Naves',
            'detalle'      => 'Nada 3',
            'estado'      => 'Pendiente',
            'solicitud_id'      => '1',
        ]);
    }
}
