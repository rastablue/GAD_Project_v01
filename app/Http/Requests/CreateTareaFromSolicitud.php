<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            "codigo" => "required|string|size:10|exists:solicituds,codigo_solicitud",
            "fecha_inicio" => "required|date_format:Y-m-d",
            "fecha_fin" => "required|date_format:Y-m-d",
            "direccion" => "required|string|max:500",
            "detalle" => "required|string|max:500",
            "estado" => "required|in:Abandonado,En Proceso,Finalizada,Pendiente",
        ];
    }
}
