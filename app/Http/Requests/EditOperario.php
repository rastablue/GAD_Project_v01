<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditOperario extends FormRequest
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
            "direccion" => "required|string|max:250",
            "telefono" => "digits_between:7,10",
            "tipo_contrato" => "required|in:Eventual,Indefinido,Plazo Fijo,Por Obra Cierta,Por Tarea,Prueba",
            "tipo_licencia" => "required|in:A,A1,B,C,C1,D,D1,E,E1,F,G",
        ];
    }
}
