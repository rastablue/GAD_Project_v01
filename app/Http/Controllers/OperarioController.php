<?php

namespace App\Http\Controllers;

use App\Operario;
use App\Maquinaria;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use Barryvdh\DomPDF\Facade as PDF;

class OperarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operarios = Operario::all();
        return view('operarios.index', compact('operarios'));
    }

    public function operarioData()
    {
        return Datatables()
                ->eloquent(Operario::query())
                ->addColumn('btn', 'operarios.actions')
                ->rawColumns(['btn'])
                ->make(true);
    }

    public function reportes()
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $operario = Operario::all();

        $pdf = PDF::loadView('pdfs.reporte-operarios', compact('operario'));

        return $pdf->download('reporte-operarios.pdf');
    }

    public function pdf($id)
    {
        /**
         * toma en cuenta que para ver los mismos
         * datos debemos hacer la misma consulta
        **/
        $id = Hashids::decode($id);
        $operario = Operario::findOrFail($id)->first();

        $pdf = PDF::loadView('pdfs.operarios', compact('operario'));

        return $pdf->download('operario-'.$operario->name.'.pdf');
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
        $ced = $request->cedula;

        if ($id_operarios = Operario::where('cedula', $ced)->first()) {

            return back() ->with('danger', 'Error, el Operario ya existe');

        } else {

            $operarios = new Operario();

            $operarios->cedula = $request->cedula;
            $operarios->name = $request->name;
            $operarios->apellido_pater = $request->apellido_pater;
            $operarios->apellido_mater = $request->apellido_mater;
            $operarios->direc = $request->direc;
            $operarios->tlf = $request->tlf;
            $operarios->tipo_contrato = $request->tipo_contrato;
            $operarios->tipo_licencia = $request->tipo_licencia;

            $operarios->save();

            return redirect()->route('operarios.index')
                    ->with('info', 'Operarios creado con exito');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Operario  $operario
     * @return \Illuminate\Http\Response
     */
    public function show($operario)
    {
        $id = Hashids::decode($operario);
        $operario = Operario::findOrfail($id)->first();
        return view('operarios.show', compact('operario'));
    }

    public function asignaCreate()
    {
        return view('asignaciones.createvehi');
    }

    public function asignaStoreCode(Request $request)
    {
        if ($request->operario) {

            if ($request->maquinaria) {

                $maquinaria = Maquinaria::findOrFail($request->maquinaria);

                $maquinaria->operario_id = $request->operario;

                $maquinaria->save();

                return redirect()->route('operarios.show', Hashids::encode($request->operario))
                        ->with('info', 'Vehiculo asignado');

            } else {
                return back()->with('danger', 'Error, no se ha encontrado la maquinaria');
            }

        } else {
            return back()->with('danger', 'Error, no se ha encontrado el operario');
        }

    }

    public function asigna($operario)
    {
        $id = Hashids::decode($operario);
        $operario = Operario::findOrfail($id)->first();
        $maquinaria = Maquinaria::all();
        return view('asignaciones.updatevehi', compact('maquinaria', 'operario'));
    }

    public function asignaStore(Request $request, $operario)
    {
        $id = Hashids::decode($operario);
        $operario = Operario::findOrfail($request->operario);

        $maquinarias = $request->maquinarias;

        foreach ($maquinarias as $key) {

            $maquinaria = Maquinaria::findOrFail($key);

            $maquinaria->operario_id = $operario->id;
            $maquinaria->save();
        }

        return redirect()->route('operarios.show', Hashids::encode($operario->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operario  $operario
     * @return \Illuminate\Http\Response
     */
    public function edit($operarios)
    {
        $id = Hashids::decode($operarios);
        $operario = Operario::findOrfail($id)->first();
        return view('operarios.edit', compact('operario'));

        /*$operario = Operario::findOrFail($operarios);

        $html = '<div class="form-group">
                    <label for="cedula">Cedula</label>
                    <input type="text" class="form-control" name="cedula" id="cedula" disabled value="'.$operario->cedula.'" placeholder="'.$operario->cedula.'">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="name" id="name" value="'.$operario->name.'" placeholder="'.$operario->name.'">
                </div>
                <div class="form-group">
                    <label for="apelido_pater">Apellio Paterno</label>
                    <input type="text" class="form-control" name="apellido_pater" id="apellido_pater" value="'.$operario->apellido_pater.'" placeholder="'.$operario->apellido_pater.'">
                </div>
                <div class="form-group">
                    <label for="apellido_mater">Apellido Materno</label>
                    <input type="text" class="form-control" name="apellido_mater" id="apellido_mater" value="'.$operario->apellido_mater.'" placeholder="'.$operario->apellido_mater.'">
                </div>
                <div class="form-group">
                    <label for="direc">Direccion</label>
                    <input type="text" class="form-control" name="direc" id="direc" value="'.$operario->direc.'" placeholder="'.$operario->direc.'">
                </div>
                <div class="form-group">
                    <label for="tlf">Telefono</label>
                    <input type="text" class="form-control" name="tlf" id="tlf" value="'.$operario->tlf.'" placeholder="'.$operario->tlf.'">
                </div>
                <div class="form-group">
                    <label for="cedula">Cedula</label>
                    <select id="tipo_contrato" class="form-control" name="tipo_contrato">
                        <option disabled selected>Seleccione un Contrato</option>
                        @foreach(App\Operario::getEnumValues("operarios", "tipo_contrato") as '.$operarios.')
                            <option value="'.$operarios.'"> '.$operarios.' </option>
                        @endforeach
                    </select>
                </div>';

        return response()->json(['html'=>$html]);*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operario  $operario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $operario)
    {
        $operarios = Operario::findOrFail($operario);

        $operarios->name = $request->name;
        $operarios->apellido_pater = $request->apellido_pater;
        $operarios->apellido_mater = $request->apellido_mater;
        $operarios->direc = $request->direc;
        $operarios->tlf = $request->tlf;
        $operarios->tipo_contrato = $request->tipo_contrato;
        $operarios->tipo_licencia = $request->tipo_licencia;

        $operarios->save();

        if ($operarios->save()) {
            return redirect()->route('operarios.index')
                ->with('info', 'Operario actualizado con exito');
        } else {
            return redirect()->route('operarios.index')
                ->with('danger', 'Error al actualizar al Operario');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operario  $operario
     * @return \Illuminate\Http\Response
     */
    public function destroy($operario)
    {
        $id = Operario::findOrFail($operario);
        $id->delete();
    }
}
