<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTarea extends FormRequest
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
            "fecha_inicio" => "required|date_format:Y-m-d",
            "fecha_fin" => "required|date_format:Y-m-d|after_or_equal:fecha_inicio",
            "direccion" => "required|string|max:500",
            "detalle" => "required|string|max:500",
            "estado" => "required|in:Abandonado,En Proceso,Finalizada,Pendiente",
        ];
    }
}
