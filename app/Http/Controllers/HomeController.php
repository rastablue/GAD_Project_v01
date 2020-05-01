<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\PendientesChart;
use App\Charts\InfoChart;
use Carbon\Carbon;
use App\Solicitud;
use App\Tarea;
use App\Mantenimiento;
use App\Trabajo;
use App\User;
use App\Cliente;
use App\Operario;
use App\Maquinaria;
use App\MaquinariaTarea;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $fillColors = [
            "rgba(114, 111, 255, 0.83)",    //1
            "rgba(52, 236, 102, 0.89)",     //2
            "rgba(255, 117, 56, 0.78)",    //3
            "rgba(255, 210, 29, 0.96)",      //4
            "rgba(0, 0, 156, 0.63)",        //5
            "rgba(255, 255, 115, 0.63)",    //6
            "rgba(255, 244, 115, 0.77)",    //7
            "rgba(87, 254, 0, 0.68)",       //8
            "rgba(145, 120, 47, 0.34)",      //9
            "rgba(47, 142, 189, 0.47)",     //10
            "rgba(0, 232, 75, 0.47)",       //11
            "rgba(0, 142, 246, 0.47)"       //12

        ];

        $fillColorsp = [
            "rgba(116, 166, 255, 0.83)",    //1
            "rgba(105, 255, 135, 0.78)",     //2
            "rgba(255, 159, 83, 0.8)",    //3
            "rgba(255, 210, 63, 0.81)",      //4
            "rgba(0, 0, 156, 0.63)",        //5
            "rgba(255, 255, 115, 0.63)",    //6
            "rgba(255, 244, 115, 0.77)",    //7
            "rgba(87, 254, 0, 0.68)",       //8
            "rgba(145, 120, 47, 0.34)",      //9
            "rgba(47, 142, 189, 0.47)",     //10
            "rgba(0, 232, 75, 0.47)",       //11
            "rgba(0, 142, 246, 0.47)"       //12

        ];

        $solicitud = Solicitud::all();
        $solicitudp = Solicitud::where('estado', 'Pendiente');

        $tarea = Tarea::all();
        $tareap = Tarea::where('estado', 'Pendiente');

        $mantenimiento = Mantenimiento::all();
        $mantenimientop = Mantenimiento::where('estado', 'En espera');

        $trabajo = Trabajo::all();
        $trabajop = Trabajo::where('estado', 'En espera');

        $pendientesChart = new PendientesChart;
        /*
        foreach ($fecha as $key) {

            $fechas = Carbon::parse($key->fecha_ingreso)->timestamp;
            $mes = date("m", $fechas);
            if ($mes == 1) {
                $solicitud->labels(['Ene']);
            }
            if ($mes == 2) {
                $solicitud->labels(['Feb']);
            }
            if ($mes == 3) {
                $solicitud->labels(['Mar']);
            }
            if ($mes == 4) {
                $solicitud->labels(['Abr']);
            }
            if ($mes == 5) {
                $solicitud->labels(['May']);
            }
            if ($mes == 6) {
                $solicitud->labels(['Jun']);
            }
            if ($mes == 7) {
                $solicitud->labels(['Jul']);
            }
            if ($mes == 8) {
                $solicitud->labels(['Ago']);
            }
            if ($mes == 9) {
                $solicitud->labels(['Sep']);
            }
            if ($mes == 10) {
                $solicitud->labels(['Oct']);
            }
            if ($mes == 11) {
                $solicitud->labels(['Nov']);
            }
            if ($mes == 12) {
                $solicitud->labels(['Dic']);
            }

        }
        */
        $pendientesChart->labels(['Solicitudes', 'Tareas', 'Mantenimientos', 'Trabajos']);
        $pendientesChart->dataset('Pendientes', 'bar', [$solicitudp->count(), $tareap->count(), $mantenimientop->count(), $trabajop->count()])
            ->backgroundcolor($fillColorsp);
        $pendientesChart->dataset('Total', 'bar', [$solicitud->count(), $tarea->count(), $mantenimiento->count(), $trabajo->count()])
            ->backgroundcolor($fillColors);



        $users = User::all();
        $clientes = Cliente::all();
        $operarios = Operario::all();

        $personasChart = new InfoChart;

        $personasChart->labels(['Funcionarios', 'Clientes', 'Operarios']);
        $personasChart->minimalist(true);
        $personasChart->dataset('Total', 'doughnut', [$users->count(), $clientes->count(), $operarios->count()])
            ->backgroundcolor($fillColors);



        $maquinarias = Maquinaria::all();
        $tareaf = Tarea::where('estado', 'Finalizada');

        foreach (@$maquinarias as $key) {
            $end = 0;
            if (@$key->first()->tareas->first()->estado == 'Finalizada') {
                @$end = $end + 1;
            }
        }


        $maquinariaChart = new InfoChart;

        $maquinariaChart->labels(['Maquinarias', 'Tareas Finalizadas.']);
        $maquinariaChart->minimalist(true);
        $maquinariaChart->dataset('Total', 'doughnut', [$maquinarias->count(), @$tareaf->count()])
            ->backgroundcolor($fillColors);

        return view('home', compact('pendientesChart', 'personasChart', 'personaChart', 'maquinariaChart') );
    }

}
