<?php

namespace App\Http\Controllers;

use App\Tarea;
use App\Solicitud;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Requests\CreateTareaFromSolicitud;
use App\Http\Requests\CreateTarea;
use App\Http\Requests\EditTarea;
use App\Http\Requests\FechaInicioFin;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\Datatables\Datatables;

class TareaController extends Controller
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
        return view('tareas.index', compact('solicitud_notificacion', 'requerimientos', 'solicitud_vencida'));
    }

    public function tareaData()
    {
        $tareas = Tarea::join('solicituds', 'solicituds.id', '=', 'tareas.solicitud_id')
                        ->select('tareas.id', 'solicituds.codigo_solicitud', 'tareas.fake_id',
                                'tareas.fecha_inicio', 'tareas.estado', 'tareas.detalle', 'tareas.observacion');

        return Datatables::of($tareas)
                ->addColumn('btn', 'tareas.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    public function reportes()
    {
        $tarea = Tarea::all();

        $pdf = PDF::loadView('pdfs.reporte-tareas', compact('tarea'));

        return $pdf->download('reporte-tareas.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tareas.create');
    }

    public function createFrom($solicitud)
    {
        $id = Hashids::decode($solicitud);
        $solicitud = Solicitud::findOrfail($id)->first();
        if($solicitud->estado == 'Reprobado'){
            return back()->with('danger', 'La solicitud fue reprobada y no puede editarse');
        }else{
            return view('tareas.createfrom', compact('solicitud'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(CreateTarea $request)
    {

        $solicitud = Solicitud::where('codigo_solicitud', $request->codigo)->first();

        if ($solicitud->fecha_inicio === NULL && $request->fecha_inicio === NULL
            || $solicitud->fecha_inicio !== NULL && $request->fecha_inicio === NULL) {
            Null;
        }else{
            return back()->with('warning', 'Error, primero agregue una fecha de inicio y de fin a la solicitud u omita
                                    las fechas en este requerimiento');
        }

        if ($request->fecha_inicio >= $solicitud->fecha_emision || $request->fecha_inicio === NULL) {
            Null;
        }else{
            return back()->with('danger', 'Error, la fecha de inicio no puede ser anterior a la solicitud');
        }

        if ($request->fecha_fin <= $solicitud->fecha_fin || $solicitud->fecha_fin === NULL) {
            NULL;
        }else{
            return back()->with('danger', 'Error, la fecha de fin no puede ser posterior a la solicitud');
        }

        if($solicitud->estado === 'Reprobado' || $solicitud->estado === 'Finalizado'){
            return back()->with('danger', 'Error, la solicitud no puede ser modificada');
        }else{
            $tarea = new Tarea();

            $tarea->fake_id = Str::random(5);
            $tarea->fecha_inicio = $request->fecha_inicio;
            $tarea->fecha_fin = $request->fecha_fin;
            $tarea->direc_tarea = $request->direccion;
            $tarea->detalle = $request->detalle;
            $tarea->observacion = $request->observacion;
            $tarea->estado = 'Pendiente';
            $tarea->solicitud_id = $solicitud->id;

            $tarea->save();

            return redirect()->route('solicituds.show', Hashids::encode($solicitud->id))
                ->with('info', 'Tarea Agregada');
        }

    }

    public function storeFrom(CreateTareaFromSolicitud $request)
    {

        if ($solicitud = Solicitud::where('codigo_solicitud', $request->codigo)->first()) {
            $solicitud = Solicitud::where('codigo_solicitud', $request->codigo)->first();

            if ($solicitud->fecha_inicio === NULL && $request->fecha_inicio === NULL
                || $solicitud->fecha_inicio !== NULL && $request->fecha_inicio === NULL) {
                Null;
            }else{
                return back()->with('warning', 'Error, primero agregue una fecha de inicio y de fin a la solicitud u omita
                                     las fechas en este requerimiento');
            }

            if ($request->fecha_inicio >= $solicitud->fecha_emision || $request->fecha_inicio === NULL) {
                Null;
            }else{
                return back()->with('danger', 'Error, la fecha de inicio no puede ser anterior a la solicitud');
            }

            if ($request->fecha_fin <= $solicitud->fecha_fin || $solicitud->fecha_fin === NULL) {
                NULL;
            }else{
                return back()->with('danger', 'Error, la fecha de fin no puede ser posterior a la solicitud');
            }

            if($solicitud->estado === 'Reprobado' || $solicitud->estado === 'Finalizado'){
                return redirect()->route('solicituds.show', Hashids::encode($solicitud->id))
                        ->with('danger', 'Error, la solicitud no puede ser modificada');
            }else{
                $tarea = new Tarea();

                $tarea->fake_id = Str::random(5);
                $tarea->fecha_inicio = $request->fecha_inicio;
                $tarea->fecha_fin = $request->fecha_fin;
                $tarea->direc_tarea = $request->direccion;
                $tarea->detalle = $request->detalle;
                $tarea->observacion = $request->observacion;
                $tarea->estado = 'Pendiente';
                $tarea->solicitud_id = $solicitud->id;

                $tarea->save();

                return redirect()->route('solicituds.show', Hashids::encode($solicitud->id))
                    ->with('info', 'Tarea Agregada');
            }
        } else {
            return back()->with('danger', 'No se pudo encontrar la solicitud');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show($tarea)
    {
        $id = Hashids::decode($tarea);
        $tarea = Tarea::findOrfail($id)->first();
        $solicitud = Solicitud::findOrFail($tarea->solicituds->id);

        return view('solicituds.show', compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function edit($tarea)
    {
        $id = Hashids::decode($tarea);
        $tarea = Tarea::findOrfail($id)->first();

        if($tarea->estado == 'Finalizada' || $tarea->estado == 'Abandonado'){
            return back()->with('danger', 'Este requerimiento no puede actualizarse');
        }else{
            return view('tareas.edit', compact('tarea'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(EditTarea $request, $tarea)
    {
        $tarea = Tarea::findOrFail($tarea);
        $solicitud = Solicitud::where('id', $tarea->solicitud_id)->first();

        if ($request->fecha_inicio >= $solicitud->fecha_emision) {
            Null;
        }else{
            if (!$solicitud->fecha_inicio) {
                NULL;
            }else {
                return back()->with('danger', 'Error, la fecha de inicio no puede ser anterior a la solicitud');
            }
        }

        if ($request->fecha_fin > $solicitud->fecha_fin) {
            return back()->with('danger', 'Error, la fecha de fin no puede ser posterior a la solicitud');
        }else{
            NULL;
        }

        if($solicitud->estado === 'Reprobado' || $solicitud->estado === 'Finalizado'){
            return redirect()->route('solicituds.show', Hashids::encode($solicitud->id))
                    ->with('danger', 'Error, la solicitud no puede ser modificada');
        }

        if($tarea->estado == 'Finalizada'){

            return redirect()->route('solicituds.show', Hashids::encode($solicitud->id))
                    ->with('danger', 'La tarea ha finalizado y no puede actualizarse');

        }else{

            $tarea->fecha_inicio = $request->fecha_inicio;
            $tarea->fecha_fin = $request->fecha_fin;
            $tarea->direc_tarea = $request->direccion;
            $tarea->detalle = $request->detalle;
            $tarea->observacion = $request->observacion;
            if ($request->estado) {
                $tarea->estado = $request->estado;
            }else {
                $tarea->estado = $tarea->estado;
            }

            $tarea->save();

            foreach ($tarea->maquinarias as $key) {
                $key->pivot->estado_tarea = $tarea->estado;
                $key->pivot->save();
            }

            return redirect()->route('tareas.show', Hashids::encode($tarea->id))
                ->with('info', 'Tarea actualizada');

        }
    }

    public function fechasInicioFin($tarea)
    {
        $id = Hashids::decode($tarea);
        $tarea = Tarea::findOrfail($id)->first();

        if($tarea->estado != 'Abandonado' && $tarea->estado != 'Finalizada'){
            return view('tareas.fechas.fecha_inicio_fin', compact('tarea'));
        }else{
            return back()->with('danger', 'Este requerimiento no puede editarse');
        }
    }

    public function agregaFechaInicioFin(FechaInicioFin $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $solicitud = Solicitud::where('id', $tarea->solicitud_id)->first();

        if ($request->fecha_inicio >= $tarea->solicituds->fecha_emision) {
            Null;
        }else{
            return back()->with('warning', 'Error, la fecha de inicio no puede ser menor a la fecha de emision de la solicitud');
        }

        if ($request->fecha_fin >= $solicitud->fecha_fin) {
            return back()->with('warning', 'Error, la fecha de fin de este requerimiento no puede ser mayor a la fecha de fin de la solicitud');
        }

        $tarea->fecha_inicio =  $request->fecha_inicio;
        $tarea->fecha_fin =  $request->fecha_fin;

        $tarea->save();

        return redirect()->route('solicituds.show', Hashids::encode($tarea->solicituds->id))
                ->with('info', 'Requerimiento actualizado');
    }

    public function abandonar(request $request, $id)
    {

        $tarea = Tarea::findOrFail($id);

        if ($tarea->estado != 'Abandonado') {

            $tarea->estado = 'Abandonado';

            $tarea->save();

            foreach ($tarea->maquinarias as $key) {
                $key->pivot->estado_tarea = $tarea->estado;
                $key->pivot->save();
            }

        }
    }

    public function proceso(request $request, $id)
    {

        $tarea = Tarea::findOrFail($id);

        if ($tarea->estado != 'En Proceso') {

            $tarea->estado = 'En Proceso';

            $tarea->save();

            foreach ($tarea->maquinarias as $key) {
                $key->pivot->estado_tarea = $tarea->estado;
                $key->pivot->save();
            }
            
        }
    }

    public function finalizar(request $request, $id)
    {

        $tarea = Tarea::findOrFail($id);

        if ($tarea->estado != 'Finalizada') {

            $tarea->estado = 'Finalizada';

            $tarea->save();

            foreach ($tarea->maquinarias as $key) {
                $key->pivot->estado_tarea = $tarea->estado;
                $key->pivot->save();
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function destroy($tarea)
    {
        $id = Tarea::findOrFail($tarea);
        $id->delete();
    }
}
