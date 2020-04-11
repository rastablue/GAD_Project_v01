<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::paginate(5);
        return view('marcas.index', compact('marcas'));
    }

    public function marcaData()
    {
        return Datatables()
                ->eloquent(Marca::query())
                ->addColumn('btn', 'marcas.actions')
                ->rawColumns(['btn'])
                ->make(true);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marca = new Marca();

        $marca->marca = $request->marca;

        if ($marca->save()) {

            $marca->save();
            return redirect()->route('marcas.index')->with('info', 'Marca Agregada');

        } else {
            return redirect()->route('marcas.index')->with('danger', 'Error, no fue posible agregar la marca');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit($marca)
    {
        $id = Hashids::decode($marca);
        $marca = Marca::findOrFail($id)->first();

        return view('marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $marca)
    {
        $marca = Marca::findOrFail($marca);

        $marca->marca = $request->marca;

        if ($marca->save()) {

            $marca->save();
            return redirect()->route('marcas.index')->with('info', 'Marca Actualizada');

        } else {
            return redirect()->route('marcas.index')->with('danger', 'Error, no fue posible actualizar la marca');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy($marca)
    {
        $marca = Marca::findOrFail($marca);
        $marca->delete();
    }
}
