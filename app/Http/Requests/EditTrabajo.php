<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditTrabajo extends FormRequest
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
            "mano_de_obra" => "required|string|max:500",
            "repuestos" => "required|string|max:500",
            "costo_mano_de_obra" => "required|between:0,6.99",
            "costo_de_repuestos" => "required|between:0,6.99",
            "tipo" => "required|in:Preventivo,Correctivo",
            "estado" => "required|in:Activo,En espera,Finalizado,Inactivo",
        ];
    }
}
