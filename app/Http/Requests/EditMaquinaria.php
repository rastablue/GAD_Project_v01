<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditMaquinaria extends FormRequest
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
            "kilometraje" => "digits_between:0,7",
            "tipo" => "string|max:50",
            "observacion" => "string|max:500",
        ];
    }
}
