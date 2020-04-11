<?php

namespace App\Http\Controllers;

use App\Tarea;
use App\Maquinaria;
use App\MaquinariaTarea;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMaquinaria;
use App\Http\Requests\EditMaquinaria;
use Barryvdh\DomPDF\Facade as PDF;
use Vinkla\Hashids\Facades\Hashids;

class MaquinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maquinarias = Maquinaria::all();
        return view('maquinarias.index', compact('maquinarias'));
    }

    public function maquinariaData()
    {
        return Datatables()
                ->eloquent(Maquinaria::query())
                ->addColumn('btn', 'maquinarias.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    public function reportes()
    {
        $maquinaria = Maquinaria::all();

        $pdf = PDF::loadView('pdfs.reporte-maquinarias', compact('maquinaria'));

        return $pdf->download('reporte-maquinarias.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('maquinarias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMaquinaria $request)
    {
        $maquinarias = new Maquinaria();

        $maquinarias->codigo_nro_gad = $request->codigo;
        $maquinarias->placa = $request->placa;
        $maquinarias->marca_id = $request->marca;
        $maquinarias->modelo = $request->modelo;
        $maquinarias->anio = $request->anio;
        $maquinarias->kilometraje = $request->kilometraje;
        $maquinarias->tipo_vehiculo = $request->tipo;
        $maquinarias->observacion = $request->observacion;

        $maquinarias->save();

        return redirect()->route('maquinarias.show', Hashids::encode(Maquinaria::where('placa', $request->placa)->first()->id))
                ->with('info', 'Vehiculo agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function show($maquinaria)
    {
        $id = Hashids::decode($maquinaria);
        $maquinaria = Maquinaria::findOrfail($id)->first();
        return view('maquinarias.show', compact('maquinaria'));
    }

    public function asignaCreate()
    {
        return view('asignaciones.create');
    }

    public function asignaStoreCode(Request $request)
    {
        if ($codT = Tarea::where('fake_id', $request->codigo_tarea)->first()) {

            if ($codM = Maquinaria::where('codigo_nro_gad', $request->codigo_maquinaria)->first()) {
                $tarea = Tarea::where('fake_id', $request->codigo_tarea)->first();
                $maquinaria = Maquinaria::where('codigo_nro_gad', $request->codigo_maquinaria)->first();

                if($tarea->estado == 'Finalizada'){
                    return back()->with('danger', 'Error, la tarea seleccionada ha finalizado');
                }else{
                    if ($tarea->maquinarias()->sync($maquinaria)) {
                        $tarea->maquinarias()->sync($maquinaria);

                        return redirect()->route('tareas.show', Hashids::encode($tarea->id))
                                    ->with('info', 'Vehiculos asignados');

                    } else {
                        return back()->with('danger', 'Error, no se pudo asignar los vehiculos');
                    }
                }

            } else {
                return back()->with('danger', 'Error, no se pudo encontrar el vehiculo');
            }

        } else {
            return back()->with('danger', 'Error, no se pudo encontrar la tarea');
        }
    }

    public function asigna($tarea)
    {
        $id = Hashids::decode($tarea);
        $tarea = Tarea::findOrfail($id)->first();
        $maquinaria = Maquinaria::all();

        if($tarea->estado != 'Finalizada'){
            return view('asignaciones.update', compact('maquinaria', 'tarea'));
        }else{
            return back()->with('danger', 'La tarea ha finalizado, no es posible asignar vehiculos');
        }
    }

    public function asignaStore(Request $request, $tarea)
    {
        $id = Hashids::decode($tarea);
        $tarea = Tarea::findOrfail($request->tarea);
        $maquinaria = Maquinaria::all();

        if($tarea->estado == 'Finalizada'){
            return redirect()->route('tareas.show', Hashids::encode($tarea->id))
                    ->with('danger', 'Esta tarea ha finalizado y no puede actualizarse');
        }else{

            $tarea->maquinarias()->sync($request->get('maquinarias'));
            if ($tarea->maquinarias()->sync($request->get('maquinarias'))) {
                $tarea->maquinarias()->sync($request->get('maquinarias'));

                return redirect()->route('tareas.show', Hashids::encode($tarea->id))
                            ->with('info', 'Vehiculos asignados');

            } else {
                return redirect()->route('tareas.show', Hashids::encode($tarea->id))
                            ->with('danger', 'Error, no fue posible asignar los vehiculos');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function edit($maquinaria)
    {
        $id = Hashids::decode($maquinaria);
        $maquinaria = Maquinaria::findOrfail($id)->first();
        return view('maquinarias.edit', compact('maquinaria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function update(EditMaquinaria $request, $maquinaria)
    {
        if ($maquinarias = Maquinaria::findOrFail($maquinaria)) {
            $maquinarias = Maquinaria::findOrFail($maquinaria);

            $maquinarias->kilometraje = $request->kilometraje;
            $maquinarias->tipo_vehiculo = $request->tipo;
            $maquinarias->observacion = $request->observacion;

            $maquinarias->save();

            return redirect()->route('maquinarias.show', Hashids::encode($maquinarias->id))
                    ->with('info', 'Vehiculo actualizado');

        } else {
            return back()->with('daner', 'No se encontro el Vehiculo');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maquinaria  $maquinaria
     * @return \Illuminate\Http\Response
     */
    public function destroy($maquinaria)
    {
        $id = Maquinaria::findOrFail($maquinaria);
        $id->delete();
    }
}
