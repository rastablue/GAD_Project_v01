<?php

namespace App\Http\Controllers;

use App\Trabajo;
use App\Mantenimiento;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTrabajo;
use App\Http\Requests\EditTrabajo;
use Vinkla\Hashids\Facades\Hashids;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\Datatables\Datatables;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trabajos = Trabajo::paginate(5);
        return view('trabajos.index', compact('trabajos'));
    }

    public function trabajoData()
    {
        $trabajos = Trabajo::join('mantenimientos', 'mantenimientos.id', '=', 'trabajos.mantenimiento_id')
                            ->join('maquinarias', 'maquinarias.id', '=', 'mantenimientos.maquinaria_id')
                            ->select('maquinarias.codigo_nro_gad', 'mantenimientos.codigo',
                                    'trabajos.fake_id', 'trabajos.estado', 'trabajos.tipo', 'trabajos.id',
                                    'trabajos.manobra', 'mantenimientos.diagnostico');

        return Datatables::of($trabajos)
                ->addColumn('btn', 'trabajos.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    public function reportes()
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $trabajo = Trabajo::all();

        $pdf = PDF::loadView('pdfs.reporte-trabajos', compact('trabajo'));

        return $pdf->download('reporte-trabajos.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function createFrom($mantenimiento)
    {
        $id = Hashids::decode($mantenimiento);
        $mantenimiento = Mantenimiento::findOrfail($id)->first();

        if ($mantenimiento->estado != 'Finalizado') {
            return view('trabajos.createfrom', compact('mantenimiento'));
        } else {
            return back()->with('danger', 'El mantenimiento ha finalizado y no puede editarse');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTrabajo $request)
    {
        $mantenimiento = Mantenimiento::findOrFail($request->codigo);

        if ($mantenimiento->estado == 'Finalizado') {

            return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
                    ->with('danger', 'Este mantenimiento ya ha finalizado, no es posible agregar mas trabajos');

        } else {
            if ($request->costo_de_repuestos < 0) {
                $request->costo_de_repuestos = $request->costo_de_repuestos * -1;
            }

            if ($request->costo_mano_de_obra < 0) {
                $request->costo_mano_de_obra = $request->costo_mano_de_obra * -1;
            }

            $trabajo = new Trabajo();
            $trabajo->fake_id = Str::random(5);
            $trabajo->manobra = $request->mano_de_obra;
            $trabajo->repuestos = $request->repuestos;
            $trabajo->costo_repuestos = $request->costo_de_repuestos;
            $trabajo->costo_manobra = $request->costo_mano_de_obra;
            $trabajo->estado = $request->estado;
            $trabajo->tipo = $request->tipo;
            $trabajo->mantenimiento_id = $mantenimiento->id;

            $trabajo->save();

            $valorTotal = $request->costo_de_repuestos + $request->costo_mano_de_obra + $mantenimiento->valor_total;

            $mantenimiento->valor_total = $valorTotal;

            //Si el estado del trabajo es 'Activo' el mantenimiento pasara a estar activo automaticamente
            if($request->estado == 'Activo'){
                $mantenimiento->estado = 'Activo';
            }

            $mantenimiento->save();

            return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
                    ->with('info', 'Trabajo creado');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function show($trabajo)
    {
        $id = Hashids::decode($trabajo);
        $trabajo = Trabajo::findOrFail($id)->first();
        $mantenimiento = Mantenimiento::where('id', $trabajo->mantenimiento_id)->first();

        return view('mantenimientos.show', compact('mantenimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function edit($trabajo)
    {
        $id = Hashids::decode($trabajo);
        $trabajo = Trabajo::findOrFail($id)->first();

        if ($trabajo->estado != 'Finalizado') {
            return view('trabajos.edit', compact('trabajo'));
        } else {
            return back()->with('danger', 'El trabajo ha finalizado y no se puede editar');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function update(EditTrabajo $request, $trabajo)
    {
        $trabajos = Trabajo::findOrFail($trabajo);
        $mantenimiento = Mantenimiento::findOrFail($request->codigo);

        if ($mantenimiento->estado != 'Finalizado') {
            //Revisa si los valores de precios ingresados son negativos, en caso de serlo se convierten a positivo
                if ($request->costo_de_repuestos < 0) {
                    $request->costo_de_repuestos = $request->costo_de_repuestos * -1;
                }

                if ($request->costo_mano_de_obra < 0) {
                    $request->costo_mano_de_obra = $request->costo_mano_de_obra * -1;
                }

            //Resta los antiuguos valores del trabajo de su respectivo mantenimiento
                $valorResta = $mantenimiento->valor_total - $trabajos->costo_repuestos - $trabajos->costo_manobra;
                $mantenimiento->valor_total = $valorResta;
                $mantenimiento->save();

            //Actualiza los datos del trabajo
                $trabajos->manobra = $request->mano_de_obra;
                $trabajos->repuestos = $request->repuestos;
                $trabajos->costo_repuestos = $request->costo_de_repuestos;
                $trabajos->costo_manobra = $request->costo_mano_de_obra;
                $trabajos->estado = $request->estado;
                $trabajos->tipo = $request->tipo;

                $trabajos->save();

            //Actualiza el valor total del mantenimiento respectivo al trabajo
                $valorTotal = $request->costo_de_repuestos + $request->costo_mano_de_obra + $mantenimiento->valor_total;

                $mantenimiento->valor_total = $valorTotal;
                $mantenimiento->save();

                return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
                    ->with('info', 'Trabajo actualizado');

        } else {
            return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
                    ->with('danger', 'Este mantenimiento ha finalizado y no se puede editar');
        }
    }

    public function activo(request $request, $id)
    {

        $trabajo = Trabajo::findOrFail($id);

        if ($trabajo->estado != 'Activo') {

            $trabajo->estado = 'Activo';

            $trabajo->save();

        }
    }

    public function espera(request $request, $id)
    {

        $trabajo = Trabajo::findOrFail($id);

        if ($trabajo->estado != 'En espera') {

            $trabajo->estado = 'En espera';

            $trabajo->save();

        }
    }

    public function inactivo(request $request, $id)
    {

        $trabajo = Trabajo::findOrFail($id);

        if ($trabajo->estado != 'Inactivo') {

            $trabajo->estado = 'Inactivo';

            $trabajo->save();

        }
    }

    public function finalizar(request $request, $id)
    {

        $trabajo = Trabajo::findOrFail($id);

        if ($trabajo->estado != 'Finalizado') {

            $trabajo->estado = 'Finalizado';

            $trabajo->save();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trabajo  $trabajo
     * @return \Illuminate\Http\Response
     */
    public function destroy($trabajo)
    {
        $id = Trabajo::findOrFail($trabajo);

        $mantenimiento = Mantenimiento::findOrFail($id->mantenimientos->id);

        $valorTotal = $mantenimiento->valor_total - $id->costo_manobra - $id->costo_repuestos;
        $mantenimiento->valor_total = $valorTotal;
        $mantenimiento->save();

        $id->delete();

    }
}
