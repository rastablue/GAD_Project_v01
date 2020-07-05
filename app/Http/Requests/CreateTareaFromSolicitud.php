<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class CreateTareaFromSolicitud extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $hoy = date('Y-m-d');

        return [
            "codigo" => "required|digits:7|exists:solicituds,codigo_solicitud",
            "direccion" => "required|string|max:500",
            "detalle" => "required|string|max:500",
            "fecha_inicio" => "nullable|date_format:Y-m-d|after_or_equal:".$hoy,
            "fecha_fin" => 'nullable|required_with:fecha_inicio|date_format:Y-m-d|after_or_equal:fecha_inicio',
        ];
    }
}
