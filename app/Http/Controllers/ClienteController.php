<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Vinkla\Hashids\Facades\Hashids;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCliente;
use App\Http\Requests\EditCliente;
use App\Cliente;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function clienteData()
    {
        return Datatables()
                ->eloquent(Cliente::query())
                ->addColumn('btn', 'clientes.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    public function reportes()
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $cliente = Cliente::all();

        $pdf = PDF::loadView('pdfs.reporte-clientes', compact('cliente'));

        return $pdf->download('reporte-clientes.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCliente $request)
    {
        $clientes = new Cliente();

        $clientes->cedula = $request->cedula;
        $clientes->name = $request->nombre;
        $clientes->apellido_pater = $request->apellido_paterno;
        $clientes->apellido_mater = $request->apellido_materno;
        $clientes->direc = $request->direccion;
        $clientes->tlf = $request->telefono;
        $clientes->email = $request->email;

        $clientes->save();

        return redirect()->route('clientes.show', Hashids::encode(Cliente::where('cedula', $request->cedula)->first()->id))
                ->with('info', 'Cliente creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($cliente)
    {
        $id = Hashids::decode($cliente);
        $cliente = Cliente::findOrFail($id)->first();
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($cliente)
    {
        $id = Hashids::decode($cliente);
        $cliente = Cliente::findOrFail($id)->first();
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(EditCliente $request, $cliente)
    {

        $clientes = Cliente::findOrFail($cliente);

        $clientes->direc = $request->direccion;
        $clientes->tlf = $request->telefono;
        $clientes->email = $request->email;

        $clientes->save();

        if ($clientes->save()) {
            return redirect()->route('clientes.show', Hashids::encode($clientes->id))
                ->with('info', 'Cliente actualizado con exito');
        } else {
            return redirect()->route('clientes.show', Hashids::encode($clientes->id))
                ->with('danger', 'Error al actualizar al cliente');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($cliente)
    {
        $id = Cliente::findOrFail($cliente);
        $id->delete();
    }
}
