<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSolicitud extends FormRequest
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
            "detalle" => "string|max:500",
            "observacion" => "string|max:500",
            "cedula" => "required|digits:10|exists:clientes,cedula",
            "estado" => "required|in:Aprobado,Reprobado,Pendiente",
        ];
    }
}
