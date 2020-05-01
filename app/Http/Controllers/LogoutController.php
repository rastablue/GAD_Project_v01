<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;
use App\Tarea;

class LogoutController extends Controller
{
    
    public function consulta(Request $request)
    {
        $solicitud = Solicitud::where('codigo_solicitud', $request->buscar)->first();

        if ($solicitud) {
            return view('consulta', compact('solicitud'));
        } else {
            return back()->with('danger', 'Error, no se encontro una solicitud');
        }

    }

}
