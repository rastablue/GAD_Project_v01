<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FechaPdfMantenimiento extends FormRequest
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
            "fecha_fin" => "required|date_format:Y-m-d",
            "customRadio" => "required|in:1,2,3,4,5",
        ];
    }
}
