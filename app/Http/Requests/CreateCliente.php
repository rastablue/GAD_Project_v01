<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCliente extends FormRequest
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
            "cedula" => "required|digits:10|unique:clientes,cedula",
            "nombre" => "required|string|max:25",
            "apellido_paterno" => "required|string|max:25",
            "apellido_materno" => "required|string|max:25",
            "direccion" => "required|string|max:250",
            "telefono" => "digits_between:7,10",
            "email" => "email",
        ];
    }
}
