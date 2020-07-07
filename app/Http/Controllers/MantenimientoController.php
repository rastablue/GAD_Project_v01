<?php

namespace App\Http\Controllers;

use App\Mantenimiento;
use App\Maquinaria;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CreateMantenimiento;
use App\Http\Requests\CreateMantenimientoFrom;
use App\Http\Requests\EditMantenimiento;
use App\Http\Requests\FechaPdfMantenimiento;
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

        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');

        if($start_date && $end_date){
 
            $start_date = date('Y-m-d', strtotime($start_date));
            $end_date = date('Y-m-d', strtotime($end_date));

            $mantenimientos = Mantenimiento::join('maquinarias', 'maquinarias.id', 'mantenimientos.maquinaria_id')
                                            ->select('mantenimientos.codigo', 'mantenimientos.fecha_ingreso',
                                                    'mantenimientos.estado', 'mantenimientos.id', 'maquinarias.placa',
                                                    'mantenimientos.observacion', 'mantenimientos.diagnostico')
                                            ->whereRaw("date(mantenimientos.fecha_ingreso) >= '" . $start_date . "' 
                                                    AND date(mantenimientos.fecha_ingreso) <= '" . $end_date . "'");;

            return Datatables::of($mantenimientos)
                ->addColumn('btn', 'mantenimientos.actions')
                ->rawColumns(['btn'])
                ->make(true);
        }

        $mantenimientos = Mantenimiento::join('maquinarias', 'maquinarias.id', 'mantenimientos.maquinaria_id')
                                        ->select('mantenimientos.codigo', 'mantenimientos.fecha_ingreso',
                                                'mantenimientos.estado', 'mantenimientos.id', 'maquinarias.placa',
                                                'mantenimientos.observacion', 'mantenimientos.diagnostico');

        return Datatables::of($mantenimientos)
                ->addColumn('btn', 'mantenimientos.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    //Reportes PDFs
        public function reportes()
        {
            $mantenimiento = Mantenimiento::all();

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos.pdf');
        }

        public function reportesActivo()
        {
            $mantenimiento = Mantenimiento::where('estado', 'Activo')->get();

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos-activos.pdf');
        }

        public function reportesEspera()
        {
            $mantenimiento = Mantenimiento::where('estado', 'En espera')->get();

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos-espera.pdf');
        }

        public function reportesInactivo()
        {
            $mantenimiento = Mantenimiento::where('estado', 'Inactivo')->get();

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos-inactivos.pdf');
        }

        public function reportesFinalizado()
        {
            $mantenimiento = Mantenimiento::where('estado', 'Finalizado')->get();

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos-finalizados.pdf');
        }

        public function reportesSelect()
        {
            return view('mantenimientos.reporteselection.fecha');
        }

        public function reportesSelectApply(FechaPdfMantenimiento $request)
        {
            if ($request->customRadio == 1) {
                $mantenimiento = Mantenimiento::whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])->get();
            }
            
            if ($request->customRadio == 2) {
                $mantenimiento = Mantenimiento::whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'Activo')
                                        ->get();
            }

            if ($request->customRadio == 3) {
                $mantenimiento = Mantenimiento::whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'En espera')
                                        ->get();
            }

            if ($request->customRadio == 4) {
                $mantenimiento = Mantenimiento::whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'Finalizado')
                                        ->get();
            }

            if ($request->customRadio == 5) {
                $mantenimiento = Mantenimiento::whereBetween('fecha_ingreso', [$request->fecha_inicio, $request->fecha_fin])
                                        ->where('estado', 'Inactivo')
                                        ->get();
            }

            $pdf = PDF::loadView('pdfs.reporte-mantenimientos', compact('mantenimiento'));

            return $pdf->download('reporte-mantenimientos.pdf');
        }

        public function pdf($id)
        {
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
        $total = Mantenimiento::all();
        $codigo = rand(1000000, 9999999);

        $mantenimiento = new Mantenimiento();
        $mantenimiento->codigo = $codigo;
        $mantenimiento->fecha_ingreso = $date;
        $mantenimiento->observacion = $request->observacion;
        $mantenimiento->diagnostico = $request->diagnostico;
        $mantenimiento->valor_total = $request->valor_total;
        $mantenimiento->estado = 'En espera';
        $mantenimiento->maquinaria_id = $request->maquinaria;

        if ($request->hasFile('foto')) {
            $image = $request->foto->store('public');
            $mantenimiento->path = $image;
        }

        $mantenimiento->save();

        $mantenimiento = Mantenimiento::where('codigo', $codigo)->first();

        return redirect()->route('mantenimientos.show', Hashids::encode($mantenimiento->id))
                ->with('info', 'Mantenimiento agregado');
    }

    public function storeFrom(CreateMantenimientoFrom $request)
    {
        $date = Carbon::now();
        $total = Mantenimiento::get()->last();
        $maquinaria = Maquinaria::where('placa', $request->placa)->first();

        $codigo = rand(1000000, 9999999);

        $mantenimiento = new Mantenimiento();
        $mantenimiento->codigo = $codigo;
        $mantenimiento->fecha_ingreso = $date;
        $mantenimiento->observacion = $request->observacion;
        $mantenimiento->diagnostico = $request->diagnostico;
        $mantenimiento->valor_total = $request->valor_total;
        $mantenimiento->estado = 'En espera';
        $mantenimiento->maquinaria_id = $maquinaria->id;

        if ($request->hasFile('foto')) {
            $image = $request->foto->store('public');
            $mantenimiento->path = $image;
        }

        $mantenimiento->save();

        $mantenimiento = Mantenimiento::where('codigo', $codigo)->first();

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

            $mantenimiento->fecha_egreso = $request->fecha_egreso;
            $mantenimiento->observacion = $request->observacion;
            $mantenimiento->diagnostico = $request->diagnostico;
            $mantenimiento->estado = $request->estado;
            $mantenimiento->valor_total = $request->valor_total;

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

            $mantenimiento->fecha_egreso = Carbon::now();
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
