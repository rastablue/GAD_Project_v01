<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSolicitud extends FormRequest
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
            "detalle" => "string|max:500",
            "cedula" => "required|digits:10",
            "fecha_inicio" => "required|date_format:Y-m-d|after_or_equal:".$hoy,
            "fecha_fin" => "required|date_format:Y-m-d|after_or_equal:fecha_inicio",
        ];
    }
}
