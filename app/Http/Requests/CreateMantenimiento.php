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
            "diagnostico" => "required|string|max:500",
            "observacion" => "string|max:500",
            "maquinaria" => "required|exists:maquinarias,id",
            "foto" => "image|mimes:jpg,jpeg,png|max:3000",
        ];
    }
}
