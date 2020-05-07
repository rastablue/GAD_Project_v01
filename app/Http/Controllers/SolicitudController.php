<?php

namespace App\Http\Controllers;

use App\Solicitud;
use App\Cliente;
use App\Tarea;
use App\Http\Requests\CreateCliente;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSolicitud;
use App\Http\Requests\CreateClienteFrom;
use App\Http\Requests\EditSolicitud;
use App\Http\Requests\FechaPdfSolicitud;
use Carbon\Carbon;
use Vinkla\Hashids\Facades\Hashids;
use Barryvdh\DomPDF\Facade as PDF;
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
        $solicituds = Solicitud::all();
        return view('solicituds.index', compact('solicituds'));
    }

    public function solicitudData()
    {
        $solicitudes = Solicitud::join('clientes', 'clientes.id', '=', 'solicituds.cliente_id')
                                ->select('solicituds.id', 'solicituds.codigo_solicitud', 'solicituds.fecha_emision',
                                        'solicituds.fecha_revision', 'clientes.name', 'solicituds.detalle',
                                        'clientes.apellido_pater', 'solicituds.estado', 'solicituds.observacion');

        return Datatables::of($solicitudes)
                ->addColumn('btn', 'solicituds.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }
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
        $total = Solicitud::get()->last();

        if ($total->codigo_solicitud == 0 || $total->codigo_solicitud == '0' || empty($total->codigo_solicitud)) {
            $codigo = '1000001';
        } else {
            $codigo = $total->codigo_solicitud + 1;
        }

        if (Solicitud::where('codigo_solicitud', $codigo)->first()) {
            return back() ->with('danger', 'Error, La solicitud ya existe');

        } else {

            if($cliente = Cliente::where('cedula', $request->cedula)->first()){

                $cliente = Cliente::where('cedula', $request->cedula)->first();

                $solicitud = new Solicitud();
                $solicitud->codigo_solicitud = $codigo;
                $solicitud->fecha_emision = $date;
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

        if ($total->codigo_solicitud == 0 || $total->codigo_solicitud == '0' || empty($total->codigo_solicitud)) {
            $codigo = '1000001';
        } else {
            $codigo = $total->codigo_solicitud + 1;
        }

        $solicitud = new Solicitud();
        $solicitud->codigo_solicitud = $codigo;
        $solicitud->fecha_emision = $date;
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

        if($solicitud->estado != 'Reprobado'){
            return view('solicituds.edit', compact('solicitud'));
        }else{
            return back()->with('danger', 'Esta solicitud fue reprobada y no puede editarse');
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

        if(!$cliente = Cliente::where('cedula', $request->cedula)->first()){
            return back() ->with('danger', 'Error, El cliente no existe');

        }else{

            $cliente = Cliente::where('cedula', $request->cedula)->first();

            $solicitud = Solicitud::findOrFail($id);

            $solicitud->detalle = $request->detalle;
            $solicitud->cliente_id = $cliente->id;

            if ($request->estado != 'Pendiente') {
                $solicitud->fecha_revision = $date;
                $solicitud->estado = $request->estado;
            }

            if ($solicitud->estado == 'Reprobado') {

                $solicitud->estado = 'Reprobado';
                $solicitud->fecha_revision = $date;

                $solicitud->save();

                foreach ($solicitud->tareas->all() as $key) {
                    $key->estado = 'Finalizada';

                    $key->save();
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

    }

    public function aprobar(request $request, $id)
    {

        $date = Carbon::now();

        $solicitud = Solicitud::findOrFail($id);

        if ($solicitud->estado != 'Aprobado') {

            $solicitud->estado = 'Aprobado';
            $solicitud->fecha_revision = $date;

            $solicitud->save();

            foreach ($solicitud->tareas->all() as $key) {
                $key->estado = 'En Proceso';

                $key->save();
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
