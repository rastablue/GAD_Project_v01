<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMantenimiento extends FormRequest
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
            "maquinaria" => "required|exists:maquinarias,id",
            "diagnostico" => "required|string|max:500",
            "observacion" => "nullable|string|max:500",
            "valor_total" => "required|between:0,9.99",
        ];
    }
}
