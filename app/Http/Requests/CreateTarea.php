<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTarea extends FormRequest
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
            "codigo1" => "required|alpha|size:3",
            "codigo2" => "required|digits:4",
            "codigo3" => "required|alpha_num|size:1",
            "fecha_inicio" => "required|date_format:Y-m-d",
            "fecha_fin" => "required|date_format:Y-m-d",
            "direccion" => "required|string|max:500",
            "detalle" => "required|string|max:500",
            "estado" => "required|in:Abandonado,En Proceso,Finalizada,Pendiente",
        ];
    }
}
