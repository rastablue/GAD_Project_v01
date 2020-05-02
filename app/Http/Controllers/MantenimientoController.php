<?php

namespace App\Http\Controllers;

use App\Mantenimiento;
use App\Maquinaria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMantenimiento;
use App\Http\Requests\EditMantenimiento;
use Vinkla\Hashids\Facades\Hashids;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\Datatables\Datatables;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mantenimiento = Mantenimiento::paginate(5);
        return view('mantenimientos.index', compact('mantenimiento'));
    }

    public function mantenimientoData()
    {
        $mantenimientos = Mantenimiento::join('maquinarias', 'maquinarias.id', 'mantenimientos.maquinaria_id')
                                        ->select('mantenimientos.codigo', 'mantenimientos.fecha_ingreso',
                                                'mantenimientos.estado', 'mantenimientos.id', 'maquinarias.placa');

        return Datatables::of($mantenimientos)
                ->addColumn('btn', 'mantenimientos.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    public function reportes()
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $mantenimiento = Mantenimiento::all();

        $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

        return $pdf->download('reporte-mantenimientos.pdf');
    }

    public function pdf($id)
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $id = Hashids::decode($id);
        $mantenimiento = Mantenimiento::findOrFail($id)->first();

        $pdf = PDF::loadView('pdfs.mantenimientos', compact('mantenimiento'));

        return $pdf->download('mantenimiento-'.$mantenimiento->codigo.'.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mantenimientos.create');
    }

    public function createFrom($vehiculo)
    {
        $id = Hashids::decode($vehiculo);
        $vehiculo = Maquinaria::findOrfail($id)->first();
        return view('mantenimientos.createfrom', compact('vehiculo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMantenimiento $request)
    {
        $date = Carbon::now();

        $mantenimiento = new Mantenimiento();
        $mantenimiento->codigo = $request->codigo;
        $mantenimiento->fecha_ingreso = $request->fecha_ingreso;
        $mantenimiento->fecha_egreso = $request->fecha_egreso;
        $mantenimiento->observacion = $request->observacion;
        $mantenimiento->diagnostico = $request->diagnostico;
        $mantenimiento->estado = 'En espera';
        $mantenimiento->maquinaria_id = $request->maquinaria;

        if ($request->hasFile('foto')) {
            $image = $request->foto->store('public');
            $mantenimiento->path = $image;
        }

        $mantenimiento->save();

        $mantenimiento = Mantenimiento::where('codigo', $request->codigo)->first();

        return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
                ->with('info', 'Mantenimiento agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function show($mantenimiento)
    {
        $id = Hashids::decode($mantenimiento);
        $mantenimiento = Mantenimiento::findOrFail($id)->first();

        return view('mantenimientos.show', compact('mantenimiento'));
    }

    public function ficha($mantenimiento)
    {
        $id = Hashids::decode($mantenimiento);
        $mantenimiento = Mantenimiento::findOrFail($id)->first();

        return view('mantenimientos.ficha', compact('mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($mantenimiento)
    {
        $id = Hashids::decode($mantenimiento);
        $mantenimiento = Mantenimiento::findOrFail($id)->first();

        if ($mantenimiento->estado != 'Finalizado') {
            return view('mantenimientos.edit', compact('mantenimiento'));
        }else{
            return back()->with('danger', 'El mantenimiento ha finalizado y no puede editarse');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(EditMantenimiento $request, $mantenimiento)
    {
        $date = Carbon::now();

        $mantenimiento = Mantenimiento::findOrFail($mantenimiento);

        if ($mantenimiento->estado != 'Finalizado') {

            $mantenimiento->fecha_ingreso = $request->fecha_ingreso;
            $mantenimiento->fecha_egreso = $request->fecha_egreso;
            $mantenimiento->observacion = $request->observacion;
            $mantenimiento->diagnostico = $request->diagnostico;
            $mantenimiento->estado = $request->estado;

            if ($request->estado == 'Finalizado') {

                foreach ($mantenimiento->trabajos->all() as $key) {
                    $key->estado = 'Finalizado';

                    $key->save();
                }
            }

            if ($request->hasFile('foto')) {
                $image = $request->foto->store('public');
                $mantenimiento->path = $image;
            }

            $mantenimiento->save();

            return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
                    ->with('info', 'Mantenimiento actualizado');
        } else {
            return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
            ->with('danger', 'El mantenimiento ha finalizado y no es posible actualizarlo');
        }

    }

    public function activo(request $request, $id)
    {

        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado != 'Activo') {

            $mantenimiento->estado = 'Activo';

            $mantenimiento->save();

        }
    }

    public function espera(request $request, $id)
    {

        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado != 'En espera') {

            $mantenimiento->estado = 'En espera';

            $mantenimiento->save();

        }
    }

    public function inactivo(request $request, $id)
    {

        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado != 'Inactivo') {

            $mantenimiento->estado = 'Inactivo';

            $mantenimiento->save();

            foreach ($mantenimiento->trabajos->all() as $key) {
                $key->estado = 'Inactivo';

                $key->save();
            }

        }
    }

    public function finalizar(request $request, $id)
    {

        $mantenimiento = Mantenimiento::findOrFail($id);

        if ($mantenimiento->estado != 'Finalizado') {

            $mantenimiento->estado = 'Finalizado';

            $mantenimiento->save();

            foreach ($mantenimiento->trabajos->all() as $key) {
                $key->estado = 'Finalizado';

                $key->save();
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($mantenimiento)
    {
        $id = Mantenimiento::findOrFail($mantenimiento);
        $id->delete();
    }
}
