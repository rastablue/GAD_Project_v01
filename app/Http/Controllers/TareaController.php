<?php

namespace App\Http\Controllers;

use App\Tarea;
use App\Solicitud;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Requests\CreateTareaFromSolicitud;
use App\Http\Requests\CreateTarea;
use App\Http\Requests\EditTarea;
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
        $tareas = Tarea::all();
        return view('tareas.index', compact('$tareas'));
    }

    public function tareaData()
    {
        $tareas = Tarea::join('solicituds', 'solicituds.id', '=', 'tareas.solicitud_id')
                        ->select('tareas.id', 'solicituds.codigo_solicitud', 'tareas.fake_id',
                                'tareas.fecha_inicio', 'tareas.estado');

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

        if ($solicitud = Solicitud::where('codigo_solicitud', $request->codigo1.'-'.$request->codigo2.'-'.$request->codigo3)->first()) {
            $solicitud = Solicitud::where('codigo_solicitud', $request->codigo1.'-'.$request->codigo2.'-'.$request->codigo3)->first();

            if($solicitud->estado == 'Reprobado'){
                return back()->with('danger', 'La solicitud esta reprobada, no pueden agregarse tareas');
            }else{
                $tarea = new Tarea();

                $tarea->fake_id = Str::random(5);
                $tarea->fecha_inicio = $request->fecha_inicio;
                $tarea->fecha_fin = $request->fecha_fin;
                $tarea->direc_tarea = $request->direccion;
                $tarea->detalle = $request->detalle;
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

    public function storeFrom(CreateTareaFromSolicitud $request)
    {

        if ($solicitud = Solicitud::where('codigo_solicitud', $request->codigo)->first()) {
            $solicitud = Solicitud::where('codigo_solicitud', $request->codigo)->first();

            if($solicitud->estado == 'Reprobado'){
                return redirect()->route('solicituds.show', Hashids::encode($solicitud->id))
                        ->with('danger', 'La solicitud esta reprobada, no pueden agregarse tareas');
            }else{
                $tarea = new Tarea();

                $tarea->fake_id = Str::random(5);
                $tarea->fecha_inicio = $request->fecha_inicio;
                $tarea->fecha_fin = $request->fecha_fin;
                $tarea->direc_tarea = $request->direccion;
                $tarea->detalle = $request->detalle;
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
        return view('tareas.show', compact('tarea'));
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

        if($tarea->estado == 'Finalizada'){
            return back()->with('danger', 'La tarea ha finalizado y no puede actualizarse');
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

        if($tarea->estado == 'Finalizada'){

            return redirect()->route('solicituds.show', Hashids::encode($solicitud->id))
                    ->with('danger', 'La tarea ha finalizado y no puede actualizarse');

        }else{

            $tarea->fecha_inicio = $request->fecha_inicio;
            $tarea->fecha_fin = $request->fecha_fin;
            $tarea->direc_tarea = $request->direccion;
            $tarea->detalle = $request->detalle;
            $tarea->estado = $request->estado;

            $tarea->save();

            return redirect()->route('tareas.show', Hashids::encode($tarea->id))
                ->with('info', 'Tarea actualizada');

        }
    }

    public function abandonar(request $request, $id)
    {

        $tarea = Tarea::findOrFail($id);

        if ($tarea->estado != 'Abandonado') {

            $tarea->estado = 'Abandonado';

            $tarea->save();

        }
    }

    public function proceso(request $request, $id)
    {

        $tarea = Tarea::findOrFail($id);

        if ($tarea->estado != 'En Proceso') {

            $tarea->estado = 'En Proceso';

            $tarea->save();
            
        }
    }

    public function finalizar(request $request, $id)
    {

        $tarea = Tarea::findOrFail($id);

        if ($tarea->estado != 'Finalizada') {

            $tarea->estado = 'Finalizada';

            $tarea->save();

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
