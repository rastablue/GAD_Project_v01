<?php

namespace App\Http\Controllers;

use App\Solicitud;
use App\Cliente;
use App\Tarea;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSolicitud;
use App\Http\Requests\CreateCliente;
use App\Http\Requests\CreateClienteFrom;
use App\Http\Requests\EditSolicitud;
use App\Http\Requests\FechaPdfSolicitud;
use App\Http\Requests\FechaInicioFin;
use Carbon\Carbon;
use Vinkla\Hashids\Facades\Hashids;
use Barryvdh\DomPDF\Facade as PDF;
use Redirect,Response,DB,Config;
use Yajra\Datatables\Datatables;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitud_vencida = 0;
        $hoy = date("Y-m-d");

        $solicitud_notificacion = Solicitud::where('estado', 'Pendiente')->get();

        foreach ($solicitud_notificacion as $key) {

            //restar la fecha de hoy de la fecha de emision de la solicitud
            $diff = abs(strtotime($hoy) - strtotime($key->fecha_emision));
            //convertir a años
            $years = floor($diff / (365*60*60*24));
            //convertir a meses
            $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
            //convertir a dias
            $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            //comprobar si han pasado 8 dias de la emision
            $dias_pasados = floor($diff - $days);
            //convertir a años
            $years = floor($dias_pasados / (365*60*60*24));
            //convertir a meses
            $months = floor(($dias_pasados - $years * 365*60*60*24) / (30*60*60*24));
            //convertir a dias
            $dias_pasados = floor(($dias_pasados - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

            if ($dias_pasados >= 8 || $months >= 1) {
                $solicitud_vencida += 1;
            }

        }

        $requerimientos = Tarea::where('estado', 'Pendiente')->get();
        return view('solicituds.index', compact('solicitud_notificacion', 'requerimientos', 'solicitud_vencida'));
    }

    public function solicitudData()
    {
        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');

        if($start_date && $end_date){
 
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
        
            $solicitudes = Solicitud::join('clientes', 'clientes.id', '=', 'solicituds.cliente_id')
                                    ->select('solicituds.id', 'solicituds.codigo_solicitud', 'solicituds.fecha_emision',
                                            'solicituds.fecha_revision', 'clientes.name', 'solicituds.detalle',
                                            'clientes.apellido_pater', 'solicituds.estado', 'solicituds.observacion',
                                            'solicituds.fecha_inicio', 'solicituds.fecha_finalizacion')
                                    ->whereRaw("date(solicituds.fecha_emision) >= '" . $start_date . "' 
                                            AND date(solicituds.fecha_emision) <= '" . $end_date . "'");

            return Datatables::of($solicitudes)
            ->addColumn('btn', 'solicituds.actions')
            ->rawColumns(['btn'])
            ->make(true);
        }

        $solicitudes = Solicitud::join('clientes', 'clientes.id', '=', 'solicituds.cliente_id')
                                ->select('solicituds.id', 'solicituds.codigo_solicitud', 'solicituds.fecha_emision',
                                        'solicituds.fecha_revision', 'clientes.name', 'solicituds.detalle',
                                        'clientes.apellido_pater', 'solicituds.estado', 'solicituds.observacion',
                                        'solicituds.fecha_inicio', 'solicituds.fecha_finalizacion');

        return Datatables::of($solicitudes)
                ->addColumn('btn', 'solicituds.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    /*
    public function solicitudData()
    {
        $solicitudesQuery = Solicitud::query();

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');

        if($start_date && $end_date){
 
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));
    
            $solicitudesQuery->whereRaw("date(solicituds.fecha_emision) >= '" . $start_date . "' AND date(solicituds.fecha_emision) <= '" . $end_date . "'");
        }

        $solicitudes = $solicitudQuery::join('clientes', 'clientes.id', '=', 'solicituds.cliente_id')
                                    ->select('solicituds.id', 'solicituds.codigo_solicitud', 'solicituds.fecha_emision',
                                            'solicituds.fecha_revision', 'clientes.name', 'solicituds.detalle',
                                            'clientes.apellido_pater', 'solicituds.estado', 'solicituds.observacion',
                                            'solicituds.fecha_finalizacion');

        return Datatables::of($solicitudes)
                ->addColumn('btn', 'solicituds.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }*/

    //Reportes PDFs
        public function reportes()
        {
            $solicitud = Solicitud::all();

            $pdf = PDF::loadView('pdfs.reporte-solicitudes', compact('solicitud'));

            return $pdf->download('reporte-solicitudes.pdf');
        }

        public function reportesPendientes()
        {
            $solicitud = Solicitud::where('estado', 'Pendiente')->get();

            $pdf = PDF::loadView('pdfs.reporte-solicitudes', compact('solicitud'));

            return $pdf->download('reporte-solicitudes.pdf');
        }

        public function reportesAprobado()
        {
            $solicitud = Solicitud::where('estado', 'Aprobado')->get();

            $pdf = PDF::loadView('pdfs.reporte-solicitudes', compact('solicitud'));

            return $pdf->download('reporte-solicitudes.pdf');
        }

        public function reportesFinalizado()
        {
            $solicitud = Solicitud::where('estado', 'Finalizado')->get();

            $pdf = PDF::loadView('pdfs.reporte-solicitudes', compact('solicitud'));

            return $pdf->download('reporte-solicitudes.pdf');
        }

        public function reportesReprobado()
        {
            $solicitud = Solicitud::where('estado', 'Reprobado')->get();

            $pdf = PDF::loadView('pdfs.reporte-solicitudes', compact('solicitud'));

            return $pdf->download('reporte-solicitudes.pdf');
        }

        public function reportesSelect()
        {
            return view('solicituds.reporteselection.fecha');
        }

        public function reportesSelectApply(FechaPdfSolicitud $request)
        {
            if ($request->customRadio == 1) {
                $solicitud = Solicitud::whereBetween('fecha_emision', [$request->fecha_inicio, $request->fecha_fin])->get();
            }
            
            if ($request->customRadio == 2) {
                $solicitud = Solicitud::whereBetween('fecha_emision', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'Aprobado')
                                        ->get();
            }

            if ($request->customRadio == 3) {
                $solicitud = Solicitud::whereBetween('fecha_emision', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'Pendiente')
                                        ->get();
            }

            if ($request->customRadio == 4) {
                $solicitud = Solicitud::whereBetween('fecha_emision', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'Reprobado')
                                        ->get();
            }

            if ($request->customRadio == 5) {
                $solicitud = Solicitud::whereBetween('fecha_emision', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'Finalizado')
                                        ->get();
            }

            $pdf = PDF::loadView('pdfs.reporte-solicitudes', compact('solicitud'));

            return $pdf->download('reporte-solicitudes.pdf');
        }

        public function pdf($id)
        {
            $id = Hashids::decode($id);
            $solicitud = Solicitud::findOrFail($id)->first();

            $pdf = PDF::loadView('pdfs.solicitudes', compact('solicitud'));

            return $pdf->download('solicitud-'.$solicitud->codigo_solicitud.'.pdf');
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('solicituds.create');
    }

    public function createCliente(Request $request)
    {
        return view('solicituds.createcliente', compact('request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSolicitud $request)
    {

        $date = Carbon::now();
        $total = Solicitud::all();
        $codigo = rand(1000000, 9999999);

        /*if ($total->codigo_solicitud == 0 || $total->codigo_solicitud == '0' || empty($total->codigo_solicitud)) {
            $codigo = '1000001';
        } else {
            $codigo = $total->codigo_solicitud + 1;
        }*/

        if (Solicitud::where('codigo_solicitud', $codigo)->first()) {
            return back() ->with('danger', 'Error, La solicitud ya existe');

        } else {

            if($cliente = Cliente::where('cedula', $request->cedula)->first()){

                $cliente = Cliente::where('cedula', $request->cedula)->first();

                $solicitud = new Solicitud();
                $solicitud->codigo_solicitud = $codigo;
                $solicitud->fecha_emision = $date;
                $solicitud->fecha_inicio = $request->fecha_inicio;
                $solicitud->fecha_fin = $request->fecha_fin;
                $solicitud->detalle = $request->detalle;
                $solicitud->observacion = $request->observacion;
                $solicitud->estado = 'Pendiente';
                $solicitud->user_id = $request->user_id;
                $solicitud->cliente_id = $cliente->id;


                if ($request->hasFile('file')) {
                    $image = $request->file->store('public');
                    $solicitud->path = $image;
                }
                $solicitud->save();

                $redirect = Solicitud::where('codigo_solicitud', $codigo)->first();

                return redirect()->route('solicituds.show', Hashids::encode($redirect->id))
                        ->with('info', 'Solicitud agregada');

            }else{

                return view('solicituds.confirmacion', compact('request'));

            }

        }

    }

    public function clienteStore(CreateClienteFrom $request)
    {

        $date = Carbon::now();

        $clientes = new Cliente();

        $clientes->cedula = $request->cedula;
        $clientes->name = $request->nombre;
        $clientes->apellido_pater = $request->apellido_paterno;
        $clientes->apellido_mater = $request->apellido_materno;
        $clientes->direc = $request->direccion;
        $clientes->tlf = $request->telefono;
        $clientes->email = $request->email;

        $clientes->save();

        $cliente = Cliente::where('cedula', $request->cedula)->first();

        $total = Solicitud::get()->last();

        $codigo = rand(1000000, 9999999);

        $solicitud = new Solicitud();
        $solicitud->codigo_solicitud = $codigo;
        $solicitud->fecha_emision = $date;
        $solicitud->fecha_inicio = $request->fecha_inicio;
        $solicitud->fecha_fin = $request->fecha_fin;
        $solicitud->detalle = $request->detalle;
        $solicitud->observacion = $request->observacion;
        $solicitud->estado = 'Pendiente';
        $solicitud->user_id = $request->user_id;
        $solicitud->cliente_id = $cliente->id;


        if ($request->hasFile('file')) {
            $image = $request->file->store('public');
            $solicitud->path = $image;
        }

        $solicitud->save();

        $redirect = Solicitud::where('codigo_solicitud', $codigo)->first();

        return redirect()->route('solicituds.show', Hashids::encode($redirect->id))
                ->with('info', 'Solicitud agregada');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show($solicitud)
    {
        $id = Hashids::decode($solicitud);
        $solicitud = Solicitud::findOrfail($id)->first();

        return view('solicituds.show', compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit($solicitud)
    {
        $id = Hashids::decode($solicitud);
        $solicitud = Solicitud::findOrfail($id)->first();

        if($solicitud->estado != 'Reprobado' && $solicitud->estado != 'Finalizado'){
            return view('solicituds.edit', compact('solicitud'));
        }else{
            return back()->with('danger', 'Esta solicitud no puede editarse');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(EditSolicitud $request, $id)
    {
        $date = Carbon::now();

        $cliente = Cliente::where('cedula', $request->cedula)->first();

        $solicitud = Solicitud::findOrFail($id);

        if ($request->fecha_inicio >= $solicitud->fecha_emision || $request->fecha_inicio === NULL) {
            Null;
        }else{
            return back()->with('danger', 'Error, la fecha de inicio no puede ser menor a la fecha de ingreso');
        }

        $solicitud->detalle = $request->detalle;
        $solicitud->observacion = $request->observacion;
        $solicitud->fecha_inicio =  $request->fecha_inicio;
        $solicitud->fecha_fin =  $request->fecha_fin;

        if ($solicitud->estado == 'Reprobado') {

            foreach ($solicitud->tareas->all() as $key) {
                $key->estado = 'Abandonado';

                $key->save();
            }

        }

        if ($solicitud->estado == 'Finalizado') {

            foreach ($solicitud->tareas->all() as $key) {
            
                if ($key->estado === 'En Proceso') {

                    $key->estado = 'Finalizada';
                    $key->save();

                }else{

                    $key->estado = 'Abandonado';
                    $key->save();

                }
            }

        }

        if ($request->hasFile('file')) {
            $image = $request->file->store('public');
            $solicitud->path = $image;
        }

        $solicitud->save();

        return redirect()->route('solicituds.show', Hashids::encode($solicitud->id))
                ->with('info', 'Solicitud actualizada');

    }

    public function fechasInicioFin($solicitud)
    {
        $id = Hashids::decode($solicitud);
        $solicitud = Solicitud::findOrfail($id)->first();

        if($solicitud->estado != 'Reprobado' && $solicitud->estado != 'Finalizado'){
            return view('solicituds.fechas.fecha_inicio_fin', compact('solicitud'));
        }else{
            return back()->with('danger', 'Esta solicitud no puede editarse');
        }
    }

    public function agregaFechaInicioFin(FechaInicioFin $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        if ($request->fecha_inicio >= $solicitud->fecha_emision) {
            Null;
        }else{
            return back()->with('warning', 'Error, la fecha de inicio no puede ser menor a la fecha de ingreso');
        }

        $solicitud->fecha_inicio =  $request->fecha_inicio;
        $solicitud->fecha_fin =  $request->fecha_fin;

        $solicitud->save();

        return redirect()->route('solicituds.show', Hashids::encode($solicitud->id))
                ->with('info', 'Solicitud actualizada');
    }

    public function aprobar(request $request, $id)
    {

        $date = Carbon::now();

        $solicitud = Solicitud::findOrFail($id);

        if ($solicitud->estado != 'Aprobado') {

            $solicitud->estado = 'Aprobado';
            $solicitud->fecha_revision = $date;

            if (!$solicitud->fecha_inicio) {
                $solicitud->fecha_inicio = $date;
            }

            $solicitud->save();

            foreach ($solicitud->tareas->all() as $key) {

                if ($key->estado !== 'Abandonado' && $key->estado !== 'Finalizada') {
                    
                    $key->estado = 'En Proceso';

                    $key->save();

                }
                
            }

        }
    }

    public function reprobar(request $request, $id)
    {

        $date = Carbon::now();

        $solicitud = Solicitud::findOrFail($id);

        if ($solicitud->estado != 'Reprobado') {

            $solicitud->estado = 'Reprobado';
            $solicitud->fecha_revision = $date;

            $solicitud->save();

            foreach ($solicitud->tareas->all() as $key) {
                $key->estado = 'Abandonado';

                $key->save();
            }

        }
    }

    public function finalizar(request $request, $id)
    {

        $date = Carbon::now();

        $solicitud = Solicitud::findOrFail($id);

        if ($solicitud->estado != 'Reprobado') {

            $solicitud->estado = 'Finalizado';
            $solicitud->fecha_finalizacion = $date;

            if (!$solicitud->fecha_fin) {
                $solicitud->fecha_fin = $date;
            }

            $solicitud->save();

            foreach ($solicitud->tareas->all() as $key) {
                
                if ($key->estado === 'En Proceso') {

                    $key->estado = 'Finalizada';
                    $key->save();

                }
                if ($key->estado === 'Pendiente') {

                    $key->estado = 'Abandonado';
                    $key->save();

                }
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy($solicitud)
    {
        $id = Solicitud::findOrFail($solicitud);
        $id->delete();
    }
}
