<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMaquinaria extends FormRequest
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
        return [
            "codigo" => "required|string|max:12|unique:maquinarias,codigo_nro_gad",
            "placa" => "required|string|max:12|unique:maquinarias,placa",
            "marca" => "required|exists:marcas,id",
            "modelo" => "required|string|max:30",
            "anio" => "required|digits:4",
            "kilometraje" => "digits_between:0,7",
            "tipo" => "string|max:50",
            "observacion" => "string|max:500",
        ];
    }
}
