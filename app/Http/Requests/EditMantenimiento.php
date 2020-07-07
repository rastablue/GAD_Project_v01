<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditMantenimiento extends FormRequest
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
            "diagnostico" => "required|string|max:500",
            "observacion" => "nullable|string|max:500",
            "fecha_egreso" => "nullable|date_format:Y-m-d|before_or_equal:".$hoy,
            "valor_total" => "required|between:0,9.99",
            "estado" => "nullable|in:Activo,Inactivo,Finalizado,En espera",
            "foto" => "image|mimes:jpg,jpeg,png|max:3000",
        ];
    }
}
